<?php
/**
 * The template for displaying author archive pages.
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
    <?php $author_id = get_query_var('author'); $author_post_url = get_author_posts_url($author_id); $author_description = get_the_author_meta('description'); $post_formats = get_post_format(); global $post;?>
    <section id="container" class="<?php echo universal_get_layout_classes(); ?>">
        <?php if (!empty($author_description)) : ?>
            <!-- Author Box -->
            <section id="author-page-author-box" class="author-box u-flex u-flex-row">
                <?php
                // Get the author's name and job title
                $author_name = get_the_author();

                // Get the author's bio
                $author_bio = get_the_author_meta('description');

                // Get the author's website link
                $author_website = get_the_author_meta('user_url');
                ?>

                <!-- Get the authors profile picture -->
                <div class="author-avatar">
                    <?php echo universal_get_the_author_avatar(get_the_author_meta('ID'), 128); ?>
                </div>

                <div class="author-info u-flex u-flex-col u-flex-gap-5 u-ai-s">
                    <h2 class="author-name"><?php echo $author_name; ?></h2>
                    <div class="author-bio"><?php echo $author_bio; ?></div>

                    <?php if (!empty($author_website) && !get_theme_mod('universal_hide_author_website', false)) : ?>
                        <a class="website-link" href="<?php echo $author_website; ?>"><?php echo __('Website', 'universal-theme'); ?></a>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <?php get_template_part('layouts/layout', universal_get_layout()); ?>
        <?php else : ?>
            <?php echo universal_error_container('Sorry', 'No Post Found.') ?>
        <?php endif; ?>

        <!-- Pagination -->
        <?php echo universal_pagination(); ?>
    </section>
<?php get_footer(); ?>
