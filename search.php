<?php
/**
 * The search template file.
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

get_header(); ?>

<div class="search-title-wrap">
    <div class="container">
        <div class="title-block">
            <h4><?php printf( esc_html__( 'Search Results for: %s', 'callie' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h4>
        </div>
    </div>
</div>

<!-- Content
================================================== -->
<div class="content masonry-layout">
    <div class="container">
        <div class="content-row">
            
            <!-- Postbar -->
            <main class="postbar <?php echo esc_attr(callie_archive_content()); ?>">

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

            <?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
            <!-- Sidebar -->
            <aside class="sidebar <?php echo esc_attr(callie_archive_sidebar()); ?>">

                <?php get_sidebar();?>

            </aside>
            <!-- Sidebar / End -->
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>