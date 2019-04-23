<?php
/**
 * The template file for content of pages
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

        </div>

        <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('callie_thumb'); ?>
        </div>  
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

    <?php comments_template( '', true ); ?>

</article>