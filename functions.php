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

$theme_directory = get_template_directory();

// Hook the theme setup function to the 'after_setup_theme' action
function universal_theme_setup() {
    // Define an array of universal colors with names and corresponding colors
    $universal_colors = array(
        array(
            'name'  => __('Primary Color', 'universal-theme'),
            'slug'  => 'primary_color',
            'color' => get_theme_mod('bgcolor', '#d3d3d3'), // Use theme mod or default color
        ),
        array(
            'name'  => __('Accent Color', 'universal-theme'),
            'slug'  => 'accent_color',
            'color' => get_theme_mod('universal_accent_color', '#0073e6'), // Use theme mod or default color
        ),
        array(
            'name'  => __('Black', 'universal-theme'),
            'slug'  => 'black',
            'color' => '#000000',
        ),
        array(
            'name'  => __('White', 'universal-theme'),
            'slug'  => 'white',
            'color' => '#FFFFFF',
        ),
        array(
            'name'  => __('Off White', 'universal-theme'),
            'slug'  => 'off_white',
            'color' => '#F9F9F9', // Off-white color
        ),
        array(
            'name'  => __('Dark Gray', 'universal-theme'),
            'slug'  => 'dark_gray',
            'color' => '#212121', // 13% gray
        ),
        array(
            'name'  => __('60% Gray', 'universal-theme'),
            'slug'  => '60_gray',
            'color' => '#999999', // 60% gray
        ),
        array(
            'name'  => __('40% Gray', 'universal-theme'),
            'slug'  => '40_gray',
            'color' => '#666666', // 40% gray
        ),
        array(
            'name'  => __('20% Gray', 'universal-theme'),
            'slug'  => '20_gray',
            'color' => '#333333', // 20% gray
        )
    );

    // Add support for post thumbnails (featured images)
    add_theme_support('post-thumbnails');

    // Add support for title tag in the <head>
    add_theme_support('title-tag');

    // Add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // Add support for HTML5 markup
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));

    // Add support for custom logo
    add_theme_support('custom-logo', array('height' => 400, 'width' => 1000, 'flex-width' => true, 'flex-height' => true));

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'd3d3d3',
        'default-image' => '',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_theme_support('dark-editor-style');

    // Add support for editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('small', 'universal-theme'),
            'shortName' => __('S', 'universal-theme'),
            'size' => 18,
            'slug' => 'small'
        ),
        array(
            'name' => __('normal', 'universal-theme'),
            'shortName' => __('M', 'universal-theme'),
            'size' => 20,
            'slug' => 'normal'
        ),
        array(
            'name' => __('large', 'universal-theme'),
            'shortName' => __('L', 'universal-theme'),
            'size' => 22,
            'slug' => 'large'
        ),
        array(
            'name' => __('larger', 'universal-theme'),
            'shortName' => __('XL', 'universal-theme'),
            'size' => 24,
            'slug' => 'larger'
        )
    ));

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for align wide
    add_theme_support('align-wide');

    // Add support for custom line height
    add_theme_support('custom-line-height');

    // Add support for custom units
    add_theme_support('custom-units', array('rem', 'em', 'px', '%', 'fr', 'vw', 'vh',));

    // Add support for disabling custom colors, font sizes, gradients, and layout styles
    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-font-sizes');
    add_theme_support('disable-custom-gradients');
    add_theme_support('disable-layout-styles');
    remove_theme_support('core-block-patterns');

    // Add support for editor color palette and gradient presets
    add_theme_support('editor-color-palette', $universal_colors);
    add_theme_support('editor-gradient-presets');

    // Add support for custom spacing
    add_theme_support('custom-spacing');

    // Add support for appearance tools
    add_theme_support('appearance-tools');

    // Add support for link color
    add_theme_support('link-color', array(
        'color' => get_theme_mod('universal_accent_color', '#0073e6'),
        'hover_color' => get_theme_mod('universal_accent_color', '#0073e6'),
    ));

    // Add support for border
    add_theme_support('border', $universal_colors);

    // Add support for featured content
    add_theme_support('featured-content');

    // Add support for starter content
    add_theme_support('starter-content', array(
        'widgets' => array(
            'footer-widget-2' => array(
               array(
                   'pages' => array(
                       'title' => 'Pages',
                   ),
               ),
            ),
            'footer-widget-1' => array(
               array(
                   'categories' => array(
                       'title' => 'Categories',
                   ),
               ),
            ),
            'main-sidebar' => array(
                'search' => array('search', array('title' => '')),
                'tag_cloud' => array('tag_cloud', array('title' => 'Custom Tags')),
                'archives' => array('archives', array('title' => 'Custom Archives')),
            ),
           'pages' => array(
                'About',
                'Blog',
                'Contact',
           ),
        ),
    ));

    // Add support for widgets block editor and WP block styles
    add_theme_support('widgets-block-editor');
    add_theme_support('wp-block-styles');

    // Add support for post formats (optional)
    add_theme_support('post-formats', array('gallery', 'audio', 'video', 'link',));

    // Add support for customize selective refresh widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for admin bar
    add_theme_support('admin-bar');

    // Add editor style
    add_editor_style('css/normalize.css');
    add_editor_style('css/ufg.css');
    add_editor_style('css/ufc.css');
    add_editor_style('css/plugin.css');
    add_editor_style('css/responsive.css');
    add_editor_style('css/universal-player.css');

    // Example for register_block_style
    register_block_style(
        'your-custom-block-style', array(
            'name' => __('Your Custom Block Style', 'universal-theme'),
            'label' => __('Custom Block Style', 'universal-theme'),
            'style_handle' => 'your-custom-block-style-css',
        )
    );

    // Register a custom block pattern for the Simple Basic Contact Form plugin
    register_block_pattern(
        'simple-basic-contact-form',
        array(
            'title' => __('Simple Basic Contact Form', 'your-text-domain'),
            'description' => __('A block pattern with a single column for the Simple Basic Contact Form plugin shortcode. Requires the Simple Basic Contact Form plugin to be installed and activated.', 'universal-theme'),
            'content' => '<!-- wp:columns {"verticalAlignment":"center","isStackedOnMobile":false,"align":"full"} -->
                <div class="wp-block-columns alignfull are-vertically-aligned-center is-not-stacked-on-mobile"><!-- wp:column {"verticalAlignment":"center","width":"100%"} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:100%"><!-- wp:shortcode -->
                [simple_contact_form]
                <!-- /wp:shortcode --></div>
                <!-- /wp:column --></div>
                <!-- /wp:columns -->',
            'categories'  => array('contact'),
        )
    );

    // Add custom image size
    add_image_size('universal_small', 125, 125, true);
    add_image_size('universal_thumbnail', 300, 300, true);
    add_image_size('universal_single_thumbnail', 99999, 550);

    // Load theme text domain for translation
    load_theme_textdomain('universal-theme', get_template_directory() . '/languages');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'universal-theme'),
    ));
}
add_action('after_setup_theme', 'universal_theme_setup');

