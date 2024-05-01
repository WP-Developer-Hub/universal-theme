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

        <?php $author_id = get_the_author_meta('ID'); $author_post_url = get_author_posts_url($author_id); $author_description = get_the_author_meta('description'); $author_link = get_author_posts_url($author_id); $post_formats = get_post_format(); global $post;?>
            <section id="post-container" class="u-grid u-grid-wsb">
                <section id="post-<?php the_ID(); ?>" <?php post_class("post-common post-common-bg post-single u-flex u-flex-col u-flex-gap-5"); ?>>
                    <?php echo get_template_part('formats/format', $post_formats); ?>

                    <!-- Post Title -->
                    <h3 id="single-post-title" class="post-title"><?php the_title();?></h3>

                    <span class="u-spacer-h u-spacer-light"></span>

                    <!-- Post Meta Information -->
                    <section id="single-post-meta" class="post-meta-common">
                        <span id="published-on" class="meta-row meta-separator"><span class="meta-label u-fw-ultra-thick"><?php _e('Posted:', 'universal-theme'); ?></span> <span class="all-caps"><?php echo get_the_time('U'); ?></span></span>
                        <span id="posted-by" class="meta-row meta-separator"><span class="meta-label u-fw-ultra-thick"><?php _e('By:', 'universal-theme'); ?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
                        <span id="categories" class="meta-row u-wrap-text-any <?php if (comments_open()) : ?> meta-separator<?php endif; ?>"><span class="meta-label u-fw-ultra-thick"><?php _e('Under:', 'universal-theme'); ?></span> <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"><?php the_category(', '); ?></a></span>
                        <?php if (comments_open()) : ?>
                            <span id="with-comments" class="meta-row "><span class="meta-label u-fw-ultra-thick"><?php _e('With:', 'universal-theme'); ?></span> <a href="<?php echo get_comments_link(); ?>"><?php comments_number('0 comments', '1 comment', '% comments'); ?></a></span>
                        <?php endif; ?>
                    </section>

                    <span class="u-spacer-h u-spacer-light"></span>

                    <?php if (!empty($post->post_content) || !empty($post->post_excerpt)) : ?>
                        <!-- Post Content -->
                        <section id="single-post-content" class="post-content-common u-reset u-wrap-text">
                            <?php the_content();?>
                        </section>

                        <?php if (strpos($post->post_content, '<!--nextpage-->') !== false) : ?>
                            <!-- Page Links -->
                            <h3 id="post-page-ink-title" class="u-fw-thick u-flex u-flex-row u-flex-gap-5 section-title">
                                <?php _e('Pages', 'universal-theme'); ?>
                            </h3>
                            <?php wp_link_pages(array(
                                'before' => '<nav id="post-nav-links" class="post-nav-links u-flex u-flex-row u-flex-wrap u-flex-gap-10 u-ai-c">',
                                'after' => '</nav>',
                                'nextpagelink' => '<span class="dashicons dashicons-arrow-left-alt2"></span>', // Use dashicons-arrow-left-alt2 for <
                                'previouspagelink' => '<span class="dashicons dashicons-arrow-right-alt2"></span>', // Use dashicons-arrow-right-alt2 for >,
                            )); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty(get_the_tags())) : ?>
                        <!-- Post Tags -->
                        <h3 id="post-tags-title" class="u-fw-thick u-flex u-flex-row u-flex-gap-5 section-title">
                            <?php _e('Tags', 'universal-theme'); ?>
                        </h3>
                        <?php the_tags('<div id="post-tags" class="u-flex u-flex-row u-flex-wrap u-fs-14 u-tt-all-caps">', ' ', '</div>'); ?>
                    <?php endif; ?>

                    <?php if (get_theme_mod('universal_show_author_box') && !empty($author_description)) : ?>
                        <!-- Author Box -->
                        <h3 id="post-author-box-title" class="u-fw-thick u-flex u-flex-row u-flex-gap-5 section-title">
                            <a href="<?php echo $author_link; ?>"><?php echo get_the_author(); ?>
                            </a>
                        </h3>
                        <section id="post-author-box" class="author-box u-flex u-flex-row u-ai-s">
                            <?php
                            // Get the author's bio
                            $author_bio = get_the_author_meta('description');

                            // Get the author's website link
                            $author_website = get_the_author_meta('user_url');
                            ?>

                            <!-- Get the authors profile picture -->
                            <?php echo universal_the_author_avatar(get_the_author_meta('ID'), 128); ?>

                            <div class="author-info">
                                <div class="author-bio"><?php echo $author_bio; ?></div>

                                <?php if (!empty($author_website) && !get_theme_mod('universal_hide_author_website', false)) : ?>
                                    <a class="website-link" href="<?php echo $author_website; ?>"><?php _e('Website', 'universal-theme'); ?></a>
                                <?php endif; ?>
                            </div>
                        </section>
                   <?php endif; ?>
                   <?php echo (get_theme_mod('universal_show_recent_posts', true) ? get_template_part('addons/addon-related-posts') : ''); ?>
                    <!-- Comments Section -->
                    <?php comments_template(); ?>
                </section>
                <?php get_sidebar(); ?>
            </section>
        <?php endwhile; else :  ?>
            <section class="post-common post-single u-flex u-flex-col u-flex-gap-5" >
                <?php echo _e('No posts found.', 'universal-theme'); ?>
            </section>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>
