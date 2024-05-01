<?php
/**
 * The template for the homepage.
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
    <section id="container" class="<?php echo universal_get_layout_classes(); ?>">
        <?php if (is_category()) : ?>
            <header class="page-heading u-tt-all-uppercase">
                <h1 id="archive-title"><?php single_cat_title(); ?></h1>
            </header>
        <?php endif; ?>
        <?php if (have_posts()) : ?>
            <?php get_template_part('layouts/layout', universal_get_layout()); ?>
        <?php else : ?>
            <?php echo universal_error_container('Sorry', 'No Posts Found.') ?>
        <?php endif; ?>

        <!-- Pagination -->
        <?php echo universal_pagination(); ?>
    </section>
<?php get_footer(); ?>
