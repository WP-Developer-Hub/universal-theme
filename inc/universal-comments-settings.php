<?php
/**
 * Comments Settings and Configurations
 * Defines settings and configurations related to comments.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

/**
 * Customize the comment form default fields to include a cookies consent checkbox.
 *
 * @param array $fields Default comment form fields.
 * @return array Modified comment form fields.
 */
function universal_comment_form_default_fields($fields) {
    // Check if the option to show comments cookies opt-in is enabled
    if (get_option('show_comments_cookies_opt_in')) {
        // Add the cookies consent checkbox if not in the admin area
        if (!is_admin()) {
            $fields['cookies'] = '<p class="comment-form-cookies-consent"><label for="wp-comment-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="1">Save my info in this browser for the next time I comment.</label></p>';
        }
    }

    return $fields;
}
add_filter('comment_form_default_fields', 'universal_comment_form_default_fields');

/**
 * Save the checkbox value when a comment is posted.
 *
 * @param array $comment_data Comment data before insertion.
 * @return array Modified comment data.
 */
function save_universal_comment_cookies_consent($comment_data) {
    // Check if the cookies consent checkbox is not checked
    if (!isset($_POST['wp-comment-cookies-consent'])) {
        // Clear the comment author's IP address to prevent storage
        $comment_data['comment_author_IP'] = '';
    }
    return $comment_data;
}
add_filter('pre_comment_on_post', 'save_universal_comment_cookies_consent');

/**
 * Enqueue comment-reply script if necessary.
 */
function universal_comment_reply_js() {
    // Check if the current page is a singular post, comments are open, and threaded comments are enabled
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        // Enqueue the comment-reply script
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'universal_comment_reply_js' );

?>
