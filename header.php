<?php
/**
 * The header for our theme - WITH UNIFIED LANGUAGE SYSTEM
 * * This version features a single, consistent language switcher for all users,
 * placed directly in the header for optimal accessibility and user experience.
 * * @package Luvex
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
            } else {
                echo '<ul id="primary-menu">';
                echo '<li><a href="' . home_url('/about/') . '">About</a></li>';
                echo '<li><a href="' . home_url('/uv-technology/') . '">UV Technology</a></li>';
                echo '<li><a href="' . home_url('/contact/') . '">Contact</a></li>';
                echo '</ul>';
                
                if (current_user_can('edit_theme_options')) {
                    echo '<div style="background:red;color:white;padding:5px;border-radius:3px;margin-left:10px;">';
                    echo '<a href="' . admin_url('nav-menus.php') . '" style="color:white;">⚠️ Menu Setup</a>';
                    echo '</div>';
                }
            }
            ?>
        </nav>

        <!-- CTA Button / User Section -->
        <div class="header-cta">
            <div class="header-actions-group"> <!-- NEUER WRAPPER FÜR FLEXBOX -->

                <?php 
                // Einheitlicher Language Switcher für ALLE
                // This function from _user-system.php now renders the switcher for guests and logged-in users.
                if (function_exists('LuvexUserSystem::get_language_switcher_dropdown')) {
                    echo LuvexUserSystem::get_language_switcher_dropdown();
                }
                ?>

                <?php if (is_user_logged_in()) : 
                    $current_user = wp_get_current_user();
                    $first_name = !empty($current_user->first_name) ? $current_user->first_name : $current_user->display_name;
                ?>
                    <!-- Logged-in User Section -->
                    <div class="user-section">
                        <div class="user-info" onclick="toggleUserDropdown()">
                            <div class="user-avatar" id="userAvatar">
                                <?php echo luvex_get_user_avatar(); ?>
                            </div>
                            <div class="user-details">
                                <p class="user-welcome">Welcome</p>
                                <p class="user-name"><?php echo esc_html($first_name); ?></p>
                            </div>
                            <i class="fa-solid fa-chevron-down dropdown-arrow"></i> <!-- Icon statt Text-Pfeil -->
                        </div>
                        
                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-user-info">
                                   <div class="dropdown-avatar" id="dropdownAvatar">
                                        <?php echo luvex_get_user_avatar(); ?>
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
                                
                                <!-- LANGUAGE SWITCHER WAS REMOVED FROM HERE FOR CONSISTENCY -->
                                
                                <a href="<?php echo wp_logout_url(home_url()); ?>" class="dropdown-item">
                                    <i class="fa-solid fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Non-logged-in: Main CTA Button -->
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'booking' ) ) ); ?>" class="header-cta-button">
                        <i class="fa-solid fa-comments"></i>
                        <span>Get Consultation</span>
                    </a>
                <?php endif; ?>

            </div> <!-- ENDE .header-actions-group -->
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
            
            <?php if (function_exists('pll_the_languages') && !is_user_logged_in()) : ?>
                <!-- Mobile Language Switcher for Guests -->
                <div class="mobile-language-section">
                    <h4 class="mobile-section-title">
                        <i class="fa-solid fa-globe"></i>
                        Language
                    </h4>
                    <div class="mobile-language-options">
                        <?php 
                        $current_lang = function_exists('luvex_get_current_language') ? luvex_get_current_language() : 'en';
                        $supported_languages = function_exists('LuvexUserSystem::get_supported_languages') ? LuvexUserSystem::get_supported_languages() : [];
                        $polylang_languages = pll_the_languages(['raw' => 1]);
                        
                        if ($polylang_languages && is_array($polylang_languages)) :
                            foreach ($polylang_languages as $lang_code => $lang_data) :
                                if (!isset($supported_languages[$lang_code])) continue;
                                $is_current = $lang_code === $current_lang;
                                $lang_info = $supported_languages[$lang_code];
                        ?>
                            <button class="mobile-language-option <?php echo $is_current ? 'current' : ''; ?>" 
                                    onclick="switchLanguageGuest('<?php echo esc_attr($lang_code); ?>')"
                                    data-language="<?php echo esc_attr($lang_code); ?>"
                                    <?php echo $is_current ? 'disabled' : ''; ?>>
                                <span class="language-flag"><?php echo $lang_info['flag']; ?></span>
                                <span class="language-name"><?php echo esc_html($lang_info['name']); ?></span>
                                <?php if ($is_current) : ?>
                                    <i class="fa-solid fa-check"></i>
                                <?php endif; ?>
                            </button>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

<?php
// Fallback function for navigation
function luvex_primary_menu_fallback() {
    if (current_user_can('edit_theme_options')) {
        echo '<ul id="primary-menu">';
        echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Setup Menu →</a></li>';
        echo '</ul>';
    } else {
        // Standard fallback for normal visitors
        echo '<ul id="primary-menu">';
        echo '<li><a href="' . home_url('/about/') . '">About</a></li>';
        echo '<li><a href="' . home_url('/uv-technology/') . '">UV Technology</a></li>';
        echo '<li><a href="' . home_url('/contact/') . '">Contact</a></li>';
        echo '</ul>';
    }
}
?>
