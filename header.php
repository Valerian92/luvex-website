<?php
/**
 * The header for our theme - Language Switcher neben Logo
 * @package Luvex
 * @since 4.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
 	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'luvex' ); ?></a>

<header id="site-header" class="site-header fixed-header">
    <div class="header-container">
        
        <!-- KORREKTUR: Linke Elemente gruppiert für besseres Flexbox-Layout -->
        <div class="header-left-group">
            <!-- Language Switcher links vom Logo -->
            <div class="header-language-switcher">
                <?php 
                if (function_exists('pll_the_languages') && class_exists('LuvexUserSystem')) {
                    if (method_exists('LuvexUserSystem', 'get_language_switcher_dropdown')) {
                        echo LuvexUserSystem::get_language_switcher_dropdown();
                    }
                }
                ?>
            </div>

            <!-- Logo -->
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="luvex-logo-text">
                        <span class="logo-l">L</span><span class="logo-u">u</span><span class="logo-vex">vex</span><span class="logo-dot"></span>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- Desktop Navigation -->
        <nav id="desktop-navigation" class="main-navigation">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'depth'          => 3,
                    'walker'         => new Luvex_Nav_Walker(),
                ));
            }
            ?>
        </nav>

        <!-- CTA Button / User Section -->
        <div class="header-cta">
            <div class="header-actions-group">

                <?php if (is_user_logged_in()) : 
                    $current_user = wp_get_current_user();
                    $first_name = !empty($current_user->first_name) ? $current_user->first_name : $current_user->display_name;
                ?>
                    <!-- Logged-in User Section -->
                    <div class="user-section">
                        <div class="user-info" onclick="toggleUserDropdown()">
                            <div class="user-avatar" id="userAvatar">
                                <?php 
                                if (function_exists('luvex_get_user_avatar')) {
                                    echo luvex_get_user_avatar(); 
                                }
                                ?>
                            </div>
                            <div class="user-details">
                                <p class="user-welcome">Welcome</p>
                                <p class="user-name"><?php echo esc_html($first_name); ?></p>
                            </div>
                            <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                        </div>
                        
                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-user-info">
                                   <div class="dropdown-avatar" id="dropdownAvatar">
                                        <?php 
                                        if (function_exists('luvex_get_user_avatar')) {
                                            echo luvex_get_user_avatar(); 
                                        }
                                        ?>
                                    </div>
                                    <div class="dropdown-user-details">
                                        <h4><?php echo esc_html($current_user->display_name); ?></h4>
                                        <p><?php echo esc_html($current_user->user_email); ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dropdown-menu">
                                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'profile' ) ) ); ?>" class="dropdown-item">
                                    <i class="fa-solid fa-user"></i>
                                    My Profile
                                </a>
                                
                                <a href="<?php echo wp_logout_url(home_url()); ?>" class="dropdown-item">
                                    <i class="fa-solid fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Non-logged-in: Login/Register Button -->
                    <button onclick="openAuthModal('login')" class="header-cta-button">
                        <i class="fa-solid fa-user-circle"></i>
                        <span>Login / Register</span>
                    </button>
                <?php endif; ?>

            </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="mobile-menu-toggle">
            <button id="mobile-menu-button" class="hamburger-button" aria-controls="mobile-menu" aria-expanded="false">
                <span class="screen-reader-text">Open Menu</span>
                <div class="hamburger-lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <nav id="mobile-menu" class="mobile-navigation" aria-hidden="true">
        <div class="mobile-menu-content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'mobile-menu-list',
                'container'      => false,
            ));
            ?>
        </div>
    </nav>
</header>

<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
