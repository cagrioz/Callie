<?php
/**
 * The archive template file.
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

get_header();
?>

<!-- Content
================================================== -->
<div class="content masonry-layout">
    <div class="container">
        <div class="content-row">

            <main class="postbar fullwidth">
				<div class="error-page">
				
                	<h1><?php esc_html_e( '404', 'callie' ); ?></h1>
                	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'callie' ); ?></p>
					
                	<?php get_search_form(); ?>

				</div>
			</main>

		</div>
	</div>
</section>

<?php get_footer(); ?>