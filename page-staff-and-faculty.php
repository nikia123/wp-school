<?php
/**
 * Staff Page Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP-School
 */

get_header();
?>

	<main id="primary" class="site-main main ">

		<?php

		get_template_part( 'template-parts/content', 'page-staff-and-faculty' );


		// display staff posts
		$taxonomy = 'staff-type';
		$terms = get_terms(
			array(
				'taxonomy' => $taxonomy
			)
		);
		if ($terms && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				?> 
				<article> <?php
					
					// Output the title for the term
					echo '<h2  class="staff-term-title">' . $term->name . '</h2>';
					

					$args = array(
						'post_type' 		=> 'staff',
						'posts_per_page' 	=> -1,
						'order' 			=> 'ASC',
						'orderby' 			=> 'title',
						'tax_query' 		=> array(
										array(
										'taxonomy' 	=> $taxonomy,
										'field' 	=> 'slug',
										'terms' 	=> $term->slug,
							)
						),
					);

					$staff_posts = new WP_Query($args);

					if ($staff_posts->have_posts()) {
						?> <div  class="staff-container"> <?php
						while ($staff_posts->have_posts()) {
							$staff_posts->the_post(); ?>
							<div>
								<!-- ACF fields -->
								<h3 class="individual-title"> <?php the_field('add_staff_name'); ?> </h3>
								<p> <?php the_field('add_staff_biography'); ?> </p>
								<p> <?php the_field('courses_taught'); ?> </p>
								<?php if ( get_field('instructor_website')) : ?>
									<a href=<?php the_field('instructor_website') ?> >Instructor Website</a>
								<?php endif; ?>
							</div>

							<?php wp_reset_postdata();
						}
						?> </div> <?php
					}
				?> </article> <?php
			}	
		}
        

		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
