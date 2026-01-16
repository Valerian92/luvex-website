/**
 * LUVEX Error Tracker - Frontend JavaScript Error Logger
 * Captures console errors, unhandled promise rejections, and sends them to WordPress
 */

(function() {
    'use strict';

    // Check if error logger is available
    if (typeof luvexErrorLogger === 'undefined') {
        console.warn('LUVEX Error Logger: Configuration not loaded');
        return;
    }

    /**
     * Send error to WordPress backend
     */
    function logError(errorData) {
        // Add git commit info
        errorData.git_commit = luvexErrorLogger.git_commit;

        // Send via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', luvexErrorLogger.ajaxurl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        var params = new URLSearchParams({
            action: 'log_js_error',
            nonce: luvexErrorLogger.nonce,
            message: errorData.message || 'Unknown error',
            source: errorData.source || '',
            lineno: errorData.lineno || 0,
            colno: errorData.colno || 0,
            stack: errorData.stack || '',
            url: window.location.href
        });

        xhr.send(params.toString());
    }

    /**
     * Global error handler
     */
    window.addEventListener('error', function(event) {
        var errorData = {
            message: event.message,
            source: event.filename,
            lineno: event.lineno,
            colno: event.colno,
            stack: event.error ? event.error.stack : '',
            url: window.location.href
        };

        logError(errorData);

        // Don't suppress default error handling
        return false;
    }, true);

    /**
     * Unhandled Promise rejection handler
     */
    window.addEventListener('unhandledrejection', function(event) {
        var errorData = {
            message: 'Unhandled Promise Rejection: ' + (event.reason ? event.reason.message || event.reason : 'Unknown'),
            source: 'Promise',
            lineno: 0,
            colno: 0,
            stack: event.reason && event.reason.stack ? event.reason.stack : '',
            url: window.location.href
        };

        logError(errorData);

        // Don't suppress default handling
        return false;
    });

    /**
     * Console error override (optional, captures console.error calls)
     */
    var originalConsoleError = console.error;
    console.error = function() {
        // Call original console.error
        originalConsoleError.apply(console, arguments);

        // Log to our system
        var message = Array.prototype.slice.call(arguments).join(' ');
        var errorData = {
            message: 'Console Error: ' + message,
            source: 'console.error',
            lineno: 0,
            colno: 0,
            stack: new Error().stack || '',
            url: window.location.href
        };

        logError(errorData);
    };

    // Log that tracker is loaded
    console.log('[LUVEX Error Logger] Initialized (Commit: ' + luvexErrorLogger.git_commit + ')');

})();
