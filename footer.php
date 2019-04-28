<?php
/**
 * The template for displaying the footer
 *
 * @package    Callie
 * @version    1.0
 * @author     useCSS <cagriozarpaciii@gmail.com>
 * @copyright  Copyright (c) 2019, useCSS
 * @link       https://clibrary.pro/callie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>

<!-- Footer
================================================== -->
<?php if ( is_active_sidebar( 'footer-widget-1') || is_active_sidebar( 'footer-widget-2') || is_active_sidebar( 'footer-widget-3') || is_active_sidebar( 'footer-widget-4') ) : ?>
<footer class="footer">
    <div class="container">
        <div class="row">

            <?php callie_footer_widgets(); ?>

        </div>
    </div>
</footer>
<!-- Footer / End -->
<?php endif; ?>

</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<?php wp_footer(); ?>

</body>

</html>