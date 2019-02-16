<?php
/**
 * Callie Helpers
 *
 * @package    Callie
 * @version    1.0
 * @author     CreativeLibrary <creativelibraryemail>
 * @copyright  Copyright (c) 2018, CreativeLibrary
 * @link       demolinkhere
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Customize the post excerpt more
 *
 * @since 1.0
 */
if ( ! function_exists('callie_custom_excerpt_length') ) {
	function callie_custom_excerpt_length( $more ) {
		return '';
	}

	add_filter( 'excerpt_more', 'callie_custom_excerpt_length' );
}

/**
 * The Excerpt
 *
 * @since 1.0
 */
if ( ! function_exists('callie_custom_excerpt_length') ) {
	function callie_custom_excerpt_length( $length ) {
	 	return 55;
	}

	add_filter( 'excerpt_length', 'callie_custom_excerpt_length', 999 );
}
function callie_limit_words($string, $word_limit) {
 	$words = explode(' ', $string, ($word_limit + 1));
 	if ( count($words) > $word_limit ) {
 		array_pop($words);
 	}
 	return implode(' ', $words);
}

/**
 * Display only one category
 * @since 1.0
 */
if ( ! function_exists('callie_category') ) {
	function callie_category() {

		global $wp_query;
		$category = get_the_category();

		if ($category) {
			echo '<a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . $category[0]->cat_name . '</a>';
		}

	}
}

/**
 * Callie Social Share Links
 * @since 1.0
 */
if ( ! function_exists('callie_social_share_links') ) {
	function callie_social_share_links() {

		if (get_theme_mod('share_facebook')) : ?><li><a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('Share on Facebook','callie'); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
		<?php if(get_theme_mod('share_twitter')) : ?><li><a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php echo esc_url(get_the_permalink()); ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('Tweet This Post','callie'); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
		<?php if(get_theme_mod('share_pinterest')) : ?><li><a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_the_permalink()); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('Pin This Post','callie'); ?>"><i class="fa fa-pinterest-p"></i></a></li><?php endif; ?>
		<?php if(get_theme_mod('share_google-plus')) : ?><li><a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo esc_url(get_the_permalink()); ?>&amp;description=<?php the_title(); ?>', 'gooogleplusShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('Google Plus Share','callie'); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
		<?php if(get_theme_mod('share_linkedin')) : ?><li><a href="#" onclick="window.open('https://www.linkedin.com/shareArticle?url=<?php echo esc_url(get_the_permalink()); ?>&amp;description=<?php the_title(); ?>', 'linkedinShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('linkedin Share','callie'); ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
		<?php if(get_theme_mod('share_reddit')) : ?><li><a href="#" onclick="window.open('http://reddit.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;description=<?php the_title(); ?>', 'redditShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('Reddit Share','callie'); ?>"><i class="fa fa-reddit"></i></a></li><?php endif; ?>
		<?php if(get_theme_mod('share_tumblr')) : ?><li><a href="#" onclick="window.open('http://www.tumblr.com/share/link?=<?php echo esc_url(get_the_permalink()); ?>&amp;description=<?php the_title(); ?>', 'tumblrShare', 'width=626,height=436'); return false;" title="<?php echo esc_html_e('Tumblr Share','callie'); ?>"><i class="fa fa-tumblr"></i></a></li><?php endif;
	}
}