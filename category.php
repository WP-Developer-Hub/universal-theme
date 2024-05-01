<?php
/**
 * The template for displaying category archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>

<?php print esc_html(get_header()); ?>
    <section id="container" class="<?php echo universal_get_layout_classes(); ?>">
        <header class="page-heading u-tt-all-uppercase u-glass-10">
            <h1 id="archive-title"><?php echo single_cat_title(); ?></h1>
        </header>
        <?php if (have_posts()) : ?>
            <?php get_template_part('layouts/layout', universal_get_layout()); ?>
        <?php else : ?>
            <?php echo universal_error_container('Sorry', 'No Posts Found.') ?>
        <?php endif; ?>

        <!-- Pagination -->
        <?php echo universal_pagination(); ?>
    </section>
<?php get_footer(); ?>
