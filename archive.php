<?php
/**
 * The archive template file.
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

get_header(); ?>

<div class="archive-title-wrap">
    <div class="container">
        <div class="title-block">
            <h4><?php
            if ( is_category() ) :
                printf( esc_html__( '%s', 'callie' ), single_cat_title('', false) );
            elseif ( is_tag() ) :
                printf( esc_html__( '%s', 'callie' ), single_tag_title('', false) );
            elseif ( is_author() ) :
                printf( esc_html__( '%s', 'callie' ), get_the_author() );
            elseif ( is_day() ) :
                printf( esc_html__( '%s', 'callie' ), get_the_date() );
            elseif ( is_month() ) :
                printf( esc_html__( '%s', 'callie' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'callie' ) ) );
            elseif ( is_year() ) :
                printf( esc_html__( '%s', 'callie' ), get_the_date( _x( 'Y', 'yearly archives date format', 'callie' ) ) );
            else :
                esc_html_e( 'Archives', 'callie' );
            endif;
            ?></h4>
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

            <!-- Sidebar -->
            <aside class="sidebar <?php echo esc_attr(callie_archive_sidebar()); ?>">

                <?php get_sidebar();?>

            </aside>
            <!-- Sidebar / End -->

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>