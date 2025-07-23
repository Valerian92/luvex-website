<?php
/**
 * Template for Simulator Login/Registration Page
 * Template Name: Simulator Login
 */

get_header(); ?>

<div class="auth-page-container">
    <?php if (is_user_logged_in()) : 
        // Already logged in - redirect or show dashboard
        $redirect_to = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : '/simulator/';
        ?>
        <section class="already-authenticated-section">
            <div class="content-wrapper">
                <div class="auth-success-card">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Already Authenticated</h2>
                    <p>You are already logged in as <strong><?php echo esc_html(wp_get_current_user()->display_name); ?></strong></p>
                    <div class="auth-actions">
                        <a href="<?php echo esc_url($redirect_to); ?>" class="cta-button">
                            <i class="fas fa-flask"></i> Continue to Simulator
                        </a>
                        <a href="/my-profile/" class="btn-outline">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                        <a href="<?php echo wp_logout_url('/'); ?>" class="btn-outline">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <!-- Authentication Forms -->
        <section class="auth-hero-section">
            <div class="auth-content-wrapper">
                
                <!-- Hero Content -->
                <div class="auth-hero-content">
                    <div class="hero-text">
                        <h1><i class="fas fa-atom uv-glow"></i> UV Simulator Access</h1>
                        <p class="hero-description">Join the professional UV simulation platform. Design, analyze, and optimize your UV disinfection systems with advanced simulation tools.</p>
                        
                        <div class="feature-highlights">
                            <div class="highlight-item">
                                <i class="fas fa-flask"></i>
                                <span>3D UV Simulation</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-save"></i>
                                <span>Save & Share Projects</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Advanced Analytics</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Auth Forms Container -->
                    <div class="auth-forms-container">
                        <div class="auth-tabs">
                            <button class="auth-tab active" data-tab="login">
                                <i class="fas fa-sign-in-alt"></i>
                                Login
                            </button>
                            <button class="auth-tab" data-tab="register">
                                <i class="fas fa-user-plus"></i>
                                Register
                            </button>
                        </div>
                        
                        <!-- Login Form -->
                        <div id="login-form" class="auth-form active">
                            <div class="form-header">
                                <h3>Welcome Back</h3>
                                <p>Sign in to continue your UV simulation work</p>
                            </div>
                            
                            <form id="simulator-login-form" class="auth-form-content">
                                <div class="form-group">
                                    <label for="login-username">Username or Email</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="login-username" name="username" required placeholder="Enter your username or email">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="login-password">Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="login-password" name="password" required placeholder="Enter your password">
                                        <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="form-options">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="remember-me">
                                        <span class="checkmark"></span>
                                        Remember me
                                    </label>
                                    <a href="#" class="forgot-password" onclick="showForgotPassword()">Forgot password?</a>
                                </div>
                                
                                <button type="submit" class="auth-submit-btn">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Sign In</span>
                                </button>
                                
                                <div class="form-footer">
                                    <p>Don't have an account? <a href="#" onclick="switchTab('register')">Create one now</a></p>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Registration Form -->
                        <div id="register-form" class="auth-form">
                            <div class="form-header">
                                <h3>Join UV Simulator</h3>
                                <p>Create your free account to start simulating</p>
                            </div>
                            
                            <form id="simulator-register-form" class="auth-form-content">
                                <div class="form-row">
                                    <div class="form-group half">
                                        <label for="register-first-name">First Name</label>
                                        <div class="input-wrapper">
                                            <i class="fas fa-user"></i>
                                            <input type="text" id="register-first-name" name="first_name" required placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="form-group half">
                                        <label for="register-last-name">Last Name</label>
                                        <div class="input-wrapper">
                                            <i class="fas fa-user"></i>
                                            <input type="text" id="register-last-name" name="last_name" required placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="register-email">Email Address</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="register-email" name="email" required placeholder="your.email@company.com">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="register-username">Username</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-at"></i>
                                        <input type="text" id="register-username" name="username" required placeholder="Choose a username">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="register-password">Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="register-password" name="password" required placeholder="Choose a strong password">
                                        <button type="button" class="password-toggle" onclick="togglePassword('register-password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength" id="password-strength">
                                        <div class="strength-bar">
                                            <div class="strength-fill"></div>
                                        </div>
                                        <div class="strength-text">Password strength</div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="register-confirm-password">Confirm Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="register-confirm-password" name="confirm_password" required placeholder="Confirm your password">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="register-company">Company/Organization (Optional)</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-building"></i>
                                        <input type="text" id="register-company" name="company" placeholder="Your company name">
                                    </div>
                                </div>
                                
                                <div class="form-options">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="terms-agreement" required>
                                        <span class="checkmark"></span>
                                        I agree to the <a href="/terms/" target="_blank">Terms of Service</a> and <a href="/privacy/" target="_blank">Privacy Policy</a>
                                    </label>
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="newsletter-signup">
                                        <span class="checkmark"></span>
                                        Send me updates about new features and UV technology insights
                                    </label>
                                </div>
                                
                                <button type="submit" class="auth-submit-btn">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Create Account</span>
                                </button>
                                
                                <div class="form-footer">
                                    <p>Already have an account? <a href="#" onclick="switchTab('login')">Sign in here</a></p>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Forgot Password Form -->
                        <div id="forgot-password-form" class="auth-form">
                            <div class="form-header">
                                <h3>Reset Password</h3>
                                <p>Enter your email to receive a password reset link</p>
                            </div>
                            
                            <form id="simulator-forgot-form" class="auth-form-content">
                                <div class="form-group">
                                    <label for="forgot-email">Email Address</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" id="forgot-email" name="email" required placeholder="your.email@company.com">
                                    </div>
                                </div>
                                
                                <button type="submit" class="auth-submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>Send Reset Link</span>
                                </button>
                                
                                <div class="form-footer">
                                    <p><a href="#" onclick="switchTab('login')">← Back to Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Benefits Section -->
                <div class="auth-benefits">
                    <h3>Why Choose LUVEX UV Simulator?</h3>
                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Scientific Accuracy</h4>
                                <p>Physics-based simulation engine with validated UV models and pathogen databases.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Industry Leading</h4>
                                <p>Trusted by professionals worldwide for water, air, and surface disinfection design.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Save Time</h4>
                                <p>Reduce design iterations and optimize UV systems before physical installation.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Collaboration</h4>
                                <p>Share simulations with your team and collaborate on UV system designs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Loading Overlay -->
            <div id="loading-overlay" class="loading-overlay" style="display: none;">
                <div class="loading-content">
                    <div class="loading-spinner">
                        <i class="fas fa-atom fa-spin"></i>
                    </div>
                    <div class="loading-text">Processing...</div>
                </div>
            </div>
            
            <!-- Success/Error Messages -->
            <div id="auth-message" class="auth-message" style="display: none;">
                <div class="message-content">
                    <div class="message-icon"></div>
                    <div class="message-text"></div>
                    <button class="message-close" onclick="hideMessage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>

