<?php
/**
 * The template for displaying the footer - WORDPRESS MENÜS VERSION
 *
 * @package Luvex
 * @since 1.7.0
 */
?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->

<!-- HINWEIS: Die ID 'colophon' wird vom neuen JavaScript verwendet, um die Animation zu triggern. -->
<footer id="colophon" class="site-footer modern-footer">
	<div class="footer-container">

		<!-- Footer Content Grid -->
		<div class="footer-content-grid">
			
			<!-- Company Info -->
			<div class="footer-section footer-company">
				<div class="footer-logo">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<div class="luvex-logo-text">
							<span class="logo-l">L</span><span class="logo-u">u</span><span class="logo-vex">vex</span><span class="logo-dot"></span>
						</div>
					<?php endif; ?>
				</div>
				<p class="footer-tagline">
					<strong>Precision through Light. Excellence through Engineering.</strong><br>
					Independent UV technology experts advancing global knowledge and delivering cutting-edge solutions.
				</p>
				<div class="footer-social">
					<a href="#" aria-label="LinkedIn" class="social-link">
						<i class="fab fa-linkedin"></i>
					</a>
					<a href="/booking/" aria-label="Book Consultation" class="social-link">
    					<i class="fa-solid fa-calendar-days"></i>
					</a>
					<a href="mailto:support@luvex.tech" aria-label="Email" class="social-link">
						<i class="fas fa-envelope"></i>
					</a>
				</div>
			</div>

			<!-- Services Menu -->
			<div class="footer-section">
				<h4 class="footer-section-title">Services</h4>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-services',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'luvex_footer_services_fallback'
				));
				?>
			</div>

			<!-- Technologies Menu -->
			<div class="footer-section">
				<h4 class="footer-section-title">Technologies</h4>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-technologies',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'luvex_footer_technologies_fallback'
				));
				?>
			</div>

			<!-- Resources Menu -->
			<div class="footer-section">
				<h4 class="footer-section-title">Resources</h4>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-resources',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'luvex_footer_resources_fallback'
				));
				?>
			</div>

			<!-- Company Menu -->
			<div class="footer-section">
				<h4 class="footer-section-title">Company</h4>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-company',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'luvex_footer_company_fallback'
				));
				?>
			</div>

		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom">
    		<div class="footer-bottom-content">
        		<div class="footer-bottom-left">
					<p class="footer-copyright">
						&copy; <?php echo esc_html( date( 'Y' ) ); ?> LUVEX. All rights reserved.
					</p>
				</div>
				<div class="footer-bottom-center">
					<nav class="footer-legal-nav">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'footer-legal',
							'menu_id'        => 'footer-legal-menu',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => 'luvex_footer_legal_fallback'
						));
						?>
					</nav>
				</div>
				<div class="footer-bottom-right">
					<p class="footer-location">
						Made with precision in Germany 🇩🇪
					</p>
				</div>
			</div>
		</div>

	</div>
</footer>

<?php
// Footer Fallback-Funktionen - nur für Admins sichtbar
function luvex_footer_services_fallback() {
	if (current_user_can('edit_theme_options')) {
		echo '<ul class="footer-menu">';
		echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Services Menü einrichten →</a></li>';
		echo '</ul>';
	} else {
		echo '<ul class="footer-menu">';
		echo '<li><a href="/uv-consulting/">UV Consulting</a></li>';
		echo '<li><a href="/system-design/">System Design</a></li>';
		echo '<li><a href="/process-optimization/">Process Optimization</a></li>';
		echo '</ul>';
	}
}

function luvex_footer_technologies_fallback() {
	if (current_user_can('edit_theme_options')) {
		echo '<ul class="footer-menu">';
		echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Technologies Menü einrichten →</a></li>';
		echo '</ul>';
	} else {
		echo '<ul class="footer-menu">';
		echo '<li><a href="/uv-c-disinfection/">UV-C Disinfection</a></li>';
		echo '<li><a href="/led-uv-systems/">LED UV Systems</a></li>';
		echo '<li><a href="/mercury-uv-lamps/">Mercury UV Lamps</a></li>';
		echo '</ul>';
	}
}

function luvex_footer_resources_fallback() {
	if (current_user_can('edit_theme_options')) {
		echo '<ul class="footer-menu">';
		echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Resources Menü einrichten →</a></li>';
		echo '</ul>';
	} else {
		echo '<ul class="footer-menu">';
		echo '<li><a href="/uv-simulator/">UV Simulator</a></li>';
		echo '<li><a href="/knowledge-base/">Knowledge Base</a></li>';
		echo '<li><a href="/case-studies/">Case Studies</a></li>';
		echo '</ul>';
	}
}

function luvex_footer_company_fallback() {
	if (current_user_can('edit_theme_options')) {
		echo '<ul class="footer-menu">';
		echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Company Menü einrichten →</a></li>';
		echo '</ul>';
	} else {
		echo '<ul class="footer-menu">';
		echo '<li><a href="/about/">About LUVEX</a></li>';
		echo '<li><a href="/our-team/">Our Team</a></li>';
		echo '<li><a href="/contact/">Contact</a></li>';
		echo '</ul>';
	}
}

function luvex_footer_legal_fallback() {
	if (current_user_can('edit_theme_options')) {
		echo '<ul>';
		echo '<li><a href="' . admin_url('nav-menus.php') . '" style="color: red;">Legal Menü einrichten →</a></li>';
		echo '</ul>';
	} else {
		echo '<ul>';
		echo '<li><a href="/privacy-policy/">Privacy Policy</a></li>';
		echo '<li><a href="/terms-of-service/">Terms of Service</a></li>';
		echo '<li><a href="/impressum/">Impressum</a></li>';
		echo '</ul>';
	}
}
?>

<button id="scrollToTopBtn" title="Nach oben scrollen">
    <i class="fa-solid fa-arrow-up"></i>
</button>



<?php wp_footer(); ?>

</body>
</html>
