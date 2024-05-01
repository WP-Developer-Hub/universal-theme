<?php
/**
 * The template for displaying attachment content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
   return;
}

if ( wp_attachment_is_image() ):
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("post-common page-heading u-grid "); ?>>
    <h1 id="archive-title" class="u-tt-all-uppercase u-margin-none u-margin-buttom-10"><?php the_title(); ?></h1>
    <span class="u-spacer-h u-spacer-light"></span>
    <section id="post-grid-container" class="u-flex u-ai-c u-jc-c u-cf">
        <?php echo wp_get_attachment_image(get_the_ID(), 'full', true, array('class' => 'u-img'));?>
    </section>

    <section id="post-grid-container" class="u-grid u-cf">
        <?php if (!empty(wp_get_attachment_caption(get_the_ID()))) : ?>
            <span class="u-spacer-h u-spacer-light"></span>
            <!-- Post content -->
            <div id="post-grid-content" class="post-content-common u-wrap-text u-wrap-text-any">
                <?php
                    echo esc_html(wp_get_attachment_caption(get_the_ID()));
                ?>
            </div>
        <?php endif; ?>
        <span class="u-spacer-h u-spacer-light"></span>

        <!-- Post meta -->
        <div id="post-grid-meta" class="post-meta-common">
            <span id="published-on" class="meta-row meta-separator"><span class="meta-label u-fw-ultra-thick"><?php _e('Posted:', 'universal-theme'); ?></span> <?php echo get_the_time('U'); ?></span>
            <span id="posted-by" class="meta-row meta-separator"><span class="meta-label u-fw-ultra-thick"><?php _e('By:', 'universal-theme'); ?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
            <?php $category_count = count(wp_get_post_categories(get_the_ID())); ?>
            <?php if ($category_count > 0) : ?>
                <span id="categories" class="meta-row meta-separator">
                    <span class="meta-label u-fw-ultra-thick"><?php echo _n('Category','Categories',$category_count,'universal-theme');?>:</span>
                    <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"><?php the_category(', '); ?></a>
                </span>
            <?php endif; ?>
            <?php if (!get_theme_mod('universal_disable_permalink', false)) : ?>
                <?php if (comments_open()) : ?>
                    <span id="with-comments" class="meta-row"><span class="meta-label u-fw-ultra-thick"><?php _e('With:', 'universal-theme'); ?></span> <a href="<?php echo get_comments_link(); ?>"><?php comments_number( __('0 Comments', 'universal-theme'), __('1 Comments', 'universal-theme'), __('% Comments ', 'universal-theme') ); ?></a></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</article>
<?php else: echo universal_error_container('Sorry', 'No Archive Found.'); endif;?>
