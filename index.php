<?php
/**
 * The main template file.
 *
 * This is the fallback template used to display content when more specific templates
 * are not available. It is also used to display the home page if a more specific
 * home template is not provided.
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
        <header class="page-heading u-tt-all-uppercase">
            <h1 id="archive-title"><?php single_cat_title(); ?></h1>
        </header>
        <?php if (have_posts()) : ?>
            <?php get_template_part('layouts/layout', universal_get_layout()); ?>
        <?php else : ?>
            <?php echo universal_error_container('Sorry', 'No Posts Found.') ?>
        <?php endif; ?>
    </section>
    <!-- Pagination -->
    <?php echo universal_pagination(); ?>
<?php get_footer(); ?>
