<?php
/**
 * Register Page Template
 * * @package Luvex
 * @since 2.0.0
 */

get_header(); ?>

<!-- The modifier class 'luvex-hero--auth' is added here to make the hero smaller -->
<section class="luvex-hero luvex-hero--auth">
    <div class="luvex-hero__container">
        <h1 class="luvex-hero__title">
            Join the <span class="text-highlight">LUVEX</span> Community
        </h1>
        <p class="luvex-hero__description">
            Access advanced UV simulator features, save your projects, and connect with UV experts worldwide.
        </p>
    </div>
</section>

<section class="auth-form-section">
    <div class="container--narrow">
        <div class="auth-form-container">
            
            <?php if (isset($_GET['error'])) : ?>
                <div class="auth-error-message">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <p>Registration failed. Please check your information and try again.</p>
                </div>
            <?php endif; ?>

            <form class="luvex-auth-form" method="post" action="">
                <?php wp_nonce_field('luvex_register_form'); ?>
                
                <div class="form-grid form-grid--2-cols">
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="text" name="first_name" id="first_name" placeholder=" " required>
                        <label for="first_name">First Name</label>
                    </div>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="text" name="last_name" id="last_name" placeholder=" " required>
                        <label for="last_name">Last Name</label>
                    </div>
                </div>
                
                <div class="floating-label-input floating-label-input--dark">
                    <input type="email" name="user_email" id="user_email" placeholder=" " required>
                    <label for="user_email">Email Address</label>
                </div>
                
                <div class="floating-label-input floating-label-input--dark">
                    <input type="text" name="company" id="company" placeholder=" ">
                    <label for="company">Company (Optional)</label>
                </div>
                
                <div class="form-grid form-grid--2-cols">
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="password" name="user_password" id="user_password" placeholder=" " required minlength="6">
                        <label for="user_password">Password (min. 6 characters)</label>
                    </div>
                    
                    <div class="floating-label-input floating-label-input--dark">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder=" " required>
                        <label for="confirm_password">Confirm Password</label>
                    </div>
                </div>
                
                <div class="floating-label-input floating-label-input--dark">
                    <select name="interest_area" id="interest_area">
                        <option value="">Select your primary interest</option>
                        <option value="water-treatment">Water Treatment</option>
                        <option value="air-purification">Air Purification</option>
                        <option value="uv-curing">UV Curing</option>
                        <option value="led-uv">LED UV Systems</option>
                        <option value="mercury-uv">Mercury UV Lamps</option>
                        <option value="research">Research & Development</option>
                        <option value="consulting">UV Consulting</option>
                        <option value="other">Other</option>
                    </select>
                    <label for="interest_area">Primary UV Interest</label>
                </div>
                
                <div class="auth-consent">
                    <label class="form-checkbox">
                        <input type="checkbox" name="terms_consent" required>
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="form-checkbox__text">
                            I agree to the Terms of Service and Privacy Policy
                        </span>
                    </label>
                    
                    <label class="form-checkbox">
                        <input type="checkbox" name="newsletter_consent">
                        <span class="form-checkbox__indicator">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="form-checkbox__text">
                            Send me UV technology updates and insights (optional)
                        </span>
                    </label>
                </div>
                
                <button type="submit" name="luvex_register_submit" class="form-submit form-submit--accent">
                    <span>Create Account</span>
                    <i class="fa-solid fa-user-plus"></i>
                </button>
                
            </form>
            
            <div class="auth-alternative">
                <p>Already have an account?</p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'login' ) ) ); ?>" class="auth-cta-link">
                    Sign In to LUVEX
                </a>
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>
