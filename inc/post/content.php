<?php
/**
 * The template part for displaying standard post content
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

    <?php 
    // Gallery Post Format
    if ( has_post_format('gallery') ) : ?>

        <?php if ( has_post_thumbnail() && !get_theme_mod('hide_post_images', false) ) : ?>
        <div class="post-thumbnail">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('callie_thumb'); ?></a>
        </div>
        <?php else :
        $images = rwmb_meta("callie_gallery_format", "type=image&size=callie_thumb"); 
        $first_array = reset($images);
        $first_image = $first_array['full_url'];
        ?>
        <div class="post-thumbnail">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url( $first_image ); ?>" alt="<?php echo esc_attr( $first_array['alt'] ); ?>" width="<?php echo esc_attr( $first_array['width'] ); ?>" height="<?php echo esc_attr( $first_array['height'] ); ?>"></a>
        </div>
        <?php endif; ?>

    <?php 
    // Video Post Format
    elseif ( has_post_format('video') ) : ?>

        <?php $callie_video = get_post_meta( $post->ID, "callie_video_format", true ); ?>

        <?php if ( $callie_video && has_post_thumbnail() ) : ?>

            <?php
            $iframe_url = '';
            if ( wp_oembed_get($callie_video) ) {
                $iframe_url = wp_oembed_get($callie_video);
            } else {
                $iframe_url = wp_kses_post($callie_video);
            }
            ?>

            <a class="post-thumbnail video" href="<?php echo esc_attr( $iframe_url ); ?>">
                <?php the_post_thumbnail('callie_thumb'); ?>
                <span class="play-icon">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/icons/play.png' ); ?>" alt="<?php echo esc_attr__( bloginfo('name') . ' play icon', 'callie'); ?>">
                </span>
            </a>

        <?php else : ?>

            <?php if ( has_post_thumbnail() && !get_theme_mod('hide_post_images', false) ) : ?>
            <div class="post-thumbnail">
                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('callie_thumb'); ?></a>
            </div>  
            <?php endif; ?>

        <?php endif; ?>

    <?php 
    // Default/Standard Post Format
    else : ?>

        <?php if ( has_post_thumbnail() && !get_theme_mod('hide_post_images', false) ) : ?>
        <div class="post-thumbnail">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('callie_thumb'); ?></a>
        </div>  
        <?php endif; ?>

    <?php endif; ?>
    
    <div class="post-title">
        <h1><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h1>
    </div>

    <?php if ( function_exists('rwmb_meta') ) : ?>

    <?php if ( !rwmb_meta( 'callie_hide_excerpt' ) ) : ?>    
    <div class="post-text">

        <p class="post-excerpt"><?php echo callie_limit_words(get_the_excerpt(), 26); ?></p>

    </div>
    <?php endif; ?>

    <?php else : ?>

    <div class="post-text">
    
        <p class="post-excerpt"><?php echo callie_limit_words(get_the_excerpt(), 26); ?></p>
    
    </div>

    <?php endif; ?>

    <a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/icons/next.svg' ); ?>" alt="<?php echo esc_attr__( bloginfo('name') . ' read more', 'callie'); ?>"></a>

</article>
