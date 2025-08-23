<?php
// header.php KORREKTUREN (Nur die relevanten Teilen)

// PROBLEM 1: User-Dropdown zeigt undefinierte Variable $first_name
// KORREKTUR in Zeile ~58:
?>
<?php if (is_user_logged_in()) : 
    $current_user = wp_get_current_user();
    $first_name = $current_user->first_name ?: $current_user->display_name; // HINZUGEFÜGT
?>
    <div class="user-section">
        <div class="user-info" onclick="toggleUserDropdown()">
            <div class="user-avatar" id="userAvatar">
                <?php echo luvex_get_user_avatar(); ?>
            </div>
            <div class="user-details">
                <p class="user-welcome">Willkommen</p>
                <p class="user-name"><?php echo esc_html($first_name); ?></p> <!-- KORRIGIERT -->
            </div>
            <span class="dropdown-arrow">▼</span>
        </div>
        <!-- Rest bleibt gleich -->

<?php
// PROBLEM 2: Menu Walker depth sollte 3 sein für 3-Level Navigation
// KORREKTUR in der wp_nav_menu Funktion (ca. Zeile 51):
?>

<nav id="desktop-navigation" class="main-navigation">
    <?php
    $menu_output = wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'depth'          => 3, // KORREKT - 3 Level Navigation
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