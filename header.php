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
                <div class="logo">
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
                <div class="mobile-logo">
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
            <ul class="mobile-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container'      => false,
                    'menu_class'     => 'main-menu'
                ) );
                ?>
            </ul>
            <!-- Mobile Navigation / End -->

        </div>
        <!-- Mobile Menu / End -->

        <?php 

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 6,
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
        ?>

        <?php if ( $query->have_posts() ) : ?>
        <!-- Stories
        ================================================== -->
        <div class="stories">
            <div class="container">
                    
                <div class="story-inner">

                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <?php 
                        $images = array(
                            'url' => array(),
                            'alt' => array()
                        );
                        $files = rwmb_meta("callie_story_media"); 
                        ?>

                        <?php if ( has_post_thumbnail() ) : ?>
                        <!-- Story -->
                        <div class="story-view-item" style="background-image: url( <?php esc_url( the_post_thumbnail_url('callie_story_thumb') ); ?> )">

                            <?php if ($files) : ?>
                            <ul class="media">

                                <?php foreach ( $files as $file ) : ?>

                                <?php if ($file['fileformat'] !== 'mp4') : ?>
                                    <li data-duration="3"><img src="<?php echo esc_url($file['url']); ?>" alt="<?php echo esc_attr($file['alt']); ?>" /></li>
                                    <?php
                                    $images['url'][] = $file['url'];
                                    $images['alt'][] = $file['alt'];
                                    ?>
                                <?php else : ?>
                                    <li data-duration="<?php echo $file['length']; ?>"><video src="<?php echo esc_url($file['url']); ?>" controls></video></li>
                                <?php endif; ?>

                                <?php endforeach; ?>

                            </ul>
                            <?php endif; ?>
                            
                        </div>
                        <!-- Story / End -->
                        <?php endif; ?>

                    <?php endwhile; ?>

                </div>

                <?php if (count($images['url']) >= 3) : ?>
                <ul class="story-bg">

                    <?php for ($i = 0; $i < count($images['url']); $i++) : ?>

                        <?php if ( $i == 5 ) { break; } ?>
                        <li><img src="<?php echo esc_url( $images['url'][$i] ); ?>" alt="<?php echo esc_attr( $images['alt'][$i] ); ?>"></li>

                    <?php endfor; ?>

                </ul>
                <?php endif; ?>

            </div>
        </div>
        <!-- Stories / End -->
        <?php endif; ?>