<style>
/* Auth Page Styles */
.auth-page-container {
    min-height: 100vh;
    background: var(--luvex-dark-blue);
    position: relative;
    overflow: hidden;
}

/* Background Animation */
.auth-page-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 20% 30%, rgba(109, 213, 237, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(0, 123, 255, 0.15) 0%, transparent 50%);
    pointer-events: none;
}

/* Already Authenticated Section */
.already-authenticated-section {
    padding: calc(6rem + 80px) 2rem 4rem;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.auth-success-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    padding: 3rem;
    border-radius: 20px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    max-width: 500px;
    color: var(--luvex-text-on-dark);
}

.success-icon {
    font-size: 4rem;
    color: var(--luvex-bright-cyan);
    margin-bottom: 1.5rem;
}

.auth-success-card h2 {
    margin-bottom: 1rem;
    font-size: 2rem;
}

.auth-success-card p {
    margin-bottom: 2rem;
    opacity: 0.9;
}

.auth-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
}

/* Main Auth Section */
.auth-hero-section {
    padding: calc(6rem + 80px) 2rem 4rem;
    min-height: 100vh;
    position: relative;
    z-index: 2;
}

.auth-content-wrapper {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    min-height: calc(100vh - 200px);
}

/* Hero Content */
.auth-hero-content {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

.hero-text h1 {
    font-size: 3.5rem;
    color: var(--luvex-text-on-dark);
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-description {
    font-size: 1.3rem;
    color: var(--luvex-text-muted-dark);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.feature-highlights {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--luvex-text-on-dark);
    font-weight: 500;
}

.highlight-item i {
    color: var(--luvex-bright-cyan);
    font-size: 1.25rem;
    width: 20px;
    text-align: center;
}

/* Auth Forms Container */
.auth-forms-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.auth-tabs {
    display: flex;
    background: rgba(255, 255, 255, 0.05);
}

.auth-tab {
    flex: 1;
    padding: 1rem;
    background: transparent;
    border: none;
    color: var(--luvex-text-muted-dark);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border-bottom: 3px solid transparent;
}

.auth-tab.active {
    color: var(--luvex-bright-cyan);
    background: rgba(109, 213, 237, 0.1);
    border-bottom-color: var(--luvex-bright-cyan);
}

.auth-tab:hover:not(.active) {
    color: var(--luvex-text-on-dark);
    background: rgba(255, 255, 255, 0.05);
}

/* Auth Forms */
.auth-form {
    display: none;
    padding: 2.5rem;
}

.auth-form.active {
    display: block;
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.form-header h3 {
    color: var(--luvex-text-on-dark);
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.form-header p {
    color: var(--luvex-text-muted-dark);
    opacity: 0.8;
}

.auth-form-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: flex;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group.half {
    flex: 1;
}

.form-group label {
    color: var(--luvex-text-on-dark);
    font-weight: 600;
    font-size: 0.95rem;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 1rem;
    color: var(--luvex-text-muted-dark);
    z-index: 2;
}

.input-wrapper input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: var(--luvex-text-on-dark);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.input-wrapper input::placeholder {
    color: var(--luvex-text-muted-dark);
    opacity: 0.7;
}

.input-wrapper input:focus {
    outline: none;
    border-color: var(--luvex-bright-cyan);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 3px rgba(109, 213, 237, 0.2);
}

.password-toggle {
    position: absolute;
    right: 1rem;
    background: none;
    border: none;
    color: var(--luvex-text-muted-dark);
    cursor: pointer;
    padding: 0.5rem;
    z-index: 2;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: var(--luvex-bright-cyan);
}

/* Password Strength Indicator */
.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    overflow: hidden;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-fill.weak {
    width: 25%;
    background: #dc2626;
}

.strength-fill.fair {
    width: 50%;
    background: #f59e0b;
}

.strength-fill.good {
    width: 75%;
    background: #10b981;
}

.strength-fill.strong {
    width: 100%;
    background: var(--luvex-bright-cyan);
}

.strength-text {
    font-size: 0.85rem;
    color: var(--luvex-text-muted-dark);
    margin-top: 0.25rem;
}

/* Form Options */
.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    color: var(--luvex-text-on-dark);
    font-size: 0.95rem;
    line-height: 1.4;
}

.checkbox-wrapper input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 18px;
    height: 18px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 3px;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark {
    background: var(--luvex-bright-cyan);
    border-color: var(--luvex-bright-cyan);
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: var(--luvex-dark-blue);
    font-weight: bold;
    font-size: 0.8rem;
}

.forgot-password {
    color: var(--luvex-bright-cyan);
    text-decoration: none;
    font-size: 0.95rem;
    transition: opacity 0.3s ease;
}

.forgot-password:hover {
    opacity: 0.8;
}

/* Submit Button */
.auth-submit-btn {
    padding: 1.25rem 2rem;
    background: linear-gradient(135deg, var(--luvex-accent-blue), var(--luvex-bright-cyan));
    color: var(--luvex-text-on-dark);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 1rem;
    position: relative;
    overflow: hidden;
}

.auth-submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.auth-submit-btn:hover::before {
    left: 100%;
}

.auth-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(109, 213, 237, 0.3);
}

.auth-submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.form-footer {
    text-align: center;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.form-footer p {
    color: var(--luvex-text-muted-dark);
    margin: 0;
}

.form-footer a {
    color: var(--luvex-bright-cyan);
    text-decoration: none;
    font-weight: 600;
}

.form-footer a:hover {
    text-decoration: underline;
}

/* Benefits Section */
.auth-benefits {
    color: var(--luvex-text-on-dark);
}

.auth-benefits h3 {
    font-size: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

.benefits-grid {
    display: grid;
    gap: 2rem;
}

.benefit-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.benefit-icon {
    width: 50px;
    height: 50px;
    background: rgba(109, 213, 237, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--luvex-bright-cyan);
    font-size: 1.5rem;
    flex-shrink: 0;
}

.benefit-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.2rem;
    color: var(--luvex-text-on-dark);
}

.benefit-content p {
    margin: 0;
    color: var(--luvex-text-muted-dark);
    line-height: 1.5;
}

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loading-content {
    text-align: center;
    color: var(--luvex-text-on-dark);
}

.loading-spinner {
    font-size: 3rem;
    color: var(--luvex-bright-cyan);
    margin-bottom: 1rem;
}

.loading-text {
    font-size: 1.2rem;
    font-weight: 600;
}

/* Auth Messages */
.auth-message {
    position: fixed;
    top: 2rem;
    right: 2rem;
    z-index: 10000;
    max-width: 400px;
}

.message-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    border: 1px solid;
}

.auth-message.success .message-content {
    background: #10b981;
    color: white;
    border-color: #059669;
}

.auth-message.error .message-content {
    background: #dc2626;
    color: white;
    border-color: #b91c1c;
}

.message-icon {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.message-text {
    flex: 1;
    font-weight: 500;
}

.message-close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 3px;
    transition: background-color 0.3s ease;
}

.message-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .auth-content-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .hero-text h1 {
        font-size: 2.5rem;
    }
    
    .auth-forms-container {
        order: -1;
    }
}

@media (max-width: 768px) {
    .auth-hero-section {
        padding: calc(5rem + 80px) 1rem 2rem;
    }
    
    .auth-forms-container {
        margin: 0 -1rem;
        border-radius: 16px;
    }
    
    .auth-form {
        padding: 1.5rem;
    }
    
    .form-row {
        flex-direction: column;
    }
    
    .form-options {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .benefits-grid {
        gap: 1.5rem;
    }
    
    .benefit-item {
        flex-direction: column;
        text-align: center;
    }
    
    .hero-text h1 {
        font-size: 2rem;
    }
    
    .hero-description {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .auth-message {
        top: 1rem;
        right: 1rem;
        left: 1rem;
        max-width: none;
    }
    
    .message-content {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<script>
// Auth Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeAuthPage();
    checkUrlParams();
});

function initializeAuthPage() {
    // Initialize form validation
    setupFormValidation();
    
    // Initialize password strength checker
    setupPasswordStrength();
    
    // Setup form submissions
    setupFormSubmissions();
}

function checkUrlParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    
    if (tab === 'register') {
        switchTab('register');
    }
}

function switchTab(tabName) {
    // Update tab buttons
    document.querySelectorAll('.auth-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
    
    // Update forms
    document.querySelectorAll('.auth-form').forEach(form => {
        form.classList.remove('active');
    });
    document.getElementById(`${tabName}-form`).classList.add('active');
    
    // Update URL without reload
    const url = new URL(window.location);
    if (tabName === 'register') {
        url.searchParams.set('tab', 'register');
    } else {
        url.searchParams.delete('tab');
    }
    window.history.replaceState({}, '', url);
}

function showForgotPassword() {
    document.querySelectorAll('.auth-form').forEach(form => {
        form.classList.remove('active');
    });
    document.getElementById('forgot-password-form').classList.add('active');
    
    // Update tabs appearance
    document.querySelectorAll('.auth-tab').forEach(tab => {
        tab.classList.remove('active');
    });
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.parentNode.querySelector('.password-toggle i');
    
    if (input.type === 'password') {
        input.type = 'text';
        button.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        button.className = 'fas fa-eye';
    }
}

function setupPasswordStrength() {
    const passwordInput = document.getElementById('register-password');
    if (!passwordInput) return;
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strengthFill = document.querySelector('.strength-fill');
        const strengthText = document.querySelector('.strength-text');
        
        const strength = calculatePasswordStrength(password);
        
        strengthFill.className = 'strength-fill';
        
        if (password.length === 0) {
            strengthText.textContent = 'Password strength';
            return;
        }
        
        if (strength < 2) {
            strengthFill.classList.add('weak');
            strengthText.textContent = 'Weak password';
        } else if (strength < 3) {
            strengthFill.classList.add('fair');
            strengthText.textContent = 'Fair password';
        } else if (strength < 4) {
            strengthFill.classList.add('good');
            strengthText.textContent = 'Good password';
        } else {
            strengthFill.classList.add('strong');
            strengthText.textContent = 'Strong password';
        }
    });
}

function calculatePasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    return strength;
}

