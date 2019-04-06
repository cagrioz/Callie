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

    <!-- Post Inner -->
    <div class="post-inner">

        <!-- Post Header -->
        <div class="post-header">

            <!-- Post Title -->
            <div class="post-title">
                <h1><?php echo esc_attr( get_the_title() ); ?></h1>
            </div>

            <!-- Post Share -->
            <div class="post-share">
                <ul>
                    <?php callie_social_share_links(); ?>
                </ul>
            </div>

            <!-- Post Metas -->
            <div class="post-metas">
                <span class="post-cat"><?php callie_category(); ?></span>
                <span class="post-author"><?php the_author_posts_link(); ?></span>
                <span class="post-date"><time datetime="<?php echo get_the_time('c'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time></span>  
            </div>

        </div>

        <?php 
        // Gallery Post Format
        if ( has_post_format('gallery') ) : ?>

            <?php $images = rwmb_meta("callie_gallery_format", "type=image&size=callie_thumb"); ?>
            <div class="post-thumbnail gallery owl-carousel">

                <?php foreach ( $images as $image ) : ?>
                <div class='item'>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
                <?php endforeach; ?>

            </div>

        <?php 
        // Video Post Format
        elseif ( has_post_format('video') ) : ?>

            <?php $callie_video = get_post_meta( $post->ID, "callie_video_format", true ); ?>
            <?php if ($callie_video) : ?>
            <div class="post-thumbnail video">
                <?php
                if ( wp_oembed_get($callie_video) ) :
                    echo wp_oembed_get($callie_video);
                else : ?>
                    <div class="video-wrapper">
                    <?php if ( strpos($callie_video, 'youtube') ) : $sep_url = explode('v=', $callie_video); $video_id = $sep_url[1]; ?>
                        <iframe src="https://youtube.com/embed/<?php echo esc_attr($video_id); ?>" frameborder="0" allowfulscreen></iframe>
                    <?php elseif ( explode('vimeo.com/', $callie_video) ) : $sep_url = explode('vimeo.com/', $callie_video); $video_id = $sep_url[1]; ?>
                        <iframe src="https://player.vimeo.com/video/<?php echo esc_attr($video_id); ?>" frameborder="0" allowfulscreen></iframe>
                    <?php else : ?>
                        <h2>Please type video URL without protocol (https:// or http://) and make sure linking is correct.</h2>
                    <?php endif; ?>
                    </div>

                <?php endif; ?>
            </div>
            <?php else : ?>

                <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('callie_thumb'); ?>
                </div>  
                <?php endif; ?>

            <?php endif; ?>

        <?php 
        // Default/Standard Post Format
        else : ?>

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('callie_thumb'); ?>
            </div>  
            <?php endif; ?>

        <?php endif; ?>
        
        <!-- Post Text -->
        <div class="post-text">
          
            <?php 
            the_content();                    
            wp_link_pages( array(
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'callie' ),
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?>
           
       </div>

        <!-- Post Footer -->
        <div class="post-footer">

            <?php if(has_tag()) : ?>

            <!-- Post Tags -->
            <div class="post-tags">
                <?php echo get_the_tag_list('<ul><li><span>','</span></li><li><span>','</span></li></ul>'); ?>
            </div>
            <!-- Post Tags / End -->

            <?php endif; ?>

        </div>

    </div>
    <!-- Post Inner / End -->

    <?php if ( false == get_theme_mod( 'hide_post_pagination', false ) ) : get_template_part('inc/single/post_pagination'); endif; ?>

    <?php if ( false == get_theme_mod( 'hide_related_posts', false ) ) : get_template_part('inc/single/related_posts'); endif; ?>

    <?php comments_template( '', true ); ?>
    
</article>