<?php
/**
 * The header for our theme - CLEAN VERSION ohne Fallback-Menüs
 * 
 * @package Luvex
 * @since 2.0.0
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

        <!-- Desktop Navigation - NUR WORDPRESS MENÜ -->
        <nav id="desktop-navigation" class="main-navigation">
            <?php
           wp_nav_menu( array(
             'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
             'container'      => false,
               'fallback_cb'    => false,
             ) );
            ?>
        </nav>

            <!-- CTA Button -->
            <div class="header-cta">
                <?php if (is_user_logged_in()) : 
                    $current_user = wp_get_current_user(); ?>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'profile' ) ) ); ?>" class="header-cta-button">
                        <i class="fa-solid fa-user"></i>
                        <span><?php echo esc_html($current_user->first_name ?: 'Profile'); ?></span>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="header-cta-button">
                        <i class="fa-solid fa-comments"></i>
                        <span>Get Consultation</span>
                    </a>
                <?php endif; ?>
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

    <!-- Mobile Navigation Menu - NUR WORDPRESS MENÜ -->
    <nav id="mobile-menu" class="mobile-navigation" aria-hidden="true">
        <div class="mobile-menu-content">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'mobile-menu',
            'container'      => false,
         'fallback_cb'    => false,
        ) );
        ?>
        </div>
    </nav>
</header>

<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">