<?php
/**
 * Plugin Name: LUVEX Error Logger
 * Plugin URI: https://luvex.tech
 * Description: Comprehensive error logging system for frontend and backend errors with git commit tracking and GitHub sync
 * Version: 1.1.0
 * Author: LUVEX Team
 * Author URI: https://luvex.tech
 * License: MIT
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// GitHub Config - Set these in wp-config.php:
// define('GITHUB_ERROR_LOG_TOKEN', 'ghp_your_token_here');
// define('GITHUB_ERROR_LOG_REPO', 'owner/repo-name');  // e.g. 'lunaria/luvex-website'
// define('GITHUB_ERROR_LOG_BRANCH', 'main');

class LuvexErrorLogger {

    private $log_dir;
    private $git_commit_hash;
    private $github_token;
    private $github_repo;
    private $github_branch;

    public function __construct() {
        // Log directory in repository root
        $this->log_dir = ABSPATH . '../error-logs';

        // Get current git commit hash
        $this->git_commit_hash = $this->get_git_commit();

        // GitHub API config
        $this->github_token = defined('GITHUB_ERROR_LOG_TOKEN') ? GITHUB_ERROR_LOG_TOKEN : '';
        $this->github_repo = defined('GITHUB_ERROR_LOG_REPO') ? GITHUB_ERROR_LOG_REPO : '';
        $this->github_branch = defined('GITHUB_ERROR_LOG_BRANCH') ? GITHUB_ERROR_LOG_BRANCH : 'main';

        // Initialize
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_error_tracker'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_error_tracker'));
        add_action('wp_ajax_log_js_error', array($this, 'handle_js_error'));
        add_action('wp_ajax_nopriv_log_js_error', array($this, 'handle_js_error'));

        // GitHub sync cron
        add_action('luvex_sync_errors_to_github', array($this, 'sync_to_github'));
        add_filter('cron_schedules', array($this, 'add_cron_interval'));

        // PHP Error Handler
        set_error_handler(array($this, 'handle_php_error'));
        set_exception_handler(array($this, 'handle_php_exception'));
        register_shutdown_function(array($this, 'handle_fatal_error'));
    }

    /**
     * Add custom cron interval (every 5 minutes)
     */
    public function add_cron_interval($schedules) {
        $schedules['every_five_minutes'] = array(
            'interval' => 300, // 5 minutes
            'display'  => 'Every 5 Minutes'
        );
        return $schedules;
    }

    public function init() {
        // Create log directory if it doesn't exist
        if (!file_exists($this->log_dir)) {
            @mkdir($this->log_dir, 0755, true);
        }

        // Add .gitkeep but allow log files
        $gitignore_path = $this->log_dir . '/.gitignore';
        if (!file_exists($gitignore_path)) {
            file_put_contents($gitignore_path, "# Allow error logs\n!*.log\n!*.json\n");
        }

        // Schedule GitHub sync if token is configured
        if ($this->github_token && !wp_next_scheduled('luvex_sync_errors_to_github')) {
            wp_schedule_event(time(), 'every_five_minutes', 'luvex_sync_errors_to_github');
        }

        // Clean old logs (older than 30 days)
        $this->clean_old_logs();
    }

    /**
     * Get current git commit hash
     */
    private function get_git_commit() {
        $git_head_file = ABSPATH . '../.git/HEAD';

        if (!file_exists($git_head_file)) {
            return 'unknown';
        }

        $head_content = trim(file_get_contents($git_head_file));

        // If HEAD contains ref, read that ref
        if (strpos($head_content, 'ref:') === 0) {
            $ref_path = ABSPATH . '../.git/' . substr($head_content, 5);
            if (file_exists($ref_path)) {
                return trim(file_get_contents($ref_path));
            }
        }

        // Otherwise, HEAD itself is the commit hash
        return $head_content;
    }

    /**
     * Enqueue JavaScript error tracker
     */
    public function enqueue_error_tracker() {
        wp_enqueue_script(
            'luvex-error-tracker',
            plugin_dir_url(__FILE__) . 'error-tracker.js',
            array(),
            '1.0.0',
            true
        );

        wp_localize_script('luvex-error-tracker', 'luvexErrorLogger', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('luvex_error_log'),
            'git_commit' => substr($this->git_commit_hash, 0, 8)
        ));
    }

    /**
     * Handle JavaScript errors via AJAX
     */
    public function handle_js_error() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'luvex_error_log')) {
            wp_send_json_error('Invalid nonce');
            return;
        }

        $error_data = array(
            'type' => 'javascript',
            'message' => sanitize_text_field($_POST['message'] ?? 'Unknown error'),
            'source' => sanitize_text_field($_POST['source'] ?? ''),
            'lineno' => intval($_POST['lineno'] ?? 0),
            'colno' => intval($_POST['colno'] ?? 0),
            'stack' => sanitize_textarea_field($_POST['stack'] ?? ''),
            'url' => esc_url_raw($_POST['url'] ?? ''),
            'user_agent' => sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''),
            'user_id' => get_current_user_id(),
            'git_commit' => $this->git_commit_hash,
            'timestamp' => date('Y-m-d H:i:s')
        );

        $this->write_log($error_data);

        wp_send_json_success('Error logged');
    }

    /**
     * Handle PHP errors
     */
    public function handle_php_error($errno, $errstr, $errfile, $errline) {
        // Don't log suppressed errors or notices in production
        if (!(error_reporting() & $errno)) {
            return false;
        }

        $error_types = array(
            E_ERROR => 'ERROR',
            E_WARNING => 'WARNING',
            E_PARSE => 'PARSE',
            E_NOTICE => 'NOTICE',
            E_CORE_ERROR => 'CORE_ERROR',
            E_CORE_WARNING => 'CORE_WARNING',
            E_COMPILE_ERROR => 'COMPILE_ERROR',
            E_COMPILE_WARNING => 'COMPILE_WARNING',
            E_USER_ERROR => 'USER_ERROR',
            E_USER_WARNING => 'USER_WARNING',
            E_USER_NOTICE => 'USER_NOTICE',
            E_STRICT => 'STRICT',
            E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
            E_DEPRECATED => 'DEPRECATED',
            E_USER_DEPRECATED => 'USER_DEPRECATED'
        );

        $error_data = array(
            'type' => 'php',
            'severity' => $error_types[$errno] ?? 'UNKNOWN',
            'message' => $errstr,
            'file' => str_replace(ABSPATH, '', $errfile),
            'line' => $errline,
            'url' => $_SERVER['REQUEST_URI'] ?? '',
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
            'user_id' => get_current_user_id(),
            'git_commit' => $this->git_commit_hash,
            'timestamp' => date('Y-m-d H:i:s'),
            'backtrace' => $this->get_safe_backtrace()
        );

        $this->write_log($error_data);

        // Don't execute PHP internal error handler
        return true;
    }

    /**
     * Handle PHP exceptions
     */
    public function handle_php_exception($exception) {
        $error_data = array(
            'type' => 'php_exception',
            'severity' => 'EXCEPTION',
            'message' => $exception->getMessage(),
            'file' => str_replace(ABSPATH, '', $exception->getFile()),
            'line' => $exception->getLine(),
            'url' => $_SERVER['REQUEST_URI'] ?? '',
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
            'user_id' => get_current_user_id(),
            'git_commit' => $this->git_commit_hash,
            'timestamp' => date('Y-m-d H:i:s'),
            'backtrace' => $exception->getTraceAsString()
        );

        $this->write_log($error_data);
    }

    /**
     * Handle fatal errors
     */
    public function handle_fatal_error() {
        $error = error_get_last();

        if ($error !== null && in_array($error['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR))) {
            $error_data = array(
                'type' => 'php_fatal',
                'severity' => 'FATAL',
                'message' => $error['message'],
                'file' => str_replace(ABSPATH, '', $error['file']),
                'line' => $error['line'],
                'url' => $_SERVER['REQUEST_URI'] ?? '',
                'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
                'user_id' => get_current_user_id(),
                'git_commit' => $this->git_commit_hash,
                'timestamp' => date('Y-m-d H:i:s')
            );

            $this->write_log($error_data);
        }
    }

    /**
     * Get safe backtrace without arguments
     */
    private function get_safe_backtrace() {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
        $safe_trace = array();

        foreach ($trace as $frame) {
            $safe_trace[] = sprintf(
                "%s%s%s() in %s:%d",
                $frame['class'] ?? '',
                $frame['type'] ?? '',
                $frame['function'] ?? '',
                str_replace(ABSPATH, '', $frame['file'] ?? 'unknown'),
                $frame['line'] ?? 0
            );
        }

        return implode("\n", $safe_trace);
    }

    /**
     * Write error to log file
     */
    private function write_log($error_data) {
        $date = date('Y-m-d');
        $log_file = $this->log_dir . '/' . $date . '.log';

        // Format as JSON for easy parsing
        $log_entry = json_encode($error_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n" . str_repeat('-', 80) . "\n";

        // Write to file
        @file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
    }

    /**
     * Clean logs older than 30 days
     */
    private function clean_old_logs() {
        if (!is_dir($this->log_dir)) {
            return;
        }

        $files = glob($this->log_dir . '/*.log');
        $now = time();

        foreach ($files as $file) {
            if (is_file($file)) {
                // Delete files older than 30 days
                if ($now - filemtime($file) >= 30 * 24 * 60 * 60) {
                    @unlink($file);
                }
            }
        }
    }

    /**
     * Sync error logs to GitHub repository
     */
    public function sync_to_github() {
        // Check if GitHub is configured
        if (empty($this->github_token) || empty($this->github_repo)) {
            return;
        }

        // Get today's log file
        $date = date('Y-m-d');
        $log_file = $this->log_dir . '/' . $date . '.log';

        if (!file_exists($log_file)) {
            return; // No logs today
        }

        $content = file_get_contents($log_file);
        $file_path = 'error-logs/' . $date . '.log';

        // Check if we already synced this version
        $hash_file = $this->log_dir . '/.last_sync_' . $date;
        $current_hash = md5($content);

        if (file_exists($hash_file) && file_get_contents($hash_file) === $current_hash) {
            return; // No changes since last sync
        }

        // Get current file SHA from GitHub (needed for updates)
        $sha = $this->get_github_file_sha($file_path);

        // Push to GitHub
        $result = $this->push_to_github($file_path, $content, $sha);

        if ($result) {
            // Save hash to prevent duplicate syncs
            file_put_contents($hash_file, $current_hash);
        }
    }

    /**
     * Get SHA of existing file on GitHub
     */
    private function get_github_file_sha($file_path) {
        $url = sprintf(
            'https://api.github.com/repos/%s/contents/%s?ref=%s',
            $this->github_repo,
            $file_path,
            $this->github_branch
        );

        $response = wp_remote_get($url, array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->github_token,
                'Accept' => 'application/vnd.github.v3+json',
                'User-Agent' => 'LUVEX-Error-Logger/1.1'
            )
        ));

        if (is_wp_error($response)) {
            return null;
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        return $body['sha'] ?? null;
    }

    /**
     * Push file to GitHub via API
     */
    private function push_to_github($file_path, $content, $sha = null) {
        $url = sprintf(
            'https://api.github.com/repos/%s/contents/%s',
            $this->github_repo,
            $file_path
        );

        $data = array(
            'message' => 'chore: Auto-sync error logs ' . date('Y-m-d H:i'),
            'content' => base64_encode($content),
            'branch' => $this->github_branch
        );

        // If file exists, include SHA for update
        if ($sha) {
            $data['sha'] = $sha;
        }

        $response = wp_remote_request($url, array(
            'method' => 'PUT',
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->github_token,
                'Accept' => 'application/vnd.github.v3+json',
                'Content-Type' => 'application/json',
                'User-Agent' => 'LUVEX-Error-Logger/1.1'
            ),
            'body' => json_encode($data)
        ));

        if (is_wp_error($response)) {
            error_log('LUVEX Error Logger: GitHub sync failed - ' . $response->get_error_message());
            return false;
        }

        $code = wp_remote_retrieve_response_code($response);

        if ($code === 200 || $code === 201) {
            return true;
        }

        error_log('LUVEX Error Logger: GitHub sync failed - HTTP ' . $code);
        return false;
    }
}

// Initialize plugin
new LuvexErrorLogger();

// Cleanup on deactivation
register_deactivation_hook(__FILE__, function() {
    wp_clear_scheduled_hook('luvex_sync_errors_to_github');
});
