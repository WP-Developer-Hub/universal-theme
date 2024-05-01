<?php
/**
 * Theme Customizer Settings and Controls
 * Registers settings and controls for theme customization.
 *
 * @link https://developer.wordpress.org/themes/customize-api/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

function universal_customizer_settings($wp_customize) {
    // Accent Color Setting and Control
    $wp_customize->add_setting('universal_accent_color', array(
        'default' => '#0073e6',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'universal_accent_color', array(
        'label' => __('Accent Color', 'universal-theme'),
        'section' => 'colors',
        'mode' => 'full',
    )));

    // Sticky Post Border Color Setting and Control
    $wp_customize->add_setting('universal_sticky_post_border_color', array(
        'default' => '#e60000',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'universal_sticky_post_border_color', array(
        'label' => __('Sticky Post Border Color', 'universal-theme'),
        'description' => __('Using white or light colors without making the background color dark may affect accessibility.', 'universal-theme'),
        'section' => 'colors',
        'mode' => 'full',
    )));

    // Title & Tagline Visibility
    $wp_customize->add_setting('universal_title_tagline_visibility', array(
        'default' => "title_only",
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control('universal_title_tagline_visibility', array(
        'type' => 'select',
        'label' => __('Site Title & Tagline Visibility', 'universal-theme' ),
        'description' => __('Choose whether the site title and tagline should be displayed.', 'universal-theme'),
        'section' => 'title_tagline',
        'choices' => array(
            'none' => __('None', 'universal-theme'),
            'title_only' => __('Site Title Only', 'universal-theme'),
            'tagline_only' => __('Tagline Only', 'universal-theme'),
        ),
     ));

    // Theme Settings Panel
    $wp_customize->add_panel('universal_theme_settings_panel', array(
        'title' => __('Theme Settings', 'universal-theme'),
        'priority' => 30,
        'description' => __('This panel contains various settings for customizing the theme.', 'universal-theme'), // Added description
    ));

    // General Settings Section
    $wp_customize->add_section('universal_general_settings_section', array(
        'title' => __('General Settings', 'universal-theme'),
        'description' => __('This section contains general settings for the theme.', 'universal-theme'), // Added description
        'priority' => 30,
        'panel' => 'universal_theme_settings_panel',
    ));

    // Layout Style
    $wp_customize->add_setting('universal_layout_style', array(
        'default' => 'grid',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('universal_layout_style', array(
        'label' => __('Layout Style', 'universal-theme'),
        'section' => 'universal_general_settings_section',
        'type' => 'select',
        'choices' => array(
            'grid' => __('Grid', 'universal-theme'),
            'list' => __('List', 'universal-theme'),
        ),
    ));

    // Display Media Post Grid/List
    $wp_customize->add_setting('universal_disable_media_on_lg', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('universal_disable_media_on_lg', array(
        'label' => __('Display Media Post Grid/List', 'universal-theme'),
        'description' => __('Enable this option to display the media posts in the grid or list layout based on the selected format.', 'universal-theme'),
        'section' => 'universal_general_settings_section',
        'type' => 'checkbox',
    ));

    // Display Hide Post Grid/List
    $wp_customize->add_setting('universal_show_excerpt', array(
        'default' => true, // Show excerpts by default
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_key', // Use sanitize_key to ensure boolean value
    ));

    // Add control to toggle post excerpt visibility
    $wp_customize->add_control('universal_show_excerpt', array(
        'label' => __('Show Excerpt', 'universal-theme'),
        'description' => __('Enable this option to show post excerpts on archive pages.', 'universal-theme'),
        'section' => 'universal_general_settings_section', // Customize section where the control will appear
        'type' => 'checkbox',
    ));

    // Post Page Settings Section
    $wp_customize->add_section('universal_post_page_settings_section', array(
        'title' => __('Post Page Settings', 'universal-theme'),
        'priority' => 30,
        'panel' => 'universal_theme_settings_panel',
        'description' => __('This section contains settings related to single post pages.', 'universal-theme'), // Added description
    ));

    // Show Post Thumbnail
    $wp_customize->add_setting('universal_show_post_thumbnail', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('universal_show_post_thumbnail', array(
        'label' => __('Show Post Thumbnail', 'universal-theme'),
        'description'        => __('Enable this option to display the post thumbnail on single post pages.', 'universal-theme'),
        'section' => 'universal_post_page_settings_section',
        'type' => 'checkbox',
    ));

    // Show Author Box
    $wp_customize->add_setting('universal_show_author_box', array(
        'default' => true,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('universal_show_author_box', array(
        'label' => __('Show Author Box', 'universal-theme'),
        'description' => __('Enable this option to display the author box below single posts.', 'universal-theme'),
        'section' => 'universal_post_page_settings_section',
        'type' => 'checkbox',
    ));

    // Hide Website Field
    $wp_customize->add_setting('universal_hide_author_website', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('universal_hide_author_website', array(
        'label' => __('Hide Website Field', 'universal-theme'),
        'description' => __('Check this option to hide the website field in the author box. This is a quick fix for plugins that attach additional information to the author description.', 'universal-theme'),
        'section' => 'universal_post_page_settings_section',
        'type' => 'checkbox',
    ));

    // Show Recent Posts
    $wp_customize->add_setting('universal_show_recent_posts', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('universal_show_recent_posts', array(
        'label' => __('Show Recent Posts', 'universal-theme'),
        'description' => __('Enable this option to display recent posts on your site.', 'universal-theme'),
        'section' => 'universal_post_page_settings_section',
        'type' => 'checkbox',
    ));

    // 404 Error Page Settings Section
    $wp_customize->add_section('universal_404_settings_section', array(
        'title' => __('404 Error Settings', 'universal-theme'),
        'priority' => 30,
        'panel' => 'universal_theme_settings_panel',
        'description' => __('This section contains settings for customizing the 404 error page.', 'universal-theme'), // Added description
    ));

    // 404 Message
    $wp_customize->add_setting('universal_error_404_message', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('universal_error_404_message', array(
        'label' => __('404 Message', 'universal-theme'),
        'description' => __('Enter a custom message that will be displayed on the 404 error page.', 'universal-theme'),
        'section' => 'universal_404_settings_section',
        'type' => 'textarea',
    ));

    // Footer Settings Section
    $wp_customize->add_section('universal_footer_settings_section', array(
        'title' => __('Footer Settings', 'universal-theme'),
        'priority' => 30,
        'panel' => 'universal_theme_settings_panel',
        'description' => __('This section contains settings for customizing the footer.', 'universal-theme'),
    ));

    // Started Date
    $wp_customize->add_setting('universal_footer_started_date', array(
        'default' => date('Y-m-d'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('universal_footer_started_date', array(
        'label' => __('Started Date', 'universal-theme'),
        'description' => __('Select the date you started.', 'universal-theme'),
        'section' => 'universal_footer_settings_section',
        'type' => 'date',
    ));

    // Copyright Layout
    $wp_customize->add_setting('universal_copyright_layout', array(
        'default' => '[copyright_symbol] [site_name], [started_date][dash][current_date].',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('universal_copyright_layout', array(
        'label' => __('Copyright Message', 'universal-theme'),
        'description' => __('You can use placeholders like [site_name] [started_date], [current_date], [copyright_symbol], and [dash] to dynamically layout the copyright. P.S placeholders like [started_date], [current_date] will only show the year.', 'universal-theme'),
        'section' => 'universal_footer_settings_section', // Assuming this is the correct section
        'type' => 'textarea',
    ));

    function universal_slug_sanitize_checkbox( $input ){
        return ( isset( $input ) ? true : false );
    }
}
add_action('customize_register', 'universal_customizer_settings');
?>
