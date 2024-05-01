<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>
<?php if ( !is_search() ) : ?>
<section id="post-list-content" class="u-grid <?php echo universal_get_list_layout_classes(); ?>">
<?php endif; ?>
    <section id="posts" class="u-grid u-flex-gap-10">
        <!-- Your main content goes here -->
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class("post-common-bg post-item"); ?>>
                <section id="post-container-<?php the_ID(); ?>" class="post-common post-container u-flex u-flex-col u-flex-gap-20">
                    <?php if (universal_is_displaying_media_gl()) : ?>
                        <!-- Post title -->
                        <?php echo universal_post_title("post-format-title", false);?>
                        <span class="u-spacer-h-l u-spacer-light"></span>
                        <?php get_template_part('formats/format', get_post_format()); ?>
                    <?php else: ?>
                        <section id="post-content-wrapper-<?php the_ID(); ?>" class="post-content-wrapper u-grid u-grid-col-p u-grid-gap-10">
                        <?php get_template_part('formats/format')?>
                            <section class="u-flex u-flex-col u-flex-gap-5">
                                <!-- Post title -->
                                <?php echo universal_post_title();?>
                                <?php if (universal_show_excerpt()) : ?>
                                    <?php if (!empty(get_the_excerpt())) : ?>
                                        <!-- Post content -->
                                        <div id="post-content-<?php the_ID(); ?>" style="--u-line-clamp: 11" class="post-content-common post-content u-trim u-wrap-text">
                                            <?php the_excerpt();?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </section>
                        </section>
                    <?php endif; ?>
                    <span class="u-spacer-h-l u-spacer-light"></span>
                    <!-- Post meta -->
                    <div id="post-meta-<?php the_ID(); ?>" class="post-meta-common post-meta">
                        <span id="published-on-<?php the_ID(); ?>" class="meta-separator"><span class="meta-label u-fw-ultra-thick"><?php _e('Posted:', 'universal-theme'); ?></span> <?php echo get_the_time('U');?></span>
                        <span id="posted-by-<?php the_ID(); ?>" class="meta-separator posted-by"><span class="meta-label u-fw-ultra-thick"><?php _e('By:', 'universal-theme'); ?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author();?></a></span>
                        <?php $category_count = count(wp_get_post_categories(get_the_ID()));?>
                        <span id="categories-<?php the_ID(); ?>" class="meta-separator"><span class="meta-label u-fw-ultra-thick"><?php echo _n('Category','Categories',$category_count,'universal-theme');?>:</span> <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"><?php the_category(', '); ?></a></span>
                        <?php if (!get_theme_mod('universal_disable_permalink', false)) : ?>
                            <?php if (comments_open()) : ?>
                                <span id="with-comments-<?php the_ID(); ?>"><span class="meta-label u-fw-ultra-thick"><?php _e('With:', 'universal-theme'); ?></span> <a href="<?php echo get_comments_link(); ?>"><?php comments_number( __('0 Comments', 'universal-theme'), __('1 Comments', 'universal-theme'), __('% Comments ', 'universal-theme') ); ?></a></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </section>
            </article>
        <?php endwhile; ?>
    </section>
<?php if ( !is_search() ) : ?>
    <?php get_sidebar(); ?>
</section>
<?php endif; ?>
