<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>
<section id="posts" class="u-grid u-grid-col-auto u-grid-gap-10">
    <!-- Your main content goes here -->
    <?php while (have_posts()) : the_post(); $artist_genres = get_post_meta(get_the_ID(), 'artist_genres', true); $artist_skills = get_post_meta(get_the_ID(), 'artist_skills', true); ?>
        <article id="post-<?php echo $post_id; ?>" <?php post_class("post-common-bg post-item u-fc"); ?>>
            <?php get_template_part('formats/format')?>

            <section id="post-container-<?php echo $post_id; ?>" class="post-common post-container u-grid u-cf">
                <!-- Post title -->
                <?php echo universal_post_title('', !universal_is_displaying_media_gl());?>
                <span class="u-spacer-h u-spacer-light"></span>
                <?php if (!empty(get_the_excerpt())) : ?>
                    <!-- Post content -->
                    <div id="post-content-<?php echo $post_id; ?>" class="post-content-common post-content u-wrap-text u-trim-6 u-wrap-text-any">
                        <?php echo get_the_excerpt(); ?>
                    </div>
                    <span class="u-spacer-h u-spacer-light"></span>
                <?php endif; ?>

                <!-- Post meta -->
                <div id="post-meta-<?php echo $post_id; ?>" class="post-meta-common post-meta u-block">
                    <?php if (isset($artist_skills)) : ?>
                        <span id="published-on" class="meta-row meta-separator">
                            <span class="meta-label u-fw-ultra-thick"><?php _e('Skills:', 'universal-theme'); ?></span>
                            <span class="all-caps"><?php echo esc_html(implode(", ", $artist_skills)); ?></span>
                        </span>
                    <?php endif; ?>

                    <?php if (isset($artist_genres)) : ?>
                        <span id="skills" class="meta-row u-wrap-text-any <?php echo comments_open() ? 'meta-separator' : ''; ?>">
                            <span class="meta-label u-fw-ultra-thick"><?php _e('Genres:', 'universal-theme'); ?></span>
                            <?php echo esc_html(implode(", ", $artist_genres)); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </section>
        </article>
    <?php endwhile; ?>
</section>
