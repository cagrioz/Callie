<?php
/**
 * Callie Helpers
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
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
        $output = '';
    	$socials = callie_socials();

	    foreach ( $socials as $social => $media ) :
			if ( get_theme_mod('social_' . $social, '') ) : 

                $output .= '<a href="' . esc_url( get_theme_mod( 'social_' . $social, '' ) ) . '"><i class="fa fa-' . esc_attr($social) . '"></i></a>';

            endif;
		endforeach;

        return $output;
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

if ( !function_exists( 'callie_allowed_html_tags' ) ) {
  /**
   * Allowed html tags for wp_kses() function
   *
   * @return array Array of allowed html tags.
   */
  function callie_allowed_html_tags() {
    return array(
      'a' => array(
        'href' => array(),
        'title' => array(),
        'class' => array(),
        'data' => array(),
        'rel'   => array()
      ),
      'h4' => array(
        'class' => array()
      ),
      'script' => array(
        'type' => array()
      ),
      'label' => array(
        'class' => array(),
        'for' => array()
      ),
      'input' => array(
        'type' => array(),
        'id' => array(),
        'name' => array(),
        'value' => array(),
        'class' => array()
      ),
      'i' => array(
        'class' => array(),
        'title' => array(),
        'rel'   => array()
      ),
      'img' => array(
        'src' => array(),
        'height' => array(),
        'width' => array(),
        'alt' => array(),
        'class' => array(),
        'title'   => array()
      ),
      'p' => array(
      	'class' => array()
      ),
      'br' => array(),
      'em' => array(),
      'ul' => array(
          'class' => array()
      ),
      'ol' => array(
          'class' => array()
      ),
      'li' => array(
          'class' => array()
      ),
      'strong' => array(),
      'div' => array(
        'class' => array(),
        'data' => array(),
        'style' => array()
      ),
      'span' => array(
        'class' => array(),
        'style' => array()
      ),
      'cite' => array(
        'class' => array()
      ),

      'img' => array(
          'alt'    => array(),
          'class'  => array(),
          'height' => array(),
          'src'    => array(),
          'width'  => array()
      ),
      'form' => array(
          'action'   => array(),
          'method' => array(),
          'class' => array(),
          'id' => array(),
          'target' => array()
      ),
      'select' => array(
          'id'   => array(),
          'class' => array(),
          'onchange' => array(),
          'name' => array()
      ),
      'option' => array(
          'value' => array(),
          'selected' => array(),
          'class' => array()
      ),
      'table' => array(
          'id' => array(),
          'class' => array()
      ),
      'caption' => array(),
      'thead' => array(),
      'tbody' => array(),
      'th' => array(
        'scope' => array(),
        'title' => array()
      ),
      'tr' => array(),
      'td' => array(
      	'class' => array(),
      	'id' => array(),
        'colspan' => array()
      )
    );

  }
}

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Callie
 */

if ( ! function_exists( 'callie_footer_widgets' ) ){
	function callie_footer_widgets() {
		$output = '';
		$allowed_html = callie_allowed_html_tags();			
		// turn on buffering
		ob_start();
		
		for ($i = 1; $i <= 4; $i++) {
			?>
			<!-- Footer Column -->
			<div class="footer-column footer-column-<?php echo esc_attr($i); ?>">
			<?php
			if ( is_active_sidebar( 'footer-widget-' . $i ) ) {
				dynamic_sidebar( 'footer-widget-' . $i );	
			} 
			?>
			</div>
			<!-- Footer Column / End -->
			<?php 
		}

		$output .= ob_get_clean();

        echo wp_kses($output, $allowed_html);
	}
}