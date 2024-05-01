<?php
/**
 * Helper Functions
 * Contains reusable helper functions for the theme.
 *
 * @link https://developer.wordpress.org/themes/theme-basics/theme-functions/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

/**
 * Convert hexadecimal color code to RGBA format.
 *
 * @param string $color   The hexadecimal color code.
 * @param mixed  $opacity Optional opacity value (default: false).
 * @return string         The formatted RGBA color string.
 */
function universal_hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)'; // Default color if no color provided

    // Return default color if no color provided
    if(empty($color))
        return $default;

    // Sanitize $color by removing "#" if provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    // Check if color has 6 or 3 characters and extract individual RGB values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hexadecimal values to decimal
    $rgb =  array_map('hexdec', $hex);

    // Format color string based on opacity setting
    if($opacity){
        if($opacity== 1){
            $opacity = 1.0;
        }
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    // Return formatted color string
    return $output;
}

/**
 * Determine if a color is light or dark.
 *
 * @param string $color The color code.
 * @return string|false The color code for text color (black or white) or false if no color provided.
 */
function universal_is_light_color($color) {
    $default = 'rgb(0,0,0)'; // Default color if no color provided

    // Return false if no color provided
    if (empty($color))
        return false;

    // Sanitize $color by removing "#" if provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    // Check if color has 6 or 3 characters and extract individual RGB values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return false;
    }

    // Convert hexadecimal values to decimal
    $rgb = array_map('hexdec', $hex);

    // Calculate perceived brightness
    $brightness = ($rgb[0] * 299 + $rgb[1] * 587 + $rgb[2] * 114) / 1000;

    // Determine text color based on brightness
    return $brightness > 128 ? "#000000" : "#FFFFFF";
}

/**
 * Generate dynamic CSS variables based on theme customizer settings.
 *
 * @return string The generated CSS string.
 */
function universal_dynamic_css() {
    // Get background color, accent color, accent color text color, and sticky post border color from theme customizer
    $universal_accent_color = get_theme_mod('universal_accent_color', '#0073e6');
    $universal_accent_color_alt = universal_hex2rgba($universal_accent_color, 0.75);
    $universal_accent_color_text_color = universal_is_light_color($universal_accent_color);
    $universal_sticky_post_border_color = get_theme_mod('universal_sticky_post_border_color', '#e60000');

    // Generate dynamic CSS with root variables
    $css = ":root {
        --universal-accent-color: $universal_accent_color;
        --universal-accent-color-alt: $universal_accent_color_alt;
        --universal-accent-color-text-color: $universal_accent_color_text_color;
        --universal-stick-post-border-color: $universal_sticky_post_border_color;
    }";

    // Return generated CSS string
    return $css;
}

/**
 * Retrieve and display the excerpt of the current post.
 */
function universal_get_excerpt() {
    global $post;
    echo wp_trim_excerpt("",  $post->ID);
}

function universal_get_title_tagline() {
    // Get the theme modification for title and tagline visibility
    $visibility = get_theme_mod('universal_title_tagline_visibility', 'title_only');

    // Define default output for title and tagline
    $title = get_bloginfo('name');
    $tagline = get_bloginfo('description');

    // Define HTML start and end tags for the title and tagline
    $title_start_tag = '<h1 class="u-fs-50">';
    $tagline_start_tag = '<h1 class="u-fs-40">';
    $end_tag = '</h1>';

    // Initialize title and tagline output variables
    $tt_output = '';

    // Use a switch statement to adjust output based on visibility setting
    switch ($visibility) {
        case 'none':
            return $title_start_tag . $end_tag;
            break;
        case 'tagline_only':
            // Display tagline only
            return $tagline_start_tag . $tagline . $end_tag;
            break;
        default:
            // Display title only (default behavior)
            return$title_start_tag . $title . $end_tag;
            break;
    }

    // Return the combined HTML output
    return $tt_output;
}

/**
 * Display the custom logo of the theme.
 */
function universal_theme_custom_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

    if (has_custom_logo()) {
        echo '<a href="' . esc_url(home_url('/')) . '" rel="home" class="u-flex u-flex-row u-ai-c"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" title="' . get_bloginfo('name') . '">';
        echo universal_get_title_tagline() . '</a>';
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '">' . universal_get_title_tagline() . '</a>';
    }
}

/**
 * Display attached media for the given post based on post format (audio, video, images/gallery).
 *
 * @param int $post_id The ID of the post.
 * @return string      The HTML container for the media.
 */
