<?php
/**
 * Theme Modification Functions
 * Contains functions for modifying and enhancing theme features.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

/**
 * Modifies the title format for protected posts.
 *
 * @return string The modified title format with a lock icon appended.
 */
function universal_modfiy_protected_post_title() {
    return '%s <span class="dashicons dashicons-lock"></span>'; // Append a lock icon to the post title
}
add_filter('protected_title_format', 'universal_modfiy_protected_post_title', 10, 2);

/**
 * Modifies the width of image captions in shortcodes.
 *
 * @param int $width The original width.
 * @param array $atts Attributes of the shortcode.
 * @param string $content The shortcode content.
 * @return int The modified width set to 0.
 */
function universal_img_caption_shortcode_width($width, $atts, $content){
    return 0;
}
add_filter('img_caption_shortcode_width', 'universal_img_caption_shortcode_width', 10, 3);

/**
 * Modifies the main query on search pages to include only posts.
 *
 * @param object $query The WordPress query object.
 * @return object The modified WordPress query object.
 */
function universal_search_filter( $query ) {
    if ( $query->is_search ) {
        $query->set('post_type', array('post') ); // Set the post_type parameter to include only posts
    }
    return $query;
}
add_filter('pre_get_posts','universal_search_filter');

/**
 * Modifies the length of post excerpts.
 *
 * @param int $length The original excerpt length.
 * @return int The modified excerpt length set to 55 words.
 */
function universal_excerpt_length($length) {
    return universal_is_list_layout() ? 86 : 25;
}
add_filter('excerpt_length', 'universal_excerpt_length', 999999999);

/**
 * Replaces the excerpt "more" text by a link (Currently commented out).
 *
 * @param string $more The original excerpt "more" text.
 * @return string The modified excerpt "more" text.
 */
function universal_excerpt_more($more) {
   global $post;
   return '...';
}
add_filter('excerpt_more', 'universal_excerpt_more', 999999999);

/**
 * Limits the length of comments submitted by users.
 *
 * @param array $comment The comment data.
 * @return arrayThe modified comment data.
 */
function universal_limit_comment_length($comment) {
    $max_length = 280; // Maximum comment length

    if (strlen($comment['comment_content']) > $max_length) { // Check if comment length exceeds the maximum length
        // Display a warning message and prevent the comment from being submitted
        wp_die('<strong>Warning:</strong> Please keep your comment under ' . $max_length . ' characters.', 'Comment Length Warning', array('response' => 500, 'back_link' => true));
    }
    return $comment;
}
add_filter('preprocess_comment', 'universal_limit_comment_length');

/**
 * Modifies the titles of single term archives.
 *
 * @param string $title The original term title.
 * @return stringThe modified term title with the taxonomy name appended.
 */
function universal_single_term_title($title) {
    if (is_tax('post_format')) { // Check if the current term is a post format
        $modified_title = __('Post Format', 'universal-theme'); // Change the title to 'Post Format'
    } else {
        $taxonomy = get_queried_object()->taxonomy; // Get the current taxonomy
        $modified_title = ucfirst($taxonomy); // Capitalize the taxonomy name
    }
    return $modified_title . ': &quot;' . $title. '&quot;'; // Append the taxonomy name before the term title
}
add_filter('single_term_title', 'universal_single_term_title', 10, 1);

/**
 * Customize the date format for the entries displayed in the "Recent Posts" widget to show time ago.
 *
 * @param string $the_date The formatted date.
 * @param string $d The date format string.
 * @param object $post The post object.
 * @return string The modified formatted date showing time ago.
 */
function universal_convert_to_time_ago($orig_time) {
    global $post;
    $orig_time = strtotime($post->post_date);
    return human_time_diff($orig_time, current_time('timestamp')) . ' ' . __('ago', 'universal-theme');
}
add_filter('get_the_date', 'universal_convert_to_time_ago', 10, 1);
add_filter('the_date', 'universal_convert_to_time_ago', 10, 1);
add_filter('get_the_time', 'universal_convert_to_time_ago', 10, 1);
add_filter('the_time', 'universal_convert_to_time_ago', 10, 1);

/**
 * Modify the oEmbed result for TikTok URLs by removing inline styles from embedded content.
 *
 * @param string $data The oEmbed result data.
 * @param string $url The URL being embedded.
 * @param array $args Additional arguments passed to the oEmbed request.
 * @return string The modified oEmbed result data.
 */
