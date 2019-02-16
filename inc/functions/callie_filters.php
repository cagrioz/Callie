<?php
/**
 * Callie Filters
 *
 * @package    Callie
 * @version    1.0
 * @author     CreativeLibrary <creativelibraryemail>
 * @copyright  Copyright (c) 2018, CreativeLibrary
 * @link       demolinkhere
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
            $class = 'postbar fullwidth';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'postbar pull-right';
            } else {
                $class = 'postbar pull-left';
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

        if ( $sidebar == 'l_sidebar' ) {
            $class = 'sidebar pull-left';
        } else {
            $class = 'sidebar pull-right';
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
            $class = 'postbar fullwidth';
        } else {

            if ( $sidebar == 'l_sidebar' ) {
                $class = 'postbar pull-right';
            } else {
                $class = 'postbar pull-left';
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

        if ( $sidebar == 'l_sidebar' ) {
            $class = 'sidebar pull-left';
        } else {
            $class = 'sidebar pull-right';
        }

        return $class;
    }
}