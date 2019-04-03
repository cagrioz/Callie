<?php
/**
 * Callie functions and definitions
 *
 * @package    Callie
 * @version    1.0
 * @author     CreativeLibrary <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, CreativeLibrary
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

define( 'CALLIE_VERSION', '1.0.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 970;
}

/**
 * Includes
 */
include get_template_directory() . '/inc/functions/callie_setup.php';
include get_template_directory() . '/inc/functions/callie_filters.php';
include get_template_directory() . '/inc/functions/callie_helpers.php';

require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/custom-styles.php';

include get_template_directory() . '/inc/tgm/tgm-plugin-registration.php';

/**
 * Metabox
 */
include get_template_directory() . '/inc/metabox/callie_metaboxes.php';

/**
 * Widgets
 */
include get_template_directory() . '/inc/widgets/widget_social_icons.php';
include get_template_directory() . '/inc/widgets/widget_blog_post.php';
include get_template_directory() . '/inc/widgets/widget_twitter.php';
include get_template_directory() . '/inc/widgets/widget_story.php';