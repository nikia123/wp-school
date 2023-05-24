<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP-School
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">

			<!-- logo -->
			<!-- https://www.sktthemes.org/wordpress/add-custom-widget-area-wordpress-themes/ -->

			<div id="footer-logo">
			<?php
				if ( function_exists( 'bazinga_logo_setup' ) ) {
					the_custom_logo();
				}
			?>
			</div>
			
			<h4>Credits:</h4>
			
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'bazinga' ), 'bazinga', '<a href="https://wp.bcitwebdeveloper.ca">Nikia Shaw & Kate Khymochka</a>' );
			?>

			<p>Photos courtesy of <a href="https://burst.shopify.com">Burst </a></p>

			<div id="footer-widget-area">
				<?php dynamic_sidebar( 'footer_widget_area' ); ?>
			</div>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
