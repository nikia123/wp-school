<?php
/**
 * The template for displaying students single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP-School
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			?>
			<article>
				<a href="<?php the_permalink(); ?>">
					<h1><?php the_title(); ?></h1>
					<?php the_post_thumbnail('medium', array('class' => 'alignright')); ?>
							
				</a>
				<?php the_content(); ?>
				
			</article>
			<?php

			//to display students from the same category
			$post_id = get_the_ID();
			$terms = get_the_terms( $post_id, 'students-type' );
			
			if($terms && ! is_wp_error($terms) ){
				foreach($terms as $term){
					?>
					<section> 
						<h2>See other <?php echo $term->name ?></h2>

						<?php

						$args = array(
							'post_type'      => 'students',
							'tax_query'      => array(
								array(
									'taxonomy' => 'students-type',
									'field'    => 'slug',
									'terms'    => $term->slug,
								)
							),
						);
						
						$query = new WP_Query( $args );
						
						if ( $query->have_posts() ) {
																				
								while ( $query->have_posts() ) {
									$query->the_post();
									
									if ( get_the_ID() !== $post_id ) {
									?>
									<p><a href="<?php the_permalink()?>"><?php the_title()?></a></p>
									
									<?php
									}
								}
								?>
															
							<?php				
							
							wp_reset_postdata();
						}
						?>
					
					</section>
					
					<?php
				}	
			}
			

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();
