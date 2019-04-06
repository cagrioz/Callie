<?php
/**
 * The header for our theme
 *
 * @package Callie
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>
    <div class="wrapper">

        <!-- Header
        ================================================== -->
        <header class="header">
            <div class="container">
                
                <!-- Logo -->
                <div class="logo" itemscope itemtype="http://schema.org/WebPage">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                <?php endif; ?>
                </div>
                <!-- Logo / End -->

                <!-- Mobile Navigation Toggle -->
                <span class="mobile-toggle"><i class="fa fa-bars"></i></span>
                <!-- Mobile Navigation Toggle / End -->

                <!-- Navigation -->
                <nav class="navigation">

                    <!-- Main Menu -->
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => 'main-menu'
                    ) );
                    ?>
                    <!-- Main Menu / End -->

                    <!-- Navigation Socials -->
                    <ul class="navigation-socials">
                        <?php callie_social_profiles(); ?>
                    </ul>
                    <!-- Navigation Socials / End -->

                </nav>
                <!-- Navigation / End -->

            </div>
        </header>
        <!-- Header / End -->

        <!-- Mobile Menu
        ================================================== -->
        <div class="mobile-menu">

            <!-- Mobile Menu Header -->
            <div class="mobile-menu-header">
                
                <!-- Mobile Logo -->
                <div class="mobile-logo" itemscope itemtype="http://schema.org/WebPage">
                    <?php if ( has_custom_logo() ) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php endif; ?>
                </div>

                <!-- Mobile Navigation Toggle -->
                <span class="mobile-toggle"><i class="fa fa-close"></i></span>

            </div>
            <!-- Mobile Menu Header / End -->

            <!-- Mobile Navigation -->
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container'      => false,
                'menu_class'     => 'mobile-navigation'
            ) );
            ?>
            <!-- Mobile Navigation / End -->

        </div>
        <!-- Mobile Menu / End -->

        <?php
        $story_hide           = get_theme_mod('hide_story', false);
        $story_qty            = get_theme_mod('story_qty', 6);
        $story_img_duration   = get_theme_mod('story_img_duration', 3);
        $story_video_duration = get_theme_mod('story_video_duration', '');

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $story_qty,
            'ignore_sticky_posts' => '1',
            'meta_query' => array(
                array(
                    'key'       => 'callie_story',
                    'value'     => '1',
                    'compare'   => '=',
                ),
            ),
        );

        $query = new WP_Query($args);

        $images = [];
        ?>

        <?php if ( !$story_hide && $query->have_posts() ) : ?>
        <!-- Stories
        ================================================== -->
        <div class="stories">
            <div class="container">
                    
                <div class="story-inner">

                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <?php $files = rwmb_meta("callie_story_media", "type=image&size=callie_thumb"); ?>

                        <?php if ( has_post_thumbnail() && $files ) : ?>
                        <!-- Story -->
                        <div class="story-view-item" style="background-image: url( <?php esc_url( the_post_thumbnail_url('callie_story_thumb') ); ?> );">

                            <ul class="media">

                                <?php foreach ( $files as $file ) : ?>

                                <?php if (isset($file['fileformat'])) : ?>
                                    <?php if ($file['fileformat'] == 'mp4') : ?>
                                        <li data-duration="<?php if ($story_video_duration) {echo esc_attr($story_video_duration);} else {echo esc_attr($file['length']);} ?>"><video src="<?php echo esc_url($file['url']); ?>" controls></video></li>
                                    <?php else : ?>
                                        <li data-duration="3"><h3>MP4 fileformat is only allowed in story.</h3></li>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <li data-duration="<?php echo esc_attr($story_img_duration); ?>"><img src="<?php echo esc_url($file['url']); ?>" alt="<?php echo bloginfo('name'); ?> Story" /></li>
                                    <?php
                                    $images[] = $file['url'];
                                    ?>
                                <?php endif; ?>

                                <?php endforeach; ?>

                            </ul>
                            
                        </div>
                        <!-- Story / End -->
                        <?php endif; ?>

                    <?php endwhile; wp_reset_postdata(); ?>

                </div>

                <ul class="story-bg">
                <?php if (count($images) >= 5) : ?>

                    <?php for ($i = 0; $i < count($images); $i++) : ?>
                        <?php if ( $i == 5 ) { break; } ?>
                        <li><img src="<?php echo esc_url( $images[$i] ); ?>" alt="<?php echo bloginfo('name'); ?> story background"></li>
                    <?php endfor; ?>

                <?php else : ?>

                    <?php
                    $recent_args = array(
                        'numberposts' => 5,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                        'post_type' => 'post',
                        'meta_query' => array(
                            array(
                             'key' => '_thumbnail_id',
                             'compare' => 'EXISTS'
                            ),
                        )
                    );
                    $recent_posts = wp_get_recent_posts( $recent_args );

                    $alternative_bgs = array(
                        'url' => array(),
                        'alt' => array()
                    );
                    $recent_ids = [];

                    // Pull post IDs which has images
                    foreach ($recent_posts as $post) {
                        $recent_ids[] = $post['ID'];
                    }

                    // Push thumbnail URLs using IDs
                    foreach ($recent_ids as $id) {
                        $alternative_bgs['url'][] = get_the_post_thumbnail_url( $id, 'callie_widget_post');
                        $alternative_bgs['alt'][] = get_post_meta( $id, '_wp_attachment_image_alt', true);
                    }
                    ?>

                    <?php for ($i = 0; $i < count($alternative_bgs['url']); $i++) : ?>
                        <li><img src="<?php echo esc_url( $alternative_bgs['url'][$i] ); ?>" alt="<?php echo esc_attr( $alternative_bgs['alt'][$i] ); ?>"></li>
                    <?php endfor; ?>

                <?php endif; ?>
                </ul>

            </div>
        </div>
        <!-- Stories / End -->
        <?php endif; ?>