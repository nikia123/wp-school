<?php
/**
 * The template for displaying a list of students
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP-School
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				
				<h1><?php echo  post_type_archive_title( '', false ); ?></h1>
				
				<?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$args = array(
				'post_type'      => 'students',
				'posts_per_page' => -1,
				'orderby'        => 'title',
        		'order'          => 'ASC',
								
			);

			
			$query = new WP_Query( $args );

			
			/* Start the Loop */
			if ( $query->have_posts() ) {
				?>

				<div class = "students-container">

					<?php
					while( $query->have_posts() ) {
						$query->the_post();				
						$terms = get_the_terms( get_the_ID(), 'students-type' ); 
					?> 
						
						<article>
							<a href="<?php the_permalink(); ?>">
								<h2><?php the_title(); ?></h2>
							</a>

							<?php the_post_thumbnail('medium'); ?>
																											
							<?php 
							//change the excerpt to 25 symbols & excerpt to Read More
							add_filter( 'excerpt_length', function() { return 25; });
							add_filter( 'excerpt_more', function( $more ) {
								return ' <a href="' . get_permalink() . '">' . 'Read More about the Student' . '</a>';
							} );
							
							the_excerpt(); ?>

							<?php 
							// displaying each student's term
							if ($terms) : ?>
							<p>Specialty:
								<?php foreach ( $terms as $term ) : ?>
									<a href="<?php echo esc_url(get_term_link( $term )); ?>"><?php echo $term->name;?></a>
								<?php endforeach; ?>
							</p>
							<?php endif; ?>
						</article>
						<?php
					}
					wp_reset_postdata(); ?>

				</div>	
				<?php
			}
		
	
		endif;				
			
		?>

	</main><!-- #main -->

<?php

get_footer();