function universal_modify_tiktok_oembed_result($data, $url, $args) {
    // Check if the URL being embedded contains 'tiktok.com'
    if (strpos($url, 'tiktok.com') !== false) {
        // Remove inline styles from the embedded content
        $data = preg_replace('/ style="[^"]*"/i', '', $data);
    }
    // Return the modified oEmbed result data
    return $data;
}
add_filter("oembed_result", "universal_modify_tiktok_oembed_result", 10, 3);

/**
 * Removes width and height attributes from HTML image tags.
 *
 * @param string $html The HTML content to modify.
 * @return string The modified HTML content without width and height attributes.
 */
function universal_remove_width_attribute($html) {
    // Use regular expression to remove width and height attributes from img tags
    if(!is_admin()) {
        $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
    }
    return $html;
}
add_filter('post_thumbnail_html', 'universal_remove_width_attribute', 10);
add_filter('image_send_to_editor', 'universal_remove_width_attribute', 10);
add_filter('wp_get_attachment_image', 'universal_remove_width_attribute', 10);


/**
 * Remove the 'type="text/css"' attribute from stylesheet link tags.
 *
 * @param string $tag The complete HTML tag for the stylesheet.
 * @param string $handle The name of the stylesheet.
 * @param string $src The URL of the stylesheet file.
 * @return string The modified HTML tag for the stylesheet.
 */
function universal_preload_css($tag, $handle, $src){
    return str_replace('type="text/css"', "", $tag);
}
add_filter('style_loader_tag', 'universal_preload_css', 10, 3);

/**
 * Remove the 'type="text/javascript"' attribute from script link tags.
 *
 * @param string $tag The complete HTML tag for the script.
 * @param string $handle The name of the script.
 * @param string $src The URL of the script file.
 * @return string The modified HTML tag for the script.
 */
function universal_preload_script($tag, $handle, $src){
    return str_replace('type="text/javascript"', "", $tag);
}
add_filter('script_loader_tag', 'universal_preload_script', 10, 3);

/**
 * Remove query strings from script and style URLs.
 *
 * @param string $src The URL of the script or style.
 * @return string The URL without query strings.
 */
function wpcode_snippet_remove_query_strings_split($src) {
    $output = preg_split( "/(&ver|\\?ver)/", $src ); // Split the URL by '&ver' or '?ver'

    return $output ? $output[0] : ''; // Return the URL without query strings
}
add_filter('script_loader_src', 'wpcode_snippet_remove_query_strings_split', 15);
add_filter('style_loader_src', 'wpcode_snippet_remove_query_strings_split', 15);

/**
 * Modify the HTML output of the post thumbnail.
 *
 * @param string $html             The post thumbnail HTML.
 * @param int    $post_id          The post ID.
 * @param int    $post_thumbnail_id The post thumbnail attachment ID.
 * @param string $size             The post thumbnail size.
 * @param array  $attr             The attributes for the post thumbnail.
 * @return string                  The modified post thumbnail HTML.
 */
function universal_modify_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    // Get the post title
    $post_title = get_the_title($post_id);

    // If alt attribute is empty, set it to the post title
    if (empty($attr['alt'])) {
        $attr['alt'] = $post_title;
    }

    // If title attribute is empty and alt is provided, set title to alt
    if (empty($attr['title']) && !empty($attr['alt'])) {
        $attr['title'] = $attr['alt'];
    } elseif (empty($attr['title'])) {
        $attr['title'] = $post_title;
    }

    return wp_get_attachment_image($post_thumbnail_id, $size, false, $attr);
}
add_filter('post_thumbnail_html', 'universal_modify_post_thumbnail_html', 10, 5);

/**
 * Modify the attributes of an attachment image.
 *
 * @param array $attr The attributes of the attachment image.
 * @return array      The modified attributes.
 */
function universal_modify_attachment_image_attributes($attr) {
    // Retrieve the post title associated with the attachment
    $post_title = get_the_title($attr['ID']);
    
    // Set alt attribute to post title if it's empty
    if (empty($attr['alt'])) {
        $attr['alt'] = $post_title;
    }

    // Set title attribute to post title if it's empty
    if (empty($attr['title'])) {
        $attr['title'] = $post_title;
    }

    // Return the modified attributes
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'universal_modify_attachment_image_attributes');

remove_filter('comment_text', 'make_clickable', 9);
?>
