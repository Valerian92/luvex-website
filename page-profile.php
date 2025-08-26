<?php
/*
Template Name: Profile Page - With Language System
*/

// Redirect if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

$current_user = wp_get_current_user();
$user_display_name = !empty($current_user->first_name) ? $current_user->first_name : $current_user->display_name;

// Handle form submissions
if ($_POST && isset($_POST['profile_nonce']) && wp_verify_nonce($_POST['profile_nonce'], 'update_profile')) {
    
    // Basic Info Update
    if (isset($_POST['action']) && $_POST['action'] === 'update_basic_info') {
        $user_data = array(
            'ID' => $current_user->ID,
            'first_name' => sanitize_text_field($_POST['first_name']),
            'last_name' => sanitize_text_field($_POST['last_name']),
            'user_email' => sanitize_email($_POST['user_email'])
        );
        
        // Community fields
        update_user_meta($current_user->ID, 'nickname_display', sanitize_text_field($_POST['nickname_display']));
        update_user_meta($current_user->ID, 'user_bio', sanitize_textarea_field($_POST['user_bio']));
        update_user_meta($current_user->ID, 'expertise_tags', sanitize_text_field($_POST['expertise_tags']));
        update_user_meta($current_user->ID, 'instagram_url', esc_url_raw($_POST['instagram_url']));
        update_user_meta($current_user->ID, 'linkedin_url', esc_url_raw($_POST['linkedin_url']));
        update_user_meta($current_user->ID, 'website_url', esc_url_raw($_POST['website_url']));
        
        wp_update_user($user_data);
        $success_message = "Profile updated successfully!";
    }
    
    // Community Settings Update
    if (isset($_POST['action']) && $_POST['action'] === 'update_community_settings') {
        update_user_meta($current_user->ID, 'newsletter_subscription', isset($_POST['newsletter_subscription']) ? 'yes' : 'no');
        update_user_meta($current_user->ID, 'uv_news_notifications', isset($_POST['uv_news_notifications']) ? 'yes' : 'no');
        update_user_meta($current_user->ID, 'community_notifications', isset($_POST['community_notifications']) ? 'yes' : 'no');
        update_user_meta($current_user->ID, 'profile_visibility', sanitize_text_field($_POST['profile_visibility']));
        
        $success_message = "Community settings updated successfully!";
    }
    
    // Language Settings Update
    if (isset($_POST['action']) && $_POST['action'] === 'update_language_settings') {
        $preferred_language = sanitize_text_field($_POST['preferred_language']);
        $auto_detect = isset($_POST['auto_detect_language']) ? 'yes' : 'no';
        
        // Validate language code
        if (function_exists('LuvexUserSystem::get_supported_languages')) {
            $supported_langs = LuvexUserSystem::get_supported_languages();
            if ($preferred_language && !array_key_exists($preferred_language, $supported_langs)) {
                $error_message = "Invalid language selected.";
            } else {
                update_user_meta($current_user->ID, 'preferred_language', $preferred_language);
                update_user_meta($current_user->ID, 'auto_detect_language', $auto_detect);
                
                // Update cookie for immediate effect
                if ($preferred_language) {
                    setcookie('luvex_preferred_language', $preferred_language, time() + (30 * 24 * 3600), '/');
                } else {
                    // Clear cookie if auto-detect is selected
                    setcookie('luvex_preferred_language', '', time() - 3600, '/');
                }
                
                $success_message = "Language preferences updated successfully!";
            }
        } else {
            $error_message = "Language system not available.";
        }
    }
}

