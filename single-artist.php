<?php
/**
 * The template for displaying single posts.
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

        <?php $artist_genres = get_post_meta(get_the_ID(), 'artist_genres', true); $artist_skills = get_post_meta(get_the_ID(), 'artist_skills', true); global $post;?>
            <section id="post-container" class="u-grid u-grid-wsb">
                <section id="post-<?php the_ID(); ?>" <?php post_class("post-common post-common-bg post-single u-flex u-flex-col u-flex-gap-5"); ?>>
                    <?php echo get_template_part('formats/format', $post_formats); ?>

                    <!-- Post Title -->
                    <h3 id="single-post-title" class="post-title"><?php the_title();?></h3>

                    <span class="u-spacer-h u-spacer-light"></span>

                    <!-- Post Meta Information -->
                    <section id="single-post-meta" class="post-meta-common">
                        <?php if (isset($artist_skills)) : ?>
                            <span id="published-on" class="meta-row meta-separator">
                                <span class="meta-label u-fw-ultra-thick"><?php _e('Skills:', 'universal-theme'); ?></span>
                                <span class="all-caps"><?php echo esc_html(implode(", ", $artist_skills)); ?></span>
                            </span>
                        <?php endif; ?>

                        <?php if (isset($artist_genres)) : ?>
                            <span id="skills" class="meta-row u-wrap-text-any">
                                <span class="meta-label u-fw-ultra-thick"><?php _e('Genres:', 'universal-theme'); ?></span>
                                <?php echo esc_html(implode(", ", $artist_genres)); ?>
                            </span>
                        <?php endif; ?>
                    </section>
                    <?php if (!empty($post->post_content) || !empty($post->post_excerpt)) : ?>
                        <span class="u-spacer-h u-spacer-light"></span>
                        <!-- Post Content -->
                        <section id="single-post-content" class="post-content-common u-reset u-wrap-text">
                            <?php the_content();?>
                        </section>
                    <?php endif; ?>

                    <?php if (!empty(get_the_tags())) : ?>
                        <!-- Post Tags -->
                        <h3 id="post-tags-title" class="u-fw-thick u-flex u-flex-row u-flex-gap-5 section-title">
                            <?php _e('Tags', 'universal-theme'); ?>
                        </h3>
                        <?php the_tags('<div id="post-tags" class="u-flex u-flex-row u-flex-wrap u-fs-14">', ' ', '</div>'); ?>
                    <?php endif; ?>
                </section>
                <aside id="secondary" class="widget-area u-grid u-flex u-flex-col u-flex-gap-5">
                    <?php dynamic_sidebar( 'main-sidebar' ); ?>
                </aside>
            </section>
        <?php endwhile; else :  ?>
            <section class="post-common post-single u-flex u-flex-col u-flex-gap-5" >
                <?php echo _e('No posts found.', 'universal-theme'); ?>
            </section>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>
