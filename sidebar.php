<?php
/**
 * The template for displaying the sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>

<aside id="secondary" class="widget-area <?php echo is_single() ? '' : 'u-border-left'; ?> u-flex u-flex-col u-flex-gap-5">
    <?php dynamic_sidebar( 'main-sidebar' ); ?>
</aside>
