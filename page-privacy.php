<?php
/**
 * The template for displaying the privacy policy page.
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
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class("post-common post-common-bg post-single"); ?>>
            <?php the_content(); ?>
        </article>
    <?php endwhile; else : ?>
        <?php echo universal_error_container('Sorry', 'No Page Found.') ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>
