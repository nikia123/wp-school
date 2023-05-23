<?php
/**
 * News Page Template
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
				$news_posts -> the_post(); 

				   	$image_id = get_post_thumbnail_id();
					$image_srcset = wp_get_attachment_image_srcset($image_id, 'full');
					$image_attributes = [
						'srcset' => $image_srcset,
						'sizes' => '100vw',
						'class' => 'news__item-img',
					];
					$image_html = wp_get_attachment_image($image_id, 'full', false, $image_attributes);

				?>
				<!-- AOS, see js/scroll-animate to adjust -->
				<article data-aos="fade-up" class="news">
					<div class="news__item">
						<a class="news__item-link" href=" <?php the_permalink(); ?> ">
							<h2 class="news__item-title"> <?php the_title(); ?> </h2>
						</a> 
	
						<p><?php bazinga_posted_on() ?> by <?php bazinga_posted_by() ?></p> 
	
						<a href=" <?php the_permalink(); ?> " > 
							<?php echo $image_html; ?> 
						</a>
	
						<?php the_excerpt(); ?>
	
						<p class='container'>
							<span>
								Posted in <?php the_category(', '); ?> &nbsp; &nbsp; &nbsp; &nbsp;
							</span>
							<span>
								Tagged with: <?php the_tags(''); ?> &nbsp; &nbsp; &nbsp; &nbsp;
							</span>
							<span>
								<a href="<?php comments_link(); ?>">Leave a comment</a>
							</span>
						</p>

					</div>

						
				</article>

				<?php

			}

			wp_reset_postdata();
		}


		while ( have_posts() ) :
			the_post();

			


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
