<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luvex
 * @since 1.7.0
 */
?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->

<footer id="colophon" class="site-footer modern-footer">
	<div class="container">

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
					<a href="#" aria-label="Twitter" class="social-link">
						<i class="fab fa-twitter"></i>
					</a>
					<a href="mailto:contact@luvex.tech" aria-label="Email" class="social-link">
						<i class="fas fa-envelope"></i>
					</a>
				</div>
			</div>

<!-- Services -->
<div class="footer-section">
    <h4 class="footer-section-title">Services</h4>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'footer-services',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</div>

<!-- Technologies -->
<div class="footer-section">
    <h4 class="footer-section-title">Technologies</h4>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'footer-technologies',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</div>

<!-- Resources -->
<div class="footer-section">
    <h4 class="footer-section-title">Resources</h4>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'footer-resources',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</div>

<!-- Company -->
<div class="footer-section">
    <h4 class="footer-section-title">Company</h4>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'footer-company',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ) );
    ?>
</div>

		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="footer-bottom-left">
				<p class="footer-copyright">
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> LUVEX. All rights reserved.
				</p>
			</div>
			<div class="footer-bottom-center">
				<nav class="footer-legal-nav">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-legal',
								'menu_id'        => 'footer-legal-menu',
								'container'      => false,
								'depth'          => 1,
								'fallback_cb'    => function() {
									echo '<ul>';
									echo '<li><a href="#">Privacy Policy</a></li>';
									echo '<li><a href="#">Terms of Service</a></li>';
									echo '<li><a href="#">Cookie Policy</a></li>';
									echo '</ul>';
								},
							)
						);
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
</footer>

<?php wp_footer(); ?>

</body>
</html>