<?php
/**
 * Callie Filters
 *
 * @package    Callie
 * @version    1.0
 * @author     CreativeLibrary <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, CreativeLibrary
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Extend the default WordPress body class
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 * @since 1.0
 */
function callie_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_single() || is_search() || is_page() || is_archive() ) {
        $classes[] = 'single';
    }

    if ( is_page() ) {
        $classes[] = 'page';
    }

    if ( is_home() || is_front_page() || is_search() || is_archive() ) {
        $classes[] = 'normal-page';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
 }
 add_filter( 'body_class', 'callie_body_classes' );


 /**
 * Content Class
 *
 * @since 1.0
 */
if ( ! function_exists('callie_content_class') ) {
    function callie_content_class() {
        $sidebar = get_theme_mod('home_sidebar', 'r_sidebar');

        if ( $sidebar == 'no_sidebar' ) {
            $class = 'fullwidth';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'pull-right';
            } else {
                $class = 'pull-left';
            }

        }

        return $class;
    }
}

 /**
 * Sidebar Class
 *
 * @since 1.0
 */
if ( ! function_exists('callie_sidebar_class') ) {
    function callie_sidebar_class() {
        $sidebar = get_theme_mod('home_sidebar', 'r_sidebar');

        if ( $sidebar == 'no_sidebar' ) {
            $class = 'hidden';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'pull-left';
            } else {
                $class = 'pull-right';
            }

        }

        return $class;
    }
}

 /**
 * Single Content Class
 *
 * @since 1.0
 */
if ( ! function_exists('callie_single_content') ) {
    function callie_single_content() {
        $sidebar = get_theme_mod('single_sidebar', 'r_sidebar');

        if ( $sidebar == 'no_sidebar' ) {
            $class = 'fullwidth';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'pull-right';
            } else {
                $class = 'pull-left';
            }

        }

        return $class;
    }
}

 /**
 * Single Sidebar Class
 *
 * @since 1.0
 */
if ( ! function_exists('callie_single_sidebar') ) {
    function callie_single_sidebar() {
        $sidebar = get_theme_mod('single_sidebar', 'r_sidebar');

        if ( $sidebar == 'no_sidebar' ) {
            $class = 'hidden';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'pull-left';
            } else {
                $class = 'pull-right';
            }
            
        }

        return $class;
    }
}

 /**
 * Archive Content Class
 *
 * @since 1.0
 */
if ( ! function_exists('callie_archive_content') ) {
    function callie_archive_content() {
        $sidebar = get_theme_mod('archive_sidebar', 'r_sidebar');

        if ( $sidebar == 'no_sidebar' ) {
            $class = 'fullwidth';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'pull-right';
            } else {
                $class = 'pull-left';
            }

        }

        return $class;
    }
}

 /**
 * Archive Sidebar Class
 *
 * @since 1.0
 */
if ( ! function_exists('callie_archive_sidebar') ) {
    function callie_archive_sidebar() {
        $sidebar = get_theme_mod('archive_sidebar', 'r_sidebar');

        if ( $sidebar == 'no_sidebar' ) {
            $class = 'hidden';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'pull-left';
            } else {
                $class = 'pull-right';
            }
            
        }

        return $class;
    }
}

if ( ! function_exists( 'callie_custom_tag_cloud_widget' ) ) {

    /**
     * Modifies tag cloud widget arguments to have all tags in the widget same font size.
     *
     * @param array $args Arguments for tag cloud widget.
     * @return array A new modified arguments.
     */

    function callie_custom_tag_cloud_widget( $args ) {

       $args['largest'] = 13;  // Largest tag
       $args['smallest'] = 13; // Smallest tag
       $args['unit'] = 'px';   // Tag font unit
       return $args;
       
    }

    add_filter( 'widget_tag_cloud_args', 'callie_custom_tag_cloud_widget' );
}

/**
 * Rewrite Categories Widget
 *
 * @since Callie 1.0
 */
if ( ! function_exists( 'callie_filter_the_category_widget' ) ) {

    function callie_filter_the_category_widget( $links ) {
        $links = str_replace('<a', '<a class="cat"', $links);
        $links = str_replace('</a> (', '<span class="count">(', $links);
        $links = str_replace(')', ')</span></a>', $links);
        return $links;
    }

    add_filter( 'wp_list_categories', 'callie_filter_the_category_widget' );
}

/**
 * Move Comment Textarea to bottom
 *
 * @since 1.0
 */
if ( ! function_exists('callie_move_comment_field_to_bottom') ) {
    function callie_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;

        return $fields;
    }

    add_filter( 'comment_form_fields', 'callie_move_comment_field_to_bottom', 99,1 );
}