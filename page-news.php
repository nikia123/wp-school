<?php
/**
 * The template for displaying all pages
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

	<main id="primary" class="site-main">

		<?php
		// display news blog posts
		$args = array(
			'post_type' => 'post',
			'category_name' => 'news',
			'posts_per_page' => -1
		);

		$news_posts = new WP_Query($args);

		if ( $news_posts -> have_posts() ) {

			the_title( '<h1 class="entry-title">', '</h1>' );

			while ( $news_posts -> have_posts() ) {
				$news_posts -> the_post(); ?>

			
				<article data-aos="fade-up">

					<a href=" <?php the_permalink(); ?> ">
						<h2> <?php the_title(); ?> </h2>
					</a> 

					<p><?php bazinga_posted_on() ?> by <?php bazinga_posted_by() ?></p> 

					<a href=" <?php the_permalink(); ?> " > 
						<?php the_post_thumbnail( 'large' ); ?> 
					</a>

					<?php the_excerpt(); ?>

					<p>Posted in <?php the_category(', '); ?> | Tagged <?php the_tags(''); ?> | <a href="<?php comments_link(); ?>">Leave a comment</a></p>
						
				</article>

				<?php

			}

			wp_reset_postdata();
		}


		while ( have_posts() ) :
			the_post();

			

			// display news blog posts


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
