<?php
/**
 * The template for displaying attachment pages.
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
    <section id="container">
        <?php if (have_posts()) : ?>
            <section id="post-grid">
                <?php while (have_posts()) : the_post();
                    get_template_part('layouts/layout-attchment');
                endwhile; ?>
            </section>
        <?php else : ?>
            <?php echo universal_error_container('Sorry', 'No Archive Found.') ?>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>
