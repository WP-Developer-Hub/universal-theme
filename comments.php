<?php
/**
 * The template for displaying comments.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
    if ( ! defined( 'ABSPATH' ) ) {
       return;
    }
?>

<?php
    /* If a post password is required or no comments are given and comments/pings are closed, return. */
    if ( post_password_required() || ( ! have_comments() && ! comments_open() && !pings_open() ) )
       return;
?>

<section id="comments-section" class="u-flex u-flex-col u-flex-gap-10">
    <?php if ( have_comments() ) : ?>
        <?php if (get_comments_number()) : ?>
            <h3 class="u-fw-thick u-flex u-flex-row u-flex-gap-5 section-title">
                <?php printf(_n('One Comment', '%s Comments', get_comments_number(), 'universal-theme'), number_format_i18n(get_comments_number())); ?>
            </h3>
        <?php endif; ?>

        <?php echo universal_comments_pagination(); ?>

        <?php if (get_comments_number()) : ?>
            <ol id="comment-lists" class="u-flex u-flex-col u-flex-gap-10">
                <?php
                wp_list_comments(array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 50,
                    'walker' => new Universal_Comment_Walker(),
                ));
                ?>
            </ol>
        <?php endif; ?>

        <?php echo universal_comments_pagination(); ?>

    <?php endif; ?>
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <span class="no-comments"> <?php _e('Comments are closed.', 'universal-theme'); ?></span>
    <?php else : ?>

        <?php
            $args = array(
                'title_reply_before' => '<span id="comment-form-title" class="comment-form-title u-fw-thick u-flex u-flex-row u-ai-c u-jc-c u-flex-gap-5 section-title">',
                'title_reply_after' => '</span>',
                'format' => 'html5'
            );

            comment_form($args);
        ?>
    <?php endif; ?>
</section>