// Get user meta data
$nickname_display = get_user_meta($current_user->ID, 'nickname_display', true);
$user_bio = get_user_meta($current_user->ID, 'user_bio', true);
$expertise_tags = get_user_meta($current_user->ID, 'expertise_tags', true);
$instagram_url = get_user_meta($current_user->ID, 'instagram_url', true);
$linkedin_url = get_user_meta($current_user->ID, 'linkedin_url', true);
$website_url = get_user_meta($current_user->ID, 'website_url', true);
$newsletter_subscription = get_user_meta($current_user->ID, 'newsletter_subscription', true);
$uv_news_notifications = get_user_meta($current_user->ID, 'uv_news_notifications', true);
$community_notifications = get_user_meta($current_user->ID, 'community_notifications', true);
$profile_visibility = get_user_meta($current_user->ID, 'profile_visibility', true) ?: 'public';

// Language settings
$preferred_language = get_user_meta($current_user->ID, 'preferred_language', true);
$auto_detect_language = get_user_meta($current_user->ID, 'auto_detect_language', true) ?: 'yes';
$supported_languages = function_exists('LuvexUserSystem::get_supported_languages') ? LuvexUserSystem::get_supported_languages() : [];

get_header(); ?>

<!-- Hero Section with Wave Animation -->
<section class="luvex-hero luvex-hero--profile section-pattern-2">
    <div class="luvex-hero__container container--narrow">
        <div class="luvex-hero__content">
            <!-- MODIFICATION: Personalized greeting -->
            <h1 class="luvex-hero__title">Welcome back, <span class="text-highlight"><?php echo esc_html($user_display_name); ?>!</span></h1>
            <p class="luvex-hero__description">Manage your account settings, language preferences, community options, and connect with the LUVEX community.</p>
        </div>
    </div>
    
    <!-- Elegant Wave Animation -->
    <div class="hero-waves">
        <div class="wave wave-1"></div>
        <div class="wave wave-2"></div>
        <div class="wave wave-3"></div>
    </div>
</section>

