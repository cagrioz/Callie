<?php
/**
 * The template for displaying the index.
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

get_header(); ?>

<!-- Content
================================================== -->
<div class="content masonry-layout">
    <div class="container">
        <div class="content-row">
            
            <!-- Postbar -->
            <main class="postbar <?php echo esc_attr(callie_content_class()); ?>">

                <!-- Masonry -->
                <div class="masonry">
                    
                    <?php 
                    if ( have_posts() ) :

                        // Post Loop
                        while ( have_posts() ) : the_post();

                            get_template_part( 'inc/post/content' );
                                
                        endwhile;
                        
                    else :

                        get_template_part( 'inc/post/content-none' );

                    endif;
                    ?>

                </div>
                <!-- Masonry / End -->
                
                <?php
                if (  $wp_query->max_num_pages > 1 ) :
                    callie_loadmore();
                endif;
                ?>

            </main>
            <!-- Postbar / End -->

            <!-- Sidebar -->
            <aside class="sidebar <?php echo esc_attr(callie_sidebar_class()); ?>">

               	<?php get_sidebar();?>

            </aside>
            <!-- Sidebar / End -->

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>