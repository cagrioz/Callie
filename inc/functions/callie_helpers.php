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
 * Callie Load More
 *
 * @since 1.0
 */
if ( ! function_exists('callie_loadmore') ) {
	function callie_loadmore() { ?>
		<!-- Load More Button -->
		<div class="post-load-wrap">
			<div class="callie_loadmore"></div>
		</div>
		<!-- Load More Button / End -->
	 	<?php
	 	paginate_links();
	}
}

/**
 * Callie Socials
 * @return array
 * @since 1.0
 */
if ( ! function_exists('callie_socials') ) {
	function callie_socials() {
	    
		$socials = array(
	        'facebook'     => 'Facebook',
	        'twitter'      => 'Twitter',
	        'instagram'    => 'Instagram',
	        'pinterest'    => 'Pinterest',
	        'google-plus'  => 'Google Plus',
	        'tumblr'       => 'Tumblr',
	        'youtube-play' => 'Youtube',
	        'vimeo'        => 'Vimeo',
	        'dribbble'     => 'Dribbble',
	        'linkedin'     => 'Linkedin',
	        'rss'          => 'RSS'
	    );

		return $socials;
	}
}

/**
 * Callie Social Profiles
 * @since 1.0
 */
if ( ! function_exists('callie_social_profiles') ) {
	function callie_social_profiles() {

    	$socials = callie_socials();

	    foreach ( $socials as $social => $media ) :
			if ( get_theme_mod('social_' . $social, '') ) : 
	    		?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'social_' . $social, '' ) ); ?>"><i class="fa fa-<?php echo esc_html($social); ?>"></i></a></li>
                <?php
            endif;
		endforeach;

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

/**
 * Comments Layout
 *
 * @since 1.0
 */
if ( ! function_exists('callie_comments') ) {
/**
	* The function returns the html form comments.
	*
	* @param array  $comment comments array.
	* @param array  $args comments option.
	* @param number $depth comment depth.
	*/

	function callie_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		$comment_ID = get_comment_ID();

		$author_url = get_author_posts_url($comment->user_id);

		?>
	    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="comment-list-item">
				<?php echo get_avatar($comment,$args['avatar_size']); ?>
			    <div class="comment-content">
			    	<span class="comment-author"><a href="<?php echo esc_url( $author_url ); ?>" target="_blank"><?php echo get_comment_author_link( $comment_ID ); ?></a></span>
                    <span class="comment-date"><time datetime="<?php echo get_comment_date( 'Y', $comment_ID ); ?>"><?php printf( esc_html__(  '%s', 'callie' ), get_comment_date( 'j F Y', $comment_ID) ); ?></time></span>
				    <?php if ($comment->comment_approved == '0') : ?>
					   <em class="wa"><?php esc_html_e('Comment awaiting approval', 'callie'); ?></em><br />
				    <?php endif; ?>
				    <div class="comment-text">
					   <?php echo wp_kses_post( apply_filters( 'comment_text', get_comment_text() ) ) ?>
				    </div>
				    <span class="comment-reply">
					   <?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'callie'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment_ID); ?>
				    </span>
				    <span class="comment-edit"><?php edit_comment_link(esc_html__('Edit', 'callie')); ?></span>
				</div>
			</div>
	   <?php
	}
}