<!-- Profile Dashboard -->
<section class="profile-dashboard">
    <div class="container">
        
        <!-- Quick Actions -->
        <div class="profile-quick-actions">
            <h3 class="quick-actions__title">Quick Actions</h3>
            <div class="quick-actions-grid">
                <a href="#" data-modal="avatarModal" class="quick-action-card">
                    <i class="fa-solid fa-camera"></i>
                    <h4>Update Photo</h4>
                    <p>Change your profile picture</p>
                </a>
                <a href="https://simulator.luvex.tech" target="_blank" class="quick-action-card">
                    <i class="fa-solid fa-sun"></i>
                    <h4>UV Simulator</h4>
                    <p>Simulate UV conditions and protection</p>
                </a>
                <a href="https://analyzer.luvex.tech" target="_blank" class="quick-action-card">
                    <i class="fa-solid fa-microscope"></i>
                    <h4>Strip Analyzer</h4>
                    <p>Analyze UV dose measurement strips</p>
                </a>
                <a href="#language-settings" class="quick-action-card profile-nav-link" data-section="language-settings">
                    <i class="fa-solid fa-globe"></i>
                    <h4>Language</h4>
                    <p>Set your language preferences</p>
                </a>
                <a href="#community-settings" class="quick-action-card profile-nav-link" data-section="community-settings">
                    <i class="fa-solid fa-users"></i>
                    <h4>Community</h4>
                    <p>Manage community preferences</p>
                </a>
            </div>
        </div>

        <!-- Profile Layout -->
        <div class="profile-layout">
            
            <!-- Sidebar Navigation -->
            <div class="profile-sidebar">
                <nav class="profile-nav">
                    <h3 class="profile-nav__title">Settings</h3>
                    <ul class="profile-nav__list">
                        <li class="profile-nav__item profile-nav__item--active">
                            <a href="#profile-info" class="profile-nav__link profile-nav-link" data-section="profile-info">
                                <i class="fa-solid fa-user"></i>
                                Profile Information
                            </a>
                        </li>
                        <?php if (function_exists('pll_the_languages') && !empty($supported_languages)) : ?>
                        <li class="profile-nav__item">
                            <a href="#language-settings" class="profile-nav__link profile-nav-link" data-section="language-settings">
                                <i class="fa-solid fa-globe"></i>
                                Language & Region
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="profile-nav__item">
                            <a href="#community-settings" class="profile-nav__link profile-nav-link" data-section="community-settings">
                                <i class="fa-solid fa-users"></i>
                                Community Settings
                            </a>
                        </li>
                        <li class="profile-nav__item">
                            <a href="#app-settings" class="profile-nav__link profile-nav-link" data-section="app-settings">
                                <i class="fa-solid fa-cog"></i>
                                Application Settings
                            </a>
                        </li>
                        <li class="profile-nav__item">
                            <a href="#security" class="profile-nav__link profile-nav-link" data-section="security">
                                <i class="fa-solid fa-shield-halved"></i>
                                Password & Security
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="profile-content">
                
                <?php if (isset($success_message)): ?>
                    <div class="auth-success-message">
                        <i class="fa-solid fa-check-circle"></i>
                        <p><?php echo $success_message; ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error_message)): ?>
                    <div class="auth-error-message">
                        <i class="fa-solid fa-exclamation-circle"></i>
                        <p><?php echo $error_message; ?></p>
                    </div>
                <?php endif; ?>

                <!-- Profile Information Section -->
                <div id="profile-info" class="profile-section profile-section--active">
                    <div class="profile-section__header">
                        <div class="header-content">
                            <h2>Profile Information</h2>
                            <p>Update your personal information and community profile details.</p>
                        </div>
                        <div class="header-avatar" data-modal="avatarModal">
                            <?php echo luvex_get_user_avatar($current_user->ID); ?>
                            <span class="avatar-plus">+</span>
                        </div>
                    </div>

                    <form method="post" class="profile-form">
                        <?php wp_nonce_field('update_profile', 'profile_nonce'); ?>
                        <input type="hidden" name="action" value="update_basic_info">
                        
                        <!-- Basic Information -->
                        <div class="form-grid form-grid--2-cols">
                            <div class="floating-label-input">
                                <input type="text" id="first_name" name="first_name" value="<?php echo esc_attr($current_user->first_name); ?>" placeholder=" " required>
                                <label for="first_name">First Name</label>
                            </div>

                            <div class="floating-label-input">
                                <input type="text" id="last_name" name="last_name" value="<?php echo esc_attr($current_user->last_name); ?>" placeholder=" " required>
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>

                        <div class="floating-label-input">
                            <input type="email" id="user_email" name="user_email" value="<?php echo esc_attr($current_user->user_email); ?>" placeholder=" " required>
                            <label for="user_email">Email Address</label>
                        </div>

                        <!-- Community Profile Fields -->
                        <div class="profile-section__divider">
                            <h4>Community Profile</h4>
                            <p>These details will be visible to other community members.</p>
                        </div>

                        <div class="floating-label-input">
                            <input type="text" id="nickname_display" name="nickname_display" value="<?php echo esc_attr($nickname_display); ?>" placeholder=" ">
                            <label for="nickname_display">Display Name/Nickname (Optional)</label>
                        </div>

                        <div class="floating-label-input">
                            <textarea id="user_bio" name="user_bio" placeholder=" " maxlength="500"><?php echo esc_textarea($user_bio); ?></textarea>
                            <label for="user_bio">Bio/About You</label>
                            <div class="character-counter">
                                <span id="bio-counter">0</span>/500 characters
                            </div>
                        </div>

                        <div class="floating-label-input">
                            <input type="text" id="expertise_tags" name="expertise_tags" value="<?php echo esc_attr($expertise_tags); ?>" placeholder=" ">
                            <label for="expertise_tags">Areas of Interest (e.g., UV Protection, Skincare, Product Testing)</label>
                        </div>

                        <!-- Social Media Links -->
                        <div class="profile-section__divider">
                            <h4>Social Media & Links</h4>
                            <p>Connect your social profiles (all optional).</p>
                        </div>

                        <div class="form-grid form-grid--2-cols">
                            <div class="floating-label-input">
                                <input type="url" id="instagram_url" name="instagram_url" value="<?php echo esc_attr($instagram_url); ?>" placeholder=" ">
                                <label for="instagram_url">Instagram Profile</label>
                            </div>

                            <div class="floating-label-input">
                                <input type="url" id="linkedin_url" name="linkedin_url" value="<?php echo esc_attr($linkedin_url); ?>" placeholder=" ">
                                <label for="linkedin_url">LinkedIn Profile</label>
                            </div>
                        </div>

                        <div class="floating-label-input">
                            <input type="url" id="website_url" name="website_url" value="<?php echo esc_attr($website_url); ?>" placeholder=" ">
                            <label for="website_url">Personal/Company Website</label>
                        </div>

                        <button type="submit" class="form-submit btn--primary">
                            <i class="fa-solid fa-save"></i>
                            Update Profile Information
                        </button>
                    </form>
                </div>

                <!-- Language & Region Settings Section -->
                <?php if (function_exists('pll_the_languages') && !empty($supported_languages)) : ?>
                <div id="language-settings" class="profile-section">
                    <div class="profile-section__header">
                        <div class="header-content">
                            <h2>Language & Region Settings</h2>
                            <p>Customize your language preferences and regional settings for the best experience.</p>
                        </div>
                    </div>

                    <form method="post" class="profile-form">
                        <?php wp_nonce_field('update_profile', 'profile_nonce'); ?>
                        <input type="hidden" name="action" value="update_language_settings">
                        
                        <!-- Current Language Display -->
                        <div class="profile-section__divider">
                            <h4>Current Language</h4>
                            <p>Your website is currently displayed in:</p>
                        </div>
                        
                        <div class="language-status-card">
                            <?php 
                            $current_lang = function_exists('luvex_get_current_language') ? luvex_get_current_language() : 'en';
                            $current_lang_data = $supported_languages[$current_lang] ?? ['name' => 'English', 'flag' => '🇺🇸'];
                            ?>
                            <div class="language-status-display">
                                <span class="language-flag-large"><?php echo $current_lang_data['flag']; ?></span>
                                <div class="language-info">
                                    <h4><?php echo esc_html($current_lang_data['name']); ?></h4>
                                    <p>Language Code: <strong><?php echo strtoupper($current_lang); ?></strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Language Preferences -->
                        <div class="profile-section__divider">
                            <h4>Language Preferences</h4>
                            <p>Choose how the website should determine your language.</p>
                        </div>

                        <div class="form-checkbox">
                            <label>
                                <input type="checkbox" id="auto_detect_language" name="auto_detect_language" <?php checked($auto_detect_language, 'yes'); ?>>
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">
                                    <strong>Auto-detect from browser</strong><br>
                                    Automatically set language based on your browser's language preference.
                                </span>
                            </label>
                        </div>

                        <div class="floating-label-input">
                            <select id="preferred_language" name="preferred_language">
                                <option value="">Use auto-detection</option>
                                <?php foreach ($supported_languages as $lang_code => $lang_data) : ?>
                                    <option value="<?php echo esc_attr($lang_code); ?>" <?php selected($preferred_language, $lang_code); ?>>
                                        <?php echo esc_html($lang_data['flag'] . ' ' . $lang_data['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="preferred_language">Preferred Language Override</label>
                        </div>

                        <button type="submit" class="form-submit btn--primary">
                            <i class="fa-solid fa-globe"></i>
                            Update Language Settings
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <!-- Community Settings Section -->
                <div id="community-settings" class="profile-section">
                    <div class="profile-section__header">
                        <div class="header-content">
                            <h2>Community Settings</h2>
                            <p>Manage your community preferences and notifications.</p>
                        </div>
                    </div>

                    <form method="post" class="profile-form">
                        <?php wp_nonce_field('update_profile', 'profile_nonce'); ?>
                        <input type="hidden" name="action" value="update_community_settings">
                        
                        <!-- Newsletter & Notifications -->
                        <div class="profile-section__divider">
                            <h4>Newsletter & Updates</h4>
                            <p>Choose what you'd like to receive from LUVEX.</p>
                        </div>

                        <div class="form-checkbox">
                             <label>
                                <input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" <?php checked($newsletter_subscription, 'yes'); ?>>
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">
                                    <strong>LUVEX Newsletter</strong><br>
                                    Receive our weekly newsletter with UV protection tips and product updates.
                                </span>
                            </label>
                        </div>

                        <div class="form-checkbox">
                             <label>
                                <input type="checkbox" id="uv_news_notifications" name="uv_news_notifications" <?php checked($uv_news_notifications, 'yes'); ?>>
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">
                                    <strong>UV-News Notifications</strong><br>
                                    Get notified when new articles and research are published.
                                </span>
                            </label>
                        </div>

                        <div class="form-checkbox">
                             <label>
                                <input type="checkbox" id="community_notifications" name="community_notifications" <?php checked($community_notifications, 'yes'); ?>>
                                <span class="form-checkbox__indicator"><i class="fa-solid fa-check"></i></span>
                                <span class="form-checkbox__text">
                                    <strong>Community Activity</strong><br>
                                    Receive notifications when other members interact with your posts.
                                </span>
                            </label>
                        </div>

                        <!-- Privacy Settings -->
                        <div class="profile-section__divider">
                            <h4>Privacy Settings</h4>
                            <p>Control who can see your profile information.</p>
                        </div>

                        <div class="floating-label-input">
                            <select id="profile_visibility" name="profile_visibility">
                                <option value="public" <?php selected($profile_visibility, 'public'); ?>>Public - Visible to all community members</option>
                                <option value="members" <?php selected($profile_visibility, 'members'); ?>>Members Only - Visible to logged-in users</option>
                                <option value="private" <?php selected($profile_visibility, 'private'); ?>>Private - Only visible to you</option>
                            </select>
                            <label for="profile_visibility">Profile Visibility</label>
                        </div>

                        <button type="submit" class="form-submit btn--primary">
                            <i class="fa-solid fa-save"></i>
                            Update Community Settings
                        </button>
                    </form>
                </div>

                <!-- Application Settings Section -->
                <div id="app-settings" class="profile-section">
                   <!-- Placeholder for now -->
                </div>

                <!-- Password & Security Section -->
                <div id="security" class="profile-section">
                    <div class="profile-section__header">
                        <div class="header-content">
                            <h2>Password & Security</h2>
                            <p>Manage your account security and login preferences.</p>
                        </div>
                    </div>
                    <!-- Placeholder for now -->
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Avatar Upload Modal (using existing modal system) -->
<div id="avatarModal" class="modal-overlay">
    <!-- Modal content as provided in your file -->
</div>

<script>
// Profile section navigation and other JS as provided in your file
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.profile-nav-link');
    const sections = document.querySelectorAll('.profile-section');
    
    function switchToSection(sectionId) {
        document.querySelectorAll('.profile-nav__item').forEach(i => i.classList.remove('profile-nav__item--active'));
        sections.forEach(s => s.classList.remove('profile-section--active'));
        
        const targetNavLink = document.querySelector(`.profile-nav__link[data-section="${sectionId}"]`);
        if (targetNavLink) {
            targetNavLink.closest('.profile-nav__item').classList.add('profile-nav__item--active');
        }
        
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            targetSection.classList.add('profile-section--active');
        }
    }
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.getAttribute('data-section')) {
                e.preventDefault();
                const sectionId = this.getAttribute('data-section');
                window.location.hash = sectionId;
                switchToSection(sectionId);
            }
        });
    });
    
    function handleHashNavigation() {
        const hash = window.location.hash.replace('#', '');
        if (hash && document.getElementById(hash)) {
            switchToSection(hash);
        }
    }
    
    handleHashNavigation();
});
</script>

<?php get_footer(); ?>