function setupFormValidation() {
    // Real-time validation for confirm password
    const confirmPasswordInput = document.getElementById('register-confirm-password');
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            const password = document.getElementById('register-password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
                this.style.borderColor = '#dc2626';
            } else {
                this.setCustomValidity('');
                this.style.borderColor = '';
            }
        });
    }
    
    // Username validation
    const usernameInput = document.getElementById('register-username');
    if (usernameInput) {
        usernameInput.addEventListener('input', function() {
            const username = this.value;
            if (username.length > 0 && username.length < 3) {
                this.setCustomValidity('Username must be at least 3 characters');
            } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                this.setCustomValidity('Username can only contain letters, numbers, and underscores');
            } else {
                this.setCustomValidity('');
            }
        });
    }
}

function setupFormSubmissions() {
    // Login form
    const loginForm = document.getElementById('simulator-login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    // Register form
    const registerForm = document.getElementById('simulator-register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegister);
    }
    
    // Forgot password form
    const forgotForm = document.getElementById('simulator-forgot-form');
    if (forgotForm) {
        forgotForm.addEventListener('submit', handleForgotPassword);
    }
    
    // Tab switching
    document.querySelectorAll('.auth-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            switchTab(this.dataset.tab);
        });
    });
}

async function handleLogin(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const username = formData.get('username');
    const password = formData.get('password');
    const rememberMe = document.getElementById('remember-me').checked;
    
    if (!username || !password) {
        showMessage('Please fill in all fields', 'error');
        return;
    }
    
    showLoading(true);
    
    try {
        // WordPress login
        const response = await fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'simulator_login',
                username: username,
                password: password,
                remember: rememberMe ? '1' : '0'
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage('Login successful! Redirecting...', 'success');
            
            // Redirect after short delay
            setTimeout(() => {
                const redirectTo = getRedirectUrl();
                window.location.href = redirectTo;
            }, 1500);
        } else {
            showMessage(result.data || 'Login failed. Please check your credentials.', 'error');
        }
    } catch (error) {
        console.error('Login error:', error);
        showMessage('Connection error. Please try again.', 'error');
    } finally {
        showLoading(false);
    }
}

