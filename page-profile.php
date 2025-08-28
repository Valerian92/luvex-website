<?php
/**
 * Template Name: User Profile
 *
 * @package Luvex
 * @since 3.0.0
 */

// Redirect user to login page if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login')); // Or open the modal: home_url('/?login=true')
    exit;
}

get_header();

$current_user = wp_get_current_user();
?>

<main id="main" class="site-main">
    <div class="profile-dashboard">
        <div class="container">

            <div class="profile-quick-actions">
                 <div class="profile-section__header">
                    <div class="header-content">
                        <h2>Welcome, <?php echo esc_html($current_user->first_name); ?>!</h2>
                        <p>This is your personal dashboard. Manage your profile and settings here.</p>
                    </div>
                    <div class="header-avatar" data-modal="avatarModal">
                        <?php echo luvex_get_user_avatar(); ?>
                        <div class="avatar-plus"><i class="fa-solid fa-pencil"></i></div>
                    </div>
                </div>
            </div>

            <div class="profile-layout">
                <aside class="profile-sidebar">
                    <nav class="profile-nav">
                        <h3 class="profile-nav__title">Navigation</h3>
                        <ul class="profile-nav__list">
                            <li class="profile-nav__item profile-nav__item--active" data-target="profile-details">
                                <a href="#" class="profile-nav__link">
                                    <i class="fa-solid fa-user-circle"></i>
                                    <span>Profile Details</span>
                                </a>
                            </li>
                            <li class="profile-nav__item" data-target="security">
                                <a href="#" class="profile-nav__link">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <span>Security</span>
                                </a>
                            </li>
                            <li class="profile-nav__item" data-target="language-settings">
                                <a href="#" class="profile-nav__link">
                                    <i class="fa-solid fa-globe"></i>
                                    <span>Language</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </aside>

                <div class="profile-content">
                    <!-- Profile Details Section -->
                    <section id="profile-details" class="profile-section profile-section--active">
                        <div class="profile-section__header">
                            <div class="header-content">
                                <h2>Profile Details</h2>
                                <p>Update your personal information.</p>
                            </div>
                        </div>
                        <form class="profile-form">
                            <div class="form-grid--2-cols">
                                <div class="floating-label-input">
                                    <input type="text" id="first_name" name="first_name" value="<?php echo esc_attr($current_user->first_name); ?>" placeholder=" ">
                                    <label for="first_name">First Name</label>
                                </div>
                                <div class="floating-label-input">
                                    <input type="text" id="last_name" name="last_name" value="<?php echo esc_attr($current_user->last_name); ?>" placeholder=" ">
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                             <div class="floating-label-input">
                                <input type="email" id="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" placeholder=" " disabled>
                                <label for="email">Email Address (cannot be changed)</label>
                            </div>
                            <button type="submit" class="btn--primary form-submit">
                                <i class="fa-solid fa-save"></i>
                                <span>Save Changes</span>
                            </button>
                        </form>
                    </section>

                    <!-- Security Section -->
                    <section id="security" class="profile-section">
                         <div class="profile-section__header">
                            <div class="header-content">
                                <h2>Security</h2>
                                <p>Change your password.</p>
                            </div>
                        </div>
                         <form class="profile-form">
                            <div class="floating-label-input">
                                <input type="password" id="current_password" name="current_password" placeholder=" ">
                                <label for="current_password">Current Password</label>
                            </div>
                            <div class="form-grid--2-cols">
                                <div class="floating-label-input">
                                    <input type="password" id="new_password" name="new_password" placeholder=" ">
                                    <label for="new_password">New Password</label>
                                </div>
                                <div class="floating-label-input">
                                    <input type="password" id="confirm_new_password" name="confirm_new_password" placeholder=" ">
                                    <label for="confirm_new_password">Confirm New Password</label>
                                </div>
                            </div>
                            <button type="submit" class="btn--primary form-submit">
                                <i class="fa-solid fa-key"></i>
                                <span>Update Password</span>
                            </button>
                        </form>
                    </section>

                    <!-- Language Section -->
                    <section id="language-settings" class="profile-section">
                        <div class="profile-section__header">
                             <div class="header-content">
                                <h2>Language & Region</h2>
                                <p>Set your preferred language for the website.</p>
                            </div>
                        </div>
                        <p>Your language settings are managed via the language switcher in the website header.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple JS for tab switching -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.profile-nav__item');
            const sections = document.querySelectorAll('.profile-section');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Update active class for nav items
                    navItems.forEach(i => i.classList.remove('profile-nav__item--active'));
                    this.classList.add('profile-nav__item--active');

                    // Show the target section
                    const targetId = this.dataset.target;
                    sections.forEach(section => {
                        section.classList.toggle('profile-section--active', section.id === targetId);
                    });
                });
            });
        });
    </script>
</main>

<?php get_footer(); ?>
