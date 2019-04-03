<?php
/**
 * The template file for pages.
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <support@devfeels.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/wp/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

get_header(); ?>

<!-- Content
================================================== -->
<div class="content">
    <div class="container">
        <div class="content-row">
            
            <!-- Postbar -->
            <main class="postbar pull-left">
                    
                <?php 
                if ( have_posts() ) :

                    // Post Loop
                    while ( have_posts() ) : the_post();

                        get_template_part( 'inc/page/content-page' );
                            
                    endwhile;
                    
                else :

                    get_template_part( 'inc/post/content-none' );

                endif;
                ?>

            </main>
            <!-- Postbar / End -->

            <!-- Sidebar -->
            <aside class="sidebar pull-right">

               	<?php get_sidebar(); ?>

            </aside>
            <!-- Sidebar / End -->

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>