function universal_display_media($post_id) {
    $attachment_ids = get_post_meta($post_id, 'universal_local_media_attachment_ids', true);
    $container = '';

    if (!empty($attachment_ids)) {
        // Get post format (if supported)
        $post_format = get_post_format($post_id);

        if ($post_format === 'gallery') {
            // Display a gallery of images
            $gallery_attr = array(
                'ids' => $attachment_ids,
                'type' => 'carousel',
                'columns' => is_single() ? '3' : '6',
                'link' => is_single() ? 'file' : 'attachment',
                'size' => is_single() ? 'medium' : 'universal-small',
            );

            $container .= gallery_shortcode($gallery_attr);
        } else {
            // Determine if tracklist should be displayed based on the count of attachment IDs
            $display_tracklist = (count(explode(',', $attachment_ids)) > 1);

            // Display playlist for audio or video post formats
            $playlist_attr = array(
                'ids' => $attachment_ids,
                'style' => 'dark',
                'images' => true,
                'artists' => true,
                'tracklist' => $display_tracklist,
                'tracknumbers' => false,
                'type' => ($post_format === 'audio') ? 'audio' : 'video',
            );

            $container .= wp_playlist_shortcode($playlist_attr);
        }

        if (is_single()) {
            $container .= '<span class="u-spacer-h u-spacer-light"></span>';
        }

    } else {
        $container = "No attachments found for this post.";
    }

    return $container;
}

/**
 * Generate pagination counter HTML for displaying the current page number and total page count.
 *
 * @param int $total_items The total number of items.
 * @return string          The HTML for pagination counter.
 */
function universal_pagination_counter($total_items) {
    $is_single_page = (is_single() || is_page());
    if($total_items > 1) {
       return '<span class="page-numbers dots page-count">' . (get_query_var($is_single_page ? 'cpage' : 'paged') ? get_query_var($is_single_page ? 'cpage' : 'paged') : 1) . '/' . $total_items . '</span>';
    }
}

/**
 * Generate pagination HTML for comments if the number of comments exceeds the number of pages.
 *
 * @return string The HTML pagination for comments.
 */
function universal_comments_pagination() {
    $comments_number = get_comments_number();
    $total_comments_pages = get_comment_pages_count();
    $pagination_html = '';

    if ($comments_number > $total_comments_pages ) {
        $pagination_html .= '<nav id="comments-pagination" class="pagination u-flex-row u-flex-gap-10">';
        $pagination_html .= universal_pagination_counter($total_comments_pages);
        $pagination_args = array(
            'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>', // Use dashicons-arrow-left-alt2 for <
            'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>', // Use dashicons-arrow-right-alt2 for >
            'echo' => false,
        );
        $pagination_html .= paginate_comments_links($pagination_args);
        $pagination_html .= '</nav>';
    }
    return $pagination_html;
}

/**
 * Generate pagination HTML for posts based on the current query.
 *
 * @return string The HTML pagination for posts.
 */
function universal_pagination() {
    // Get the number of posts per page from WordPress settings
    $max_posts_per_page = get_option('posts_per_page');

    // Retrieve the total number of pages based on the current query
    $paged_maxnum = $GLOBALS['wp_query']->max_num_pages;

    $pagination_html = '';

    // Check if there are more pages than the maximum posts per page and if there are pages to display
    if ($paged_maxnum > 0) {
        // Start the navigation container
        $pagination_html .= '<nav id="grid-pagination" class="pagination u-flex-row u-flex-gap-10">';
        
        // Generate pagination counter HTML
        $pagination_html .= universal_pagination_counter($paged_maxnum);
        
        // Set pagination arguments for previous and next links
        $pagination_args = array(
            'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>', // Use dashicons-arrow-left-alt2 for <
            'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>', // Use dashicons-arrow-right-alt2 for >
        );
        
        // Generate pagination links
        $pagination_html .= paginate_links($pagination_args);
        
        // End the navigation container
        $pagination_html .= '</nav>';
    }

    // Return the generated pagination HTML
    return $pagination_html;
}

/**
 * Generate HTML for the post title with optional classes and clickability.
 *
 * @param string $class     Additional CSS classes for the title.
 * @param bool   $clickable Whether the title should be clickable.
 * @return string           The HTML for the post title.
 */
function universal_post_title($class = "", $clickable = true) {
    if($clickable) {
        return '<span id="post-title-' . get_the_ID() .'" class="post-title ' . $class . '"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></span>';
    } else {
        return '<span id="post-title-' . get_the_ID() .'" class="post-title ' . $class . '">' . get_the_title() . '</span>';
    }
}

/**
 * Retrieve the layout style for the theme.
 *
 * @return string The layout style (e.g., 'grid' or 'list').
 */
function universal_get_layout() {
    // Return the layout item based on the current layout style
    return get_theme_mod('universal_layout_style', 'grid');
}

/**
 * Check if the theme layout style is set to list view.
 *
 * @return bool True if the layout style is set to list view, false otherwise.
 */
