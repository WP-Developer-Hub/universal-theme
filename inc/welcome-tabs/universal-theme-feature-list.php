<?php
/**
 * Theme Feature List
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */
if (!defined('ABSPATH')) {
    return;
}

// Define an array of supported features organized by category
$theme_features = array(
    'Features' => array(
        'admin-bar' => __('Admin Bar', 'universal-theme'),
        'automatic-feed-links' => __('Automatic Feed Links', 'universal-theme'),
        'custom-background' => __('Custom Background', 'universal-theme'),
        'custom-header' => __('Custom Header', 'universal-theme'),
        'custom-logo' => __('Custom Logo', 'universal-theme'),
        'html5' => __('HTML5 Support', 'universal-theme'),
        'post-thumbnails' => __('Post Thumbnails', 'universal-theme'),
        'title-tag' => __('Title Tag', 'universal-theme'),
        'widgets' => __('Widgets', 'universal-theme'),
        'align-wide' => __('Align Wide', 'universal-theme'),
        'block-templates' => __('Block Templates', 'universal-theme'),
        'block-template-parts' => __('Block Template Parts', 'universal-theme'),
        'core-block-patterns' => __('Core Block Patterns', 'universal-theme'),
        'disable-custom-colors' => __('Disable Custom Colors', 'universal-theme'),
        'disable-custom-font-sizes' => __('Disable Custom Font Sizes', 'universal-theme'),
        'disable-custom-gradients' => __('Disable Custom Gradients', 'universal-theme'),
        'disable-layout-styles' => __('Disable Layout Styles', 'universal-theme'),
        'editor-color-palette' => __('Editor Color Palette', 'universal-theme'),
        'editor-gradient-presets' => __('Editor Gradient Presets', 'universal-theme'),
        'editor-font-sizes' => __('Editor Font Sizes', 'universal-theme'),
        'editor-styles' => __('Editor Styles', 'universal-theme'),
        'responsive-embeds' => __('Responsive Embeds', 'universal-theme'),
        'wp-block-styles' => __('WP Block Styles', 'universal-theme'),
    ),
    // Add more categories and features as needed
);

// Output the list of supported and unsupported theme features
foreach ($theme_features as $category => $features) {
    echo '<table class="widefat">';
    echo '<thead><tr><th scope="col" class="manage-column column-name column-feature">' . esc_html__('Feature', 'universal-theme') . '</th><th scope="col" class="manage-column column-status">' . esc_html__('Status', 'universal-theme') . '</th><th class="manage-column column-blank"></th></tr></thead>';
    echo '<tbody class="u-scroll">';
    foreach ($features as $feature => $label) {
        echo '<tr>';
        echo '<th scope="row" class="theme-support' . esc_attr($feature) . '">' . esc_html($label) . '</th>';
        echo '<td scope="row" class="theme-support' . esc_attr($feature) . '-status" style="width: 100px;">';
        if (current_theme_supports($feature)) {
            echo '<span class="dashicons dashicons-yes supported"></span>';
        } else {
            echo '<span class="dashicons dashicons-marker unsupported"></span>';
        }
        echo '</td>';
        echo '<td scope="row" class="theme-blank"></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<hr>';
}

