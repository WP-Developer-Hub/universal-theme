<?php
/**
 * The template for displaying search results.
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
    <section id="container" class="u-grid u-grid-gap-10 width-search-form">
        <header class="page-heading u-tt-all-uppercase">
            <h1 id="archive-title"><?php _e( 'Search Results For', 'universal-theme'); ?>: &quot;<?php the_search_query(); ?>&quot;</h1>
        </header>
        <header class="page-heading u-pos-sti">
            <?php get_search_form(); ?>
        </header>
        <?php if (have_posts() && strlen(trim(get_search_query())) != 0) : ?>
            <?php get_template_part('layouts/layout', universal_get_layout()); ?>
        <?php else : ?>
            <?php echo universal_error_container('Sorry', 'No Results Found.') ?>
        <?php endif; ?>

        <!-- Pagination -->
        <?php echo universal_pagination(); ?>
        <script type="text/javascript">
            // Focus on the search field after it has loaded
            document.getElementById('s') && document.getElementById('s').focus();
        </script>
    </section>
<?php get_footer(); ?>