async function handleRegister(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const firstName = formData.get('first_name');
    const lastName = formData.get('last_name');
    const email = formData.get('email');
    const username = formData.get('username');
    const password = formData.get('password');
    const confirmPassword = formData.get('confirm_password');
    const company = formData.get('company');
    const termsAgreed = document.getElementById('terms-agreement').checked;
    const newsletter = document.getElementById('newsletter-signup').checked;
    
    // Validation
    if (!firstName || !lastName || !email || !username || !password) {
        showMessage('Please fill in all required fields', 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showMessage('Passwords do not match', 'error');
        return;
    }
    
    if (!termsAgreed) {
        showMessage('Please agree to the Terms of Service and Privacy Policy', 'error');
        return;
    }
    
    showLoading(true);
    
    try {
        // WordPress registration
        const response = await fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'wp_ajax_nopriv_simulator_register',
                first_name: firstName,
                last_name: lastName,
                email: email,
                username: username,
                password: password,
                company: company,
                newsletter: newsletter ? '1' : '0'
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage('Registration successful! Welcome to UV Simulator!', 'success');
            
            // Redirect after short delay
            setTimeout(() => {
                const redirectTo = getRedirectUrl();
                window.location.href = redirectTo;
            }, 2000);
        } else {
            showMessage(result.data || 'Registration failed. Please try again.', 'error');
        }
    } catch (error) {
        console.error('Registration error:', error);
        showMessage('Connection error. Please try again.', 'error');
    } finally {
        showLoading(false);
    }
}

