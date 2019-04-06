<?php
/**
 * The template part to show related posts
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);

if ( $categories ) :

	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 3,
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$related_query = new wp_query( $args );

	if ( $related_query->have_posts() ) : ?>

		<!-- Related Posts -->
		<div class="related-posts">
            <div class="related-posts-wrapper owl-carousel">

				<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
            	<!-- Related Post -->
                <div class="related-post">

                    <?php if ( has_post_thumbnail() ) : ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'callie_widget_post' ); ?>
						<a href="<?php echo esc_url(get_the_permalink()); ?>">
	                        <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"/>
						</a>
					<?php endif; ?>

                    <div class="related-post-content">
						<?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
						<p><?php echo callie_limit_words(get_the_excerpt(), 18); ?></p>
                    </div>
                </div>
                <!-- Related Post / End -->
				<?php endwhile; ?>

			</div>
		</div>
		<!-- Related Posts / End -->
		
		<?php
	endif;
endif;

	$post = $orig_post;

	wp_reset_postdata();
?>