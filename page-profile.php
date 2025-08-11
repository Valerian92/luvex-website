<?php
/**
 * Profile Page Template (Optimized)
 * * @package Luvex
 * @since 2.3.1
 */

// Redirect if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login/'));
    exit;
}

$current_user = wp_get_current_user();

get_header(); ?>

<!-- 1. Hero Section with Profile Avatar -->
<section class="luvex-hero luvex-hero--profile">
    <div class="luvex-hero__container">
        <div class="luvex-hero__content">
            <h1 class="luvex-hero__title">
                Welcome, <span class="text-highlight"><?php echo esc_html($current_user->first_name ?: $current_user->display_name); ?></span>
            </h1>
            <p class="luvex-hero__description">
                Manage your account, settings, and community preferences.
            </p>
        </div>
        <div class="luvex-hero__profile">
            <div class="profile-avatar-large" onclick="openProfileModal()">
                <?php 
                $first_name = $current_user->first_name ?: $current_user->display_name;
                $last_name = $current_user->last_name ?: '';
                $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
                echo $initials ?: '?';
                ?>
                <div class="avatar-plus">+</div>
            </div>
        </div>
    </div>
</section>


<!-- 2. Main Dashboard Section -->
<section class="profile-dashboard">
    <div class="container container--wide">

        <!-- 3. Quick Actions moved to the top and styled as a distinct container -->
        <div class="profile-quick-actions">
            <h3 class="quick-actions__title">Quick Actions</h3>
            <div class="quick-actions-grid">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="quick-action-card has-shine-effect">
                    <i class="fa-solid fa-cube"></i>
                    <h4>UV Simulator</h4>
                    <p>Access advanced features</p>
                </a>
                
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="quick-action-card has-shine-effect">
                    <i class="fa-solid fa-calendar"></i>
                    <h4>Book Consultation</h4>
                    <p>Schedule expert session</p>
                </a>
                
                <div class="quick-action-card has-shine-effect analyzer-shortcode">
                    <i class="fa-solid fa-microscope"></i>
                    <h4>UV Strip Analyzer</h4>
                    <p>Analyze UV dosimeter strips</p>
                    <?php echo do_shortcode('[luvex_uvstrip_analyzer]'); ?>
                </div>

                <a href="<?php echo wp_logout_url(home_url()); ?>" class="quick-action-card quick-action-card--secondary">
                    <i class="fa-solid fa-sign-out-alt"></i>
                    <h4>Sign Out</h4>
                    <p>Log out of your account</p>
                </a>
            </div>
        </div>

        <!-- 4. New Two-Column Layout -->
        <div class="profile-layout">
            
            <!-- Profile Navigation (Sticky) -->
            <aside class="profile-sidebar">
                <nav class="profile-nav">
                    <h3 class="profile-nav__title">Settings</h3>
                    <ul class="profile-nav__list">
                        <li class="profile-nav__item profile-nav__item--active">
                            <a href="#profile-info" class="profile-nav__link">
                                <i class="fa-solid fa-user-circle"></i>
                                <span>Profile Information</span>
                            </a>
                        </li>
                        <li class="profile-nav__item">
                            <a href="#simulator-settings" class="profile-nav__link">
                                <i class="fa-solid fa-sliders"></i>
                                <span>Simulator Settings</span>
                            </a>
                        </li>
                        <li class="profile-nav__item">
                            <a href="#community-preferences" class="profile-nav__link">
                                <i class="fa-solid fa-users-cog"></i>
                                <span>Community</span>
                            </a>
                        </li>
                         <li class="profile-nav__item">
                            <a href="#security" class="profile-nav__link">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Password & Security</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>
            
            <!-- Profile Content -->
            <main class="profile-content">
                
                <!-- Profile Info Section -->
                <div id="profile-info" class="profile-section profile-section--active">
                    <div class="profile-section__header">
                        <h2>Profile Information</h2>
                        <p>Update your personal information and account details.</p>
                    </div>
                    
                    <form class="luvex-profile-form" method="post" action="">
                        <?php wp_nonce_field('luvex_profile_update'); ?>
                        
                        <div class="form-grid form-grid--2-cols">
                            <div class="floating-label-input">
                                <input type="text" name="first_name" id="first_name" placeholder=" " 
                                       value="<?php echo esc_attr($current_user->first_name); ?>">
                                <label for="first_name">First Name</label>
                            </div>
                            
                            <div class="floating-label-input">
                                <input type="text" name="last_name" id="last_name" placeholder=" "
                                       value="<?php echo esc_attr($current_user->last_name); ?>">
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>
                        
                        <div class="floating-label-input">
                            <input type="email" name="user_email" id="user_email" placeholder=" "
                                   value="<?php echo esc_attr($current_user->user_email); ?>" required>
                            <label for="user_email">Email Address</label>
                        </div>
                        
                        <div class="floating-label-input">
                            <input type="text" name="company" id="company" placeholder=" "
                                   value="<?php echo esc_attr(get_user_meta($current_user->ID, 'company', true)); ?>">
                            <label for="company">Company</label>
                        </div>
                        
                        <div class="floating-label-input">
                            <select name="interest_area" id="interest_area">
                                <?php $current_interest = get_user_meta($current_user->ID, 'interest_area', true); ?>
                                <option value="">Select your primary interest</option>
                                <option value="water-treatment" <?php selected($current_interest, 'water-treatment'); ?>>Water Treatment</option>
                                <option value="air-purification" <?php selected($current_interest, 'air-purification'); ?>>Air Purification</option>
                                <option value="uv-curing" <?php selected($current_interest, 'uv-curing'); ?>>UV Curing</option>
                                <option value="led-uv" <?php selected($current_interest, 'led-uv'); ?>>LED UV Systems</option>
                                <option value="mercury-uv" <?php selected($current_interest, 'mercury-uv'); ?>>Mercury UV Lamps</option>
                                <option value="research" <?php selected($current_interest, 'research'); ?>>Research & Development</option>
                                <option value="consulting" <?php selected($current_interest, 'consulting'); ?>>UV Consulting</option>
                                <option value="other" <?php selected($current_interest, 'other'); ?>>Other</option>
                            </select>
                            <label for="interest_area">Primary UV Interest</label>
                        </div>
                        
                        <button type="submit" name="luvex_profile_update_submit" class="form-submit form-submit--primary">
                            <span>Update Profile</span>
                            <i class="fa-solid fa-save"></i>
                        </button>
                    </form>
                </div>

                <!-- Placeholder for other sections -->
                <div id="simulator-settings" class="profile-section" style="display: none;">
                     <div class="profile-section__header">
                        <h2>Simulator Settings</h2>
                        <p>Customize your UV simulator experience.</p>
                    </div>
                    <!-- Content for simulator settings goes here -->
                </div>

                 <div id="community-preferences" class="profile-section" style="display: none;">
                     <div class="profile-section__header">
                        <h2>Community Preferences</h2>
                        <p>Manage your public profile and notifications.</p>
                    </div>
                    <!-- Content for community preferences goes here -->
                </div>

                <div id="security" class="profile-section" style="display: none;">
                     <div class="profile-section__header">
                        <h2>Password & Security</h2>
                        <p>Change your password and manage security settings.</p>
                    </div>
                     <!-- Content for security settings goes here -->
                </div>

            </main>
        </div>
    </div>
</section>

<?php get_footer(); ?>
