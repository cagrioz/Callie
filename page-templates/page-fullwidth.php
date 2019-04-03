<?php 
/**
 * Template Name: Full Width
 * Template Post Type: page
 */
get_header(); ?>

<!-- Content
================================================== -->
<div class="content">
    <div class="container">
        <div class="content-row">
            
            <!-- Postbar -->
            <main class="postbar fullwidth">
                    
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

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>