async function handleForgotPassword(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const email = formData.get('email');
    
    if (!email) {
        showMessage('Please enter your email address', 'error');
        return;
    }
    
    showLoading(true);
    
    try {
        // WordPress forgot password
        const response = await fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'wp_ajax_nopriv_simulator_forgot_password',
                email: email
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage('Password reset link sent! Check your email.', 'success');
            
            // Switch back to login after delay
            setTimeout(() => {
                switchTab('login');
            }, 3000);
        } else {
            showMessage(result.data || 'Failed to send reset link. Please try again.', 'error');
        }
    } catch (error) {
        console.error('Forgot password error:', error);
        showMessage('Connection error. Please try again.', 'error');
    } finally {
        showLoading(false);
    }
}

function getRedirectUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('redirect_to') || '/simulator/';
}

function showLoading(show) {
    const overlay = document.getElementById('loading-overlay');
    overlay.style.display = show ? 'flex' : 'none';
    
    // Disable/enable submit buttons
    document.querySelectorAll('.auth-submit-btn').forEach(btn => {
        btn.disabled = show;
    });
}

function showMessage(text, type) {
    const messageDiv = document.getElementById('auth-message');
    const messageText = messageDiv.querySelector('.message-text');
    const messageIcon = messageDiv.querySelector('.message-icon');
    
    messageText.textContent = text;
    messageDiv.className = `auth-message ${type}`;
    
    if (type === 'success') {
        messageIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
    } else {
        messageIcon.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
    }
    
    messageDiv.style.display = 'block';
    
    // Auto-hide after 5 seconds
    setTimeout(hideMessage, 5000);
}

function hideMessage() {
    document.getElementById('auth-message').style.display = 'none';
}

// Handle escape key for modals
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        hideMessage();
    }
});
</script>

<?php get_footer(); ?>