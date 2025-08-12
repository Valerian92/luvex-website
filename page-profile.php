<?php
/*
Template Name: Profile Page
*/

// Redirect if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

$current_user = wp_get_current_user();

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

get_header(); ?>

<!-- Hero Section with Avatar -->
<section class="luvex-hero luvex-hero--profile section-pattern-2">
    <div class="luvex-hero__container container--narrow">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">Your Profile</h1>
            <p class="luvex-hero__description">Manage your account settings, community preferences, and connect with the LUVEX community.</p>
        </div>
        <div class="luvex-hero__profile">
            <div class="profile-avatar-large" data-modal="avatarModal">
                <?php echo luvex_get_user_avatar($current_user->ID); ?>
                <span class="avatar-plus">+</span>
            </div>
        </div>
    </div>
</section>

<!-- Profile Dashboard -->
<section class="profile-dashboard">
    <div class="container">
        
        <!-- Quick Actions -->
        <div class="profile-quick-actions">
            <h3 class="quick-actions__title">Quick Actions</h3>
            <div class="quick-actions-grid">
                <a href="#" class="quick-action-card">
                    <i class="fa-solid fa-camera"></i>
                    <h4>Update Photo</h4>
                    <p>Change your profile picture</p>
                </a>
                <a href="<?php echo home_url('/uv-analyzer'); ?>" class="quick-action-card">
                    <i class="fa-solid fa-sun"></i>
                    <h4>UV Analysis</h4>
                    <p>Check your UV protection level</p>
                </a>
                <a href="#" class="quick-action-card">
                    <i class="fa-solid fa-users"></i>
                    <h4>Community</h4>
                    <p>Connect with other members</p>
                </a>
                <a href="#" class="quick-action-card">
                    <i class="fa-solid fa-bell"></i>
                    <h4>Notifications</h4>
                    <p>Manage your preferences</p>
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
                        <li class="profile-nav__item">
                            <a href="#community-settings" class="profile-nav__link profile-nav-link" data-section="community-settings">
                                <i class="fa-solid fa-users"></i>
                                Community Settings
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

                        <button type="submit" class="form-submit form-submit--accent">
                            <i class="fa-solid fa-save"></i>
                            Update Profile Information
                        </button>
                    </form>
                </div>

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
                            <input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" <?php checked($newsletter_subscription, 'yes'); ?>>
                            <div class="form-checkbox__indicator">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="form-checkbox__text">
                                <strong>LUVEX Newsletter</strong><br>
                                Receive our weekly newsletter with UV protection tips and product updates.
                            </div>
                        </div>

                        <div class="form-checkbox">
                            <input type="checkbox" id="uv_news_notifications" name="uv_news_notifications" <?php checked($uv_news_notifications, 'yes'); ?>>
                            <div class="form-checkbox__indicator">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="form-checkbox__text">
                                <strong>UV-News Notifications</strong><br>
                                Get notified when new articles and research are published.
                            </div>
                        </div>

                        <div class="form-checkbox">
                            <input type="checkbox" id="community_notifications" name="community_notifications" <?php checked($community_notifications, 'yes'); ?>>
                            <div class="form-checkbox__indicator">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="form-checkbox__text">
                                <strong>Community Activity</strong><br>
                                Receive notifications when other members interact with your posts.
                            </div>
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

                        <button type="submit" class="form-submit form-submit--accent">
                            <i class="fa-solid fa-save"></i>
                            Update Community Settings
                        </button>
                    </form>
                </div>

                <!-- Password & Security Section -->
                <div id="security" class="profile-section">
                    <div class="profile-section__header">
                        <div class="header-content">
                            <h2>Password & Security</h2>
                            <p>Manage your account security and login preferences.</p>
                        </div>
                    </div>

                    <div class="security-placeholder">
                        <div class="modal-content__section">
                            <h4 class="modal-content__section-title">Change Password</h4>
                            <p>Update your account password for better security.</p>
                            <button class="modal-btn modal-btn--secondary" disabled>
                                <i class="fa-solid fa-lock"></i>
                                Coming Soon
                            </button>
                        </div>

                        <div class="modal-content__section">
                            <h4 class="modal-content__section-title">Login History</h4>
                            <p>View your recent login activity and locations.</p>
                            <button class="modal-btn modal-btn--secondary" disabled>
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                Coming Soon
                            </button>
                        </div>

                        <div class="modal-content__section">
                            <h4 class="modal-content__section-title">Two-Factor Authentication</h4>
                            <p>Add an extra layer of security to your account.</p>
                            <button class="modal-btn modal-btn--secondary" disabled>
                                <i class="fa-solid fa-shield-halved"></i>
                                Coming Soon
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Avatar Upload Modal (using existing modal system) -->
<div id="avatarModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <div class="modal-header__content">
                <i class="modal-header__icon fa-solid fa-camera"></i>
                <h3 class="modal-header__title">Update Profile Picture</h3>
            </div>
            <div class="modal-header__actions">
                <button class="modal-header__action" data-modal-close>
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
        
        <div class="modal-content">
            <div class="modal-content__section">
                <h4 class="modal-content__section-title">Current Avatar</h4>
                <div class="current-avatar">
                    <div class="header-avatar">
                        <?php echo luvex_get_user_avatar($current_user->ID); ?>
                    </div>
                </div>
            </div>
            
            <div class="modal-content__section">
                <h4 class="modal-content__section-title">Upload New Picture</h4>
                <input type="file" id="avatarFileInput" accept="image/*" style="display: none;">
                <button class="modal-btn modal-btn--primary" onclick="document.getElementById('avatarFileInput').click();">
                    <i class="fa-solid fa-upload"></i>
                    Choose Image
                </button>
            </div>
        </div>
        
        <div class="modal-footer modal-footer--right">
            <div class="modal-footer__actions">
                <button class="modal-btn modal-btn--secondary" data-modal-close>Cancel</button>
                <button id="saveAvatarBtn" class="modal-btn modal-btn--accent" style="display: none;">
                    <i class="fa-solid fa-save"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Profile section navigation
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.profile-nav-link');
    const sections = document.querySelectorAll('.profile-section');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active states
            navLinks.forEach(l => l.closest('.profile-nav__item').classList.remove('profile-nav__item--active'));
            sections.forEach(s => s.classList.remove('profile-section--active'));
            
            // Add active state to clicked link
            this.closest('.profile-nav__item').classList.add('profile-nav__item--active');
            
            // Show corresponding section
            const sectionId = this.getAttribute('data-section');
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.add('profile-section--active');
            }
        });
    });
    
    // Bio character counter
    const bioTextarea = document.getElementById('user_bio');
    const bioCounter = document.getElementById('bio-counter');
    
    if (bioTextarea && bioCounter) {
        function updateCounter() {
            const length = bioTextarea.value.length;
            bioCounter.textContent = length;
            bioCounter.style.color = length > 450 ? 'var(--luvex-vibrant-blue)' : 'var(--luvex-gray-700)';
        }
        
        bioTextarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    }
});
</script>

<?php get_footer(); ?>