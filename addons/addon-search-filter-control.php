<?php
/**
 * The template for displaying search filter controls.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if (!defined('ABSPATH')) {return;}
?>
<div class="u-margin-top-10 u-flex u-flex-row u-flex-wrap u-ai-c u-flex-gap-10 u-tt-all-uppercase">
    <!--<span class="u-fs-24 u-fw-thin"><?php _e( 'Refine Results By', 'universal-theme'); ?>:</span>-->
    <?php
    // Fetch available post formats
    $post_formats = get_theme_support('post-formats');

    if ($post_formats && is_array($post_formats[0])) { $all_link_url = remove_query_arg('post_format');?>
        <a href="<?php echo esc_url($all_link_url); ?>" class="u-flex u-link-button<?php echo universal_search_filter_item_class('all'); ?>">
            <?php _e('All', 'universal-theme'); ?>
        </a>

        <?php
        // Loop through each post format
        foreach ($post_formats[0] as $post_format) {
            // Format the post format name (e.g., 'aside' to 'Aside')
            $formatted_post_format = ucfirst($post_format);
            // Escape and prepare the post format slug for use in URLs
            $post_format_slug = esc_attr($post_format);
            $current_url = esc_url(add_query_arg($_GET));

            $post_format_query_arg = add_query_arg('post_format', $post_format_slug, $current_url);

            // Generate the post format URL
            $post_format_url = ('' != get_option('permalink_structure')) ? user_trailingslashit($post_format_query_arg, $current_url) : $post_format_query_arg;
            ?>
            <a href="<?php echo esc_url($post_format_url); ?>" class="u-flex u-link-button<?php echo universal_search_filter_item_class($post_format_slug); ?>">
                <?php echo $formatted_post_format; ?>
            </a>
        <?php
        }
    }
    ?>
</div>
