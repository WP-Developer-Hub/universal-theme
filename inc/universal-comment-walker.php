<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
   return;
}

if (!class_exists('Universal_Comment_Walker')) {
    class Universal_Comment_Walker extends Walker_Comment {
            var $tree_type = 'comment';
            var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
     
            // constructor – wrapper for the comments list
            function __construct() { ?>

                <section class="comments-list">

            <?php }

            // start_lvl – wrapper for child comments list
            function start_lvl( &$output, $depth = 0, $args = array() ) {
                $GLOBALS['comment_depth'] = $depth + 2; ?>
                
                <section class="child-comments comments-list">

            <?php }
        
            // end_lvl – closing wrapper for child comments list
            function end_lvl( &$output, $depth = 0, $args = array() ) {
                $GLOBALS['comment_depth'] = $depth + 2; ?>

                </section>

            <?php }

            // start_el – HTML for comment template
            function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
                $depth++;
                $GLOBALS['comment_depth'] = $depth;
                $GLOBALS['comment'] = $comment;
                $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );
        
                if ( 'article' == $args['style'] ) {
                    $tag = 'article';
                    $add_below = 'comment';
                } else {
                    $tag = 'article';
                    $add_below = 'comment';
                } ?>

                <article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
                    <div class="comment-body" role="complementary">
                        <div class="comment-content u-flex u-flex-row" itemprop="text">
                        <figure class="comment-gravatar u-flex u-flex-col">
                            <a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author">
                                <?php echo get_avatar($comment, 65, '[default gravatar URL]', 'Author’s gravatar'); ?>
                            </a>
                        </figure>
                        <div class="comment-content-inner" itemprop="text">
                            <div class="comment-meta u-flex u-flex-row u-jc-sb" itemprop="text">
                                <span class="comment-author"><span><?php esc_html__('Posted by', 'universal-theme'); ?></span> <?php echo get_the_author(); ?></span>
                                <time class="comment-date" datetime="<?php comment_date('c') ?>" itemprop="datePublished">
                                    <?php
                                        $comment_timestamp = human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago';
                                        echo esc_html($comment_timestamp);
                                    ?>
                                </time>
                            </div>
                            <div class="comment-text u-wrap-text" itemprop="text">
                                <?php comment_text() ?>
                                <?php if ($comment->comment_approved == '0') : ?>
                                    <p class="comment-meta-item"><?php echo esc_html__('Your comment is awaiting moderation', 'universal-theme') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="comment-controls post-content u-flex u-flex-row u-jc-e" itemprop="text">
                        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        <?php
                            if (current_user_can('edit_post')) {
                                echo '| ';
                                edit_comment_link("Edit");
                                echo ' | <a href="' . esc_url(home_url()) . '/wp-admin/comment.php?action=cdc&c=' . $id . '">' . esc_html__('del', 'universal-theme') . '</a>';
                                echo ' | <a href="' . esc_url(home_url()) . '/wp-admin/comment.php?action=cdc&dt=spam&c=' . $id . '">' . esc_html__('spam', 'universal-theme') . '</a>';
                            }
                        ?>
                    </div>
                </div>
            <?php }

            // end_el – closing HTML for comment template
            function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

                </article>

            <?php }

            // destructor – closing wrapper for the comments list
            function __destruct() { ?>

                </section>
            
            <?php }

        }
}




