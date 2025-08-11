<?php
/**
 * The header for our theme - NAVIGATION DEBUG VERSION
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

        <!-- Desktop Navigation - MIT DEBUG -->
        <nav id="desktop-navigation" class="main-navigation">
            <?php
            // Debug: Prüfen ob Menü existiert
            if (current_user_can('administrator') && isset($_GET['debug_nav'])) {
                echo '<!-- DEBUG: Navigation wird geladen -->';
                $locations = get_theme_mod('nav_menu_locations');
                echo '<!-- DEBUG: Primary Menu ID: ' . (isset($locations['primary']) ? $locations['primary'] : 'NICHT_ZUGEWIESEN') . ' -->';
            }
            
            // Menü mit erweiterten Parametern
          // header.php (ca. Zeile 51)
                        $menu_output = wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'depth'          => 3, // <-- NEUER WERT
                            'walker'         => new Luvex_Nav_Walker(),
                            'echo'           => false
                        ));

                        if (!empty($menu_output)) {
                            echo $menu_output;
                        } else {
                            luvex_primary_menu_fallback();
                        }
            ?>
        </nav>

        <!-- CTA Button -->
        <div class="header-cta">
            <?php if (is_user_logged_in()) : 
                $current_user = wp_get_current_user(); ?>
                <div class="user-section">
                <div class="user-info" onclick="toggleUserDropdown()">
                    <div class="user-avatar" id="userAvatar">
                        <?php 
                        $first_name = $current_user->first_name ?: $current_user->display_name;
                        $last_name = $current_user->last_name ?: '';
                        $initials = strtoupper(substr($first_name, 0, 1) . substr($last_name, 0, 1));
                        echo $initials ?: '?';
                        ?>
                    </div>
                    <div class="user-details">
                        <p class="user-welcome">Willkommen</p>
                        <p class="user-name"><?php echo esc_html($first_name); ?></p>
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </div>
                
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-user-info">
                            <div class="dropdown-avatar"><?php echo $initials ?: '?'; ?></div>
                            <div class="dropdown-user-details">
                                <h4><?php echo esc_html($current_user->display_name); ?></h4>
                                <p><?php echo esc_html($current_user->user_email); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-menu">
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'profile' ) ) ); ?>" class="dropdown-item">
                            <i class="fa-solid fa-user"></i>
                            Mein Profil
                        </a>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="dropdown-item">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            Abmelden
                        </a>
                    </div>
                </div>
            </div>
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

    <!-- Mobile Navigation Menu -->
    <nav id="mobile-menu" class="mobile-navigation" aria-hidden="true">
        <div class="mobile-menu-content">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'mobile-menu-list',
                'container'      => false,
                'fallback_cb'    => 'luvex_primary_menu_fallback',
            ));
            ?>
        </div>
    </nav>
</header>

<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

<?php
// Fallback-Funktion für Navigation
function luvex_primary_menu_fallback() {
    if (current_user_can('edit_theme_options')) {
        echo '<ul id="primary-menu">';
        echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Menü einrichten →</a></li>';
        echo '</ul>';
    } else {
        // Standard-Fallback für normale Besucher
        echo '<ul id="primary-menu">';
        echo '<li><a href="' . home_url('/about/') . '">About</a></li>';
        echo '<li><a href="' . home_url('/uv-technology/') . '">UV Technology</a></li>';
        echo '<li><a href="' . home_url('/contact/') . '">Contact</a></li>';
        echo '</ul>';
    }
}
?>