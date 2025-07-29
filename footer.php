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

			<!-- Services -->
			<div class="footer-section">
				<h4 class="footer-section-title">Services</h4>
				<ul class="footer-menu footer-services">
					<li><a href="/uv-consulting/">UV Consulting</a></li>
					<li><a href="/system-design/">System Design</a></li>
					<li><a href="/process-optimization/">Process Optimization</a></li>
					<li><a href="/training-education/">Training & Education</a></li>
					<li><a href="/technology-assessment/">Technology Assessment</a></li>
					<li><a href="/independent-analysis/">Independent Analysis</a></li>
				</ul>
			</div>

			<!-- Technologies -->
			<div class="footer-section">
				<h4 class="footer-section-title">Technologies</h4>
				<ul class="footer-menu footer-technologies">
					<li><a href="/uv-c-disinfection/">UV-C Disinfection</a></li>
					<li><a href="/led-uv-systems/">LED UV Systems</a></li>
					<li><a href="/mercury-uv-lamps/">Mercury UV Lamps</a></li>
					<li><a href="/uv-curing/">UV Curing</a></li>
					<li><a href="/water-treatment/">Water Treatment</a></li>
					<li><a href="/air-purification/">Air Purification</a></li>
				</ul>
			</div>

			<!-- Resources -->
			<div class="footer-section">
				<h4 class="footer-section-title">Resources</h4>
				<ul class="footer-menu footer-resources">
					<li><a href="/uv-simulator/">UV Simulator</a></li>
					<li><a href="/knowledge-base/">Knowledge Base</a></li>
					<li><a href="/case-studies/">Case Studies</a></li>
					<li><a href="/technical-papers/">Technical Papers</a></li>
					<li><a href="/webinars/">Webinars</a></li>
					<li><a href="/uv-calculator/">UV Calculator</a></li>
				</ul>
			</div>

			<!-- Company -->
			<div class="footer-section">
				<h4 class="footer-section-title">Company</h4>
				<ul class="footer-menu footer-company">
					<li><a href="/about/">About LUVEX</a></li>
					<li><a href="/our-team/">Our Team</a></li>
					<li><a href="/careers/">Careers</a></li>
					<li><a href="/news-events/">News & Events</a></li>
					<li><a href="/contact/">Contact</a></li>
					<li><a href="/partnerships/">Partnerships</a></li>
				</ul>
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

	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>