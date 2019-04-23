<?php
/**
 * Callie functions and definitions
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
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
include get_template_directory() . '/inc/functions/callie-setup.php';
include get_template_directory() . '/inc/functions/callie-filters.php';
include get_template_directory() . '/inc/functions/callie-helpers.php';

require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/custom-styles.php';

include get_template_directory() . '/inc/tgm/tgm-plugin-registration.php';

/**
 * Metabox
 */
include get_template_directory() . '/inc/metabox/callie-metaboxes.php';