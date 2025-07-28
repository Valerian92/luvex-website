<?php
/**
 * Login Page Template
 * 
 * @package Luvex
 * @since 2.0.0
 */

get_header(); ?>

<section class="auth-hero">
    <div class="auth-hero__container container--narrow">
        <div class="auth-hero__content">
            <h1 class="auth-hero__title">
                Welcome Back to <span class="text-highlight">LUVEX</span>
            </h1>
            <p class="auth-hero__description">
                Access your UV simulator settings, saved projects, and community features.
            </p>
        </div>
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
                
                <div class="floating-label-input floating-label-input--dark">
                    <input type="email" name="user_email" id="user_email" placeholder=" " required>
                    <label for="user_email">Email Address</label>
                </div>
                
                <div class="floating-label-input floating-label-input--dark">
                    <input type="password" name="user_password" id="user_password" placeholder=" " required>
                    <label for="user_password">Password</label>
                </div>
                
                <div class="auth-options">
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember_me">
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
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