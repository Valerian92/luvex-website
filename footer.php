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

<footer id="colophon" class="site-footer">
	<div class="content-wrapper">

		<!-- Footer Widgets (die 4 Spalten) -->
		<div class="footer-widgets-container">
			<div class="footer-widget-area">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php endif; ?>
			</div>

			<div class="footer-widget-area">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php endif; ?>
			</div>

			<div class="footer-widget-area">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php endif; ?>
			</div>

			<div class="footer-widget-area">
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php endif; ?>
			</div>
		</div>

		<!-- Bottom Bar -->
		<div class="footer-bottom-bar">
			<div class="footer-copyright">
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Alle Rechte vorbehalten.
			</div>
			<div class="footer-legal-links">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-legal',
							'menu_id'        => 'footer-legal-menu',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
				?>
			</div>
			<div class="footer-social-icons">
				<a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
				<a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
				<a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
			</div>
		</div>

	</div><!-- .content-wrapper -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
