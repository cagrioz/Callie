<?php
/**
 * The template part to show posts as ordered
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <support@devfeels.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>

<!-- Post Navigation -->
<div class="post-navigation">
    <div class="row">

        <?php $prevPost = get_previous_post();
            if (!empty( $prevPost )) :
                $args = array('posts_per_page' => 1,'include' => $prevPost->ID);
                $prevPost = get_posts($args);
                foreach ($prevPost as $post) :
                    setup_postdata($post);
        ?>
        <!-- Previous Post -->
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="prev-post col6">
                <div class="post-navigation-inner">

                    <?php the_title( sprintf( '<div class="post-title"><h3>', esc_url( get_permalink() ) ), '</h3></div>' ); ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() .'/assets/icons/prev.svg' ); ?>" alt="prev post">

                </div>
            </div>
        </a>
        <!-- Previous Post / End -->
        <?php
                    wp_reset_postdata();
                endforeach;
            endif;

            $nextPost = get_next_post();
            if (!empty( $nextPost )) :
                $args = array(
                    'posts_per_page' => 1,
                    'include' => $nextPost->ID
                );
                $nextPost = get_posts($args);
                foreach ($nextPost as $post) :
                    setup_postdata($post);
        ?>
        <!-- Next Post -->
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="next-post col6">
                <div class="post-navigation-inner">

                    <?php the_title( sprintf( '<div class="post-title"><h3>', esc_url( get_permalink() ) ), '</h3></div>' ); ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() .'/assets/icons/next.svg' ); ?>" alt="next post">

                </div>
            </div>
        </a>
        <!-- Next Post / End -->
        <?php
                    wp_reset_postdata();
                endforeach;
            endif;
        ?>
    </div>
</div>
<!-- Post Navigation / End -->