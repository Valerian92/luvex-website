<?php
/**
 * Profile Page Template
 * 
 * @package Luvex
 * @since 2.0.0
 */

// Redirect if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login/'));
    exit;
}

$current_user = wp_get_current_user();

get_header(); ?>

<<section class="luvex-hero">
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            Welcome, <span class="text-highlight"><?php echo esc_html($current_user->first_name ?: $current_user->display_name); ?></span>
        </h1>
        <p class="luvex-hero__description">
            Manage your LUVEX account, simulator settings, and community preferences.
        </p>
    </div>
</section>

<section class="profile-dashboard">
    <div class="container container--narrow">
        <div class="profile-layout">
            
            <!-- Profile Navigation -->
            <nav class="profile-nav">
                <ul class="profile-nav__list">
                    <li class="profile-nav__item profile-nav__item--active">
                        <a href="#profile-info" class="profile-nav__link">
                            <i class="fa-solid fa-user"></i>
                            Profile Info
                        </a>
                    </li>
                    <li class="profile-nav__item">
                        <a href="#simulator-settings" class="profile-nav__link">
                            <i class="fa-solid fa-cog"></i>
                            Simulator Settings
                        </a>
                    </li>
                    <li class="profile-nav__item">
                        <a href="#community-preferences" class="profile-nav__link">
                            <i class="fa-solid fa-users"></i>
                            Community
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Profile Content -->
            <div class="profile-content">
                
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
                
                <!-- Quick Actions -->
                <div class="profile-quick-actions">
                    <h3>Quick Actions</h3>
                    <div class="quick-actions-grid">
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'uv-simulator' ) ) ); ?>" class="quick-action-card">
                            <i class="fa-solid fa-cube"></i>
                            <h4>UV Simulator</h4>
                            <p>Access advanced features</p>
                        </a>
                        
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="quick-action-card">
                            <i class="fa-solid fa-calendar"></i>
                            <h4>Book Consultation</h4>
                            <p>Schedule expert session</p>
                        </a>
                        
                        <a href="https://analyzer.luvex.tech" target="_blank" class="quick-action-card">
                            <i class="fa-solid fa-microscope"></i>
                            <h4>UV Strip Analyzer</h4>
                            <p>Analyze UV dosimeter strips</p>
                        </a>

                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="quick-action-card quick-action-card--secondary">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <h4>Sign Out</h4>
                            <p>Log out of your account</p>
                        </a>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>