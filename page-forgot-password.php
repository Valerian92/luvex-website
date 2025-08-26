<?php
/*
Template Name: Forgot Password Page
*/

get_header(); ?>

<!-- Main Authentication Section -->
<main class="auth-page-wrapper">
    <div class="container">
        <div class="auth-form-container" style="max-width: 500px;">

            <!-- Tab Navigation -->
            <div class="auth-tabs">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="auth-tab">
                    Login
                </a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'register' ) ) ); ?>" class="auth-tab">
                    Register
                </a>
            </div>

            <div class="auth-tab-content active" style="padding: 2.5rem;">
                
                <?php if (isset($_GET['checkemail']) && $_GET['checkemail'] === 'confirm'): ?>
                    
                    <div class="auth-success-message auth-success-message--enhanced">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        <div>
                            <p><strong>Check your email</strong></p>
                            <p>If an account with that email exists, we have sent a password reset link to it.</p>
                        </div>
                    </div>

                <?php else: ?>

                    <div class="form-header" style="text-align: left; margin-bottom: 2rem;">
                        <h2 style="color: var(--luvex-white);">Reset Password</h2>
                        <p style="color: var(--luvex-gray-300); font-size: var(--text-base);">Enter your email address and we will send you a link to reset your password.</p>
                    </div>

                    <!-- Error Messages -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="auth-error-message auth-error-message--enhanced">
                            <i class="fa-solid fa-exclamation-triangle"></i>
                            <div>
                                <p><strong>Error</strong></p>
                                <p>Please provide a valid email address.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form class="luvex-auth-form" method="post" action="">
                        <?php wp_nonce_field('luvex_forgot_password_form'); ?>
                        
                        <div class="floating-label-input floating-label-input--dark">
                            <input type="email" name="user_email" id="user_email" placeholder=" " required>
                            <label for="user_email">Email Address</label>
                        </div>

                        <?php echo LuvexSecurity::get_security_fields(); ?>
                        
                        <button type="submit" name="luvex_forgot_password_submit" class="btn--primary form-submit--enhanced">
                            Send Reset Link
                        </button>
                    </form>

                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
