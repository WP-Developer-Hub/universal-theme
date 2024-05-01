<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>

<!-- Post thumbnail -->
<?php if (is_single()) : ?>
    <?php if (get_theme_mod('universal_show_post_thumbnail')) : ?>
        <?php if (has_post_thumbnail()) : ?>
            <div id="post-item-thumbnail-<?php the_ID(); ?>" class="post-item-thumbnail">
                <?php the_post_thumbnail("universal_single_thumbnail", ['class' => 'wp-post-image related-post-bg']); ?>
            </div>
            <span class="u-spacer-h u-spacer-light"></span>
        <?php endif; ?>
    <?php endif ?>
<?php else : ?>
    <div id="post-item-thumbnail-<?php the_ID(); ?>" class="post-item-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail("universal_thumbnail", ['class' => 'post-thumbnail-missing related-post-bg u-fit']); ?>
            <?php else : ?>
                <div class="post-thumbnail-missing u-grid u-ai-c u-jc-c related-post-bg">?</div>
            <?php endif; ?>
            <span class="<?php echo universal_get_post_format_icon_classes(get_post_format()); ?> <?php if (post_password_required(get_the_ID())) echo 'posticons dashicons dashicons-lock'; ?>"></span>
        </a>
    </div>
<?php endif ?>
