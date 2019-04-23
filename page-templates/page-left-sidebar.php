<?php 
/**
 * Template Name: Left Sidebar
 * Template Post Type: page
 */
get_header();
$class = '';

if ( !is_active_sidebar( 'sidebar-primary' ) ) {
    $class = ' nowidget-full';
}
?>

<!-- Content
================================================== -->
<div class="content">
    <div class="container">
        <div class="content-row">
            
            <!-- Postbar -->
            <main class="postbar pull-right">
                    
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

            <?php if ( is_active_sidebar( 'sidebar-primary' )  ) : ?>
            <!-- Sidebar -->
            <aside class="sidebar pull-left">

                <?php get_sidebar(); ?>

            </aside>
            <!-- Sidebar / End -->
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- Content / End -->

<?php get_footer(); ?>