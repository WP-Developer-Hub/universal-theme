<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>
<section id="posts" class="u-grid u-grid-col-auto u-grid-gap-10">
    <!-- Your main content goes here -->
    <?php while (have_posts()) : the_post(); ?>
        <?php $post_id = get_the_ID(); ?>
        <article id="post-<?php echo $post_id; ?>" <?php post_class("post-common-bg post-item u-fc"); ?>>
            <?php if (get_theme_mod('universal_disable_media_on_lg', false)) : ?>
                <?php get_template_part('formats/format', get_post_format()); ?>
            <?php else : ?>
                <?php get_template_part('formats/format')?>
            <?php endif; ?>

            <section id="post-container-<?php echo $post_id; ?>" class="post-common post-container u-grid u-cf">
                <!-- Post title -->
                <?php echo universal_post_title('', !universal_is_displaying_media_gl());?>
                <span class="u-spacer-h u-spacer-light"></span>
                <?php if (!empty(get_the_excerpt())) : ?>
                    <?php if (!universal_is_displaying_media_gl()) : ?>
                        <!-- Post content -->
                        <?php if (universal_show_excerpt()) : ?>
                            <?php if (!empty(get_the_excerpt())) : ?>
                                <!-- Post content -->
                                <div id="post-content-<?php the_ID(); ?>" style="--u-line-clamp: 8" class="post-content-common post-content u-trim u-wrap-text">
                                    <?php the_excerpt();?>
                                </div>
                                <span class="u-spacer-h u-spacer-light"></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Post meta -->
                <div id="post-meta-<?php echo $post_id; ?>" class="post-meta-common post-meta u-block">
                    <span id="published-on-<?php echo $post_id; ?>" class="meta-row published-on u-block u-block-100"><span class="meta-label u-fw-ultra-thick"><?php _e('Posted:', 'universal-theme'); ?></span> <?php echo get_the_time('U'); ?></span>
                    <span id="posted-by-<?php echo $post_id; ?>" class="meta-row posted-by u-block u-block-100"><span class="meta-label u-fw-ultra-thick"><?php _e('By:', 'universal-theme'); ?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
                    <?php $category_count = count(wp_get_post_categories(get_the_ID()));?>
                    <span id="categories-<?php echo $post_id; ?>" class="meta-row categories u-block u-block-100"><span class="meta-label u-fw-ultra-thick"><?php echo _n('Category','Categories',$category_count,'universal-theme');?>:</span> <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"><?php the_category(', '); ?></a></span>
                    <?php if (!get_theme_mod('universal_disable_permalink', false)) : ?>
                        <?php if (comments_open()) : ?>
                            <span id="with-comments-<?php echo $post_id; ?>" class="with-comments meta-row u-block u-block-100"><span class="meta-label u-fw-ultra-thick"><?php _e('With:', 'universal-theme'); ?></span> <a href="<?php echo get_comments_link(); ?>"><?php comments_number( __('0 Comments', 'universal-theme'), __('1 Comments', 'universal-theme'), __('% Comments ', 'universal-theme') ); ?></a></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </section>
        </article>
    <?php endwhile; ?>
</section>
