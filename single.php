<?php
/**
 * The template file for single post page.
 *
 * @package    Callie
 * @version    1.0
 * @author     Creative Library <support@devfeels.com>
 * @copyright  Copyright (c) 2018, Creative Library
 * @link       https://clibrary.pro/wp/lossless
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

get_header(); ?>

<!-- Content
================================================== -->
<div class="content">
    <div class="container">
        <div class="content-row">
            
            <!-- Postbar -->
            <main class="<?php echo esc_attr(callie_single_content()); ?>">
                    
                <?php 
                if ( have_posts() ) :

                    // Post Loop
                    while ( have_posts() ) : the_post();

                        get_template_part( 'inc/post/content-single' );
                            
                    endwhile;
                    
                else :

                    get_template_part( 'inc/post/content-none' );

                endif;
                ?>

            </main>
            <!-- Postbar / End -->

            <!-- Sidebar -->
            <aside class="sidebar <?php echo esc_attr(callie_single_sidebar()); ?>">

               	<?php get_sidebar();?>

            </aside>
            <!-- Sidebar / End -->

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>