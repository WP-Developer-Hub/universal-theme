<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>

<?php get_header(); ?>
<?php $universal_error_message = get_theme_mod('universal_404_message', 'Page Not Found.'); ?>
    <section id="container" class="u-grid u-grid-gap-10 width-search-form">
        <?php echo universal_error_container('404', 'Page Not Found.') ?>
    </section>
<?php get_footer(); ?>
