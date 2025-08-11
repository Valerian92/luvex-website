<?php
/**
 * Login Page Template
 * * @package Luvex
 * @since 2.1.0
 */

get_header(); ?>

<section class="luvex-hero luvex-hero--auth">
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            Welcome Back to <span class="text-highlight">LUVEX</span>
        </h1>
        <p class="luvex-hero__description">
            Access your UV simulator settings, saved projects, and community features.
        </p>
    </div>
</section>

<section class="auth-form-section">
    <div class="container--narrow">
        <div class="auth-form-container">
            
            <?php if (isset($_GET['registered'])) : ?>
                <div class="auth-success-message">
                    <i class="fa-solid fa-check-circle"></i>
                    <p>Registration successful! Please log in with your credentials.</p>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])) : ?>
                <div class="auth-error-message">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <p>Login failed. Please check your credentials and try again.</p>
                </div>
            <?php endif; ?>

            <form class="luvex-auth-form" method="post" action="">
                <?php wp_nonce_field('luvex_login_form'); ?>
                
                <!-- FIX: Changed type to "text" and updated label to allow username or email -->
                <div class="floating-label-input floating-label-input--dark">
                    <input type="text" name="user_login" id="user_login" placeholder=" " required>
                    <label for="user_login">Username or Email</label>
                </div>
                
                <div class="floating-label-input floating-label-input--dark">
                    <input type="password" name="user_password" id="user_password" placeholder=" " required>
                    <label for="user_password">Password</label>
                </div>
                
                <div class="auth-options">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember_me">
                        <span class="form-checkbox__indicator"></span>
                        <span class="form-checkbox__text">Keep me logged in</span>
                    </label>
                    
                    <a href="<?php echo wp_lostpassword_url(); ?>" class="auth-link">
                        Forgot password?
                    </a>
                </div>
                
                <button type="submit" name="luvex_login_submit" class="form-submit form-submit--accent">
                    <span>Sign In</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                
            </form>
            
            <div class="auth-alternative">
                <p>Don't have an account yet?</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'register' ) ) ); ?>" class="auth-cta-link">
                    Create Your LUVEX Account
                </a>
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>