function universal_is_list_layout() {
    return (get_theme_mod('universal_layout_style', 'grid') === 'list');
}

/**
 * Get the CSS classes for the layout based on the theme settings.
 *
 * @return string The CSS classes for the layout.
 */
function universal_get_layout_classes() {
    return (get_theme_mod('universal_layout_style', 'grid') === 'list') ? 'u-grid' : 'u-grid  u-grid-gap-10';
}

/**
 * Get the CSS classes for the list layout based on the theme settings.
 *
 * @return string The CSS classes for the list layout.
 */
function universal_get_list_layout_classes() {
    return (get_theme_mod('universal_layout_style', 'grid') === 'list') ? 'u-grid-gap-10 u-grid-wsb' . (!is_home() || !is_front_page() ? ' u-margin-top-10' : '') : 'u-grid-gap-10';
}

/**
 * Check if the theme is displaying media in the gallery view.
 *
 * @return bool True if media display is enabled in the gallery view on large screens, false otherwise.
 */
function universal_is_displaying_media_gl() {
    return (get_theme_mod('universal_disable_media_on_lg', false) && !get_post_format() == "");
}

/**
 * Check if the theme customizer setting 'universal_show_excerpt' is enabled to display post excerpts.
 *
 * This function retrieves the value of the 'universal_show_excerpt' setting from the theme customizer.
 * If the setting is enabled (true), post excerpts will be displayed based on the presence of an excerpt.
 *
 * @return bool True if the 'universal_show_excerpt' setting is enabled, indicating that post excerpts should be displayed.
 *              False if the setting is disabled or not defined, indicating that post excerpts should not be displayed.
 */
function universal_show_excerpt() {
    return (get_theme_mod('universal_show_excerpt', true));
}


/**
 * Get the icon classes corresponding to the post format.
 *
 * @param string $post_format The post format.
 * @return string The icon classes.
 */
function universal_get_post_format_icon_classes($post_format) {
    switch ($post_format) {
        case 'aside':
            return 'posticons dashicons dashicons-format-aside';
        case 'gallery':
            return 'posticons dashicons dashicons-format-gallery';
        case 'link':
            return 'posticons dashicons dashicons-format-links';
        case 'image':
            return 'posticons dashicons dashicons-format-image';
        case 'quote':
            return 'posticons dashicons dashicons-format-quote';
        case 'status':
            return 'posticons dashicons dashicons-format-status';
        case 'video':
            return 'posticons dashicons dashicons-format-video';
        case 'audio':
            return 'posticons dashicons dashicons-format-audio';
        case 'chat':
            return 'posticons dashicons dashicons-format-chat';
        default:
            return 'posticons dashicons dashicons-format-standard';
    }
}

/**
 * Generate the error container HTML with main and additional messages.
 *
 * @param string $mainMessage The main error message.
 * @param string $additionalMessage The additional error message (optional).
 * @return string The error container HTML.
 */
function universal_error_container($mainMessage, $additionalMessage) {
    $error_container = '';

    // Start building the error container
    if (!is_search() && universal_get_layout() !== grid) {
        $error_container .= '<header class="page-heading u-pos-sti u-margin-bottom-10">';
        $error_container .= get_search_form(['echo' => false]);
        $error_container .= '</header>';

    }
    $error_container .= '<article id="error-container" class="post-single post-common post-common-bg u-flex u-flex-col u-flex-gap-10 u-ai-c width-search-form">';
    // Add the main error message with proper escaping
    $error_container .= '<span id="error-message" class="u-error-message u-block u-masonry-row-gap-10">' . esc_html($mainMessage) . '</span>';
    
    // Add the additional message with proper escaping (if it's not empty)
    if (!empty($additionalMessage)) {
        $error_container .= '<span id="error-additional-message" class="u-additional-text u-block u-masonry-row-gap-10">' . wp_kses_post($additionalMessage) . '</span>';
    }

    // Close the error container
    $error_container .= '</article>';

    return $error_container;
}

/**
 * Get the HTML for the author avatar.
 *
 * @param int $user_id The user ID.
 * @param int $avatar_size The size of the avatar (optional, default is 128).
 * @return string The HTML for the author avatar.
 */
function universal_get_the_author_avatar($user_id, $avatar_size = 128) {
    $author_name = get_the_author_meta('display_name', $user_id);
    $avatar_url = esc_url(get_avatar_url($user_id, array('size' => $avatar_size)));
    $avatar_link = '<img src="' . $avatar_url . '" alt="' . esc_attr($author_name) . '" title="' . esc_attr($author_name) . '" aria-hidden="true" class="avatar-link avatar avatar-' . $avatar_size . ' wp-user-avatar wp-user-avatar-' . $avatar_size . ' alignnone photo" width="'. $avatar_size . '" height="'. $avatar_size . '">';
    return $avatar_link;
}

