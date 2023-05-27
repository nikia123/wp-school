<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP-School
 */

get_header();
?>

	<main id="primary" class="site-main">

	<?php if ( have_posts() ) :
	
		$term = get_queried_object();
		echo '<h1>' . $term->name . '</h1>';

		// Start the WordPress loop.
		while ( have_posts() ) :
			the_post();
			?>
			<article>
				<a href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
					<?php the_post_thumbnail('student-type'); ?>
							
				</a>
				<?php the_content(); ?>
			</article>
			<?php
		endwhile;
		
else :
	
	get_template_part( 'template-parts/content', 'none' );

endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