function universal_theme_redirect() {
    if(isset($_GET['activated'])) {
        wp_safe_redirect(admin_url('themes.php?page=universa-theme'));
        exit;
    }
}
add_action('after_switch_theme', 'universal_theme_redirect');

// Includs Files
require_once $theme_directory . '/inc/universal-menu-walker.php';
require_once $theme_directory . '/inc/universal-welcome-page.php';
require_once $theme_directory . '/inc/universal-widget-areas.php';
require_once $theme_directory . '/inc/universal-script-handler.php';
require_once $theme_directory . '/inc/universal-comment-walker.php';
require_once $theme_directory . '/inc/universal-mods-functions.php';
require_once $theme_directory . '/inc/universal-menu-walker-2-0.php';
require_once $theme_directory . '/inc/universal-meta-box.php';
require_once $theme_directory . '/inc/universal-helpper-functions.php';
require_once $theme_directory . '/inc/universal-comments-settings.php';
require_once $theme_directory . '/inc/universal-customize-settings.php';

//Limit number of tags inside widget
function mekshq_tag_widget_limit($args){
    unset($args['smallest']);
    unset($args['largest']);
    $args['format'] = '10';
    $args['number'] = 10;
    return $args;
}
add_filter('widget_tag_cloud_args', 'mekshq_tag_widget_limit');