/**
 * Display the author avatar.
 *
 * @param int $user_id The user ID.
 * @param int $avatar_size The size of the avatar (optional, default is 128).
 * @return string The HTML for the author avatar.
 */
function universal_the_author_avatar($user_id, $avatar_size = 128) {
    $author_name = get_the_author_meta('display_name', $user_id);
    $avatar_url = esc_url(get_avatar_url($user_id, array('size' => $avatar_size)));
    $author_posts_url = esc_url(get_author_posts_url($user_id));
    
    // Check if the avatar link should be clickable
    $avatar_link = '<div class="author-avatar">';
    $avatar_link .= '<a href="' . $author_posts_url . '">';
    $avatar_link .= universal_get_the_author_avatar($user_id, $avatar_size);
    $avatar_link .= '</a>';
    $avatar_link .= '</div>';

    return $avatar_link;
}

/**
 * Get the post format for a media type attachment.
 *
 * @param int $attachment_id The attachment ID.
 * @return string|bool The post format or false if no specific format is matched.
 */
function universal_get_post_format_for_media_type($attachment_id) {
    // Get the MIME type of the media attachment
    $mime_type = get_post_mime_type($attachment_id);

    // Strip everything after the "/" character
    $mime_type = strtok($mime_type, '/');

    // Check the MIME type to determine the post format
    switch ($mime_type) {
        case 'image':
            return 'image'; // Example: If MIME type is image, set post format to 'image'
        case 'video':
            return 'video'; // Example: If MIME type is video, set post format to 'video'
        case 'audio':
            return 'audio'; // Example: If MIME type is audio, set post format to 'audio'
        default:
            return false; // Return false if no specific format is matched
    }
}

/**
 * Get the copyright information.
 *
 * @return string The copyright information.
 */
function universal_get_copyright_info() {
    // Get copyright layout
    $message = get_theme_mod('universal_copyright_layout', '[copyright_symbol] [site_name], [started_date][dash][current_date].');

    // Get the current date in the format YYYY
    $current_year = date('Y');

    // Get the started date if available
    $started_date = date('Y', strtotime(get_theme_mod('universal_footer_started_date', $current_year)));

    // Construct site name HTML
    $site_name = '<span class="u-tt-all-uppercase">';
    $site_name .= is_multisite() ? get_blog_details(get_current_blog_id())->blogname : get_bloginfo('name');
    $site_name .= '</span>';

    // Replace placeholders with dynamic content
    $message = str_replace('[copyright_symbol]', '&copy;', $message);
    $message = str_replace('[site_name]', $site_name, $message);
    $message = str_replace('[started_date]', $started_date, $message);

    // Check if started date is not the same as current year and replace placeholders accordingly
    if ($started_date == $current_year) {
        $message = str_replace(['[dash]', '[current_date]'], ['', ''], $message);
    } else {
        $message = str_replace(['[dash]', '[current_date]'], ['-', $current_year], $message);
    }
  return rtrim($message);
}

/**
 * Generate a CSS class string to indicate selection based on a passed string and the 'post_format' parameter.
 *
 * @param string|bool $passed_string The string to compare with the 'post_format' parameter. Defaults to false.
 */
function universal_search_filter_item_class($passed_string = false) {
    $post_format = (isset($_GET['post_format']) ? $_GET['post_format'] : 'all');

    if ($passed_string == $post_format) {
        echo ' u-link-button-selected';
    }
}

//function widget_content_wrap($content, $widget, $args) {
//    $instance = $widget->get_settings(); // Retrieve widget settings (instance)
//
//    // Check if $instance is an array and not empty
//    if (is_array($instance) && !empty($instance)) {
//        // Construct HTML content based on $instance data
//        $html_content = '<div class="widget_content">';
//        
//        // Loop through $instance data
//        foreach ($instance as $key => $value) {
//            // Append each setting to the HTML content
//            $html_content .= '<p>' . esc_html($key) . ': ' . esc_html($value) . '</p>';
//        }
//        
//        $html_content .= '</div>'; // Close the wrapper div
//
//        // Return the modified HTML content
//        return $html_content;
//    }
//
//    // Return original content if $instance is empty or not an array
//    return $content;
//}
//add_filter('widget_display_callback', 'widget_content_wrap', 11, 3);

// Hook into the 'widget_display_callback' filter
// It allows altering a Widget properties right before output in sidebar
add_filter('widget_display_callback', function($instance, $widget, $args){
    // This digs through arrays and objects all the way to non-iterative level
    array_walk_recursive($instance, function(&$value, $key){
        $key = esc_html('<div class="widget_content">');
        $key = $key;
        $key .= esc_html('</div>');
    });
    // Return the possible altered $instance array
    return $instance;
}, 11, 3);
?>
