<?php
/**
 * Theme Setup and Initialization
 * Sets up theme features and initializes theme configurations.
 *
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

function universal_custom_editor_color_palette() {
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Accent Color', 'universal-theme'),
            'slug'  => 'accent-color',
            'color' => get_theme_mod('accent_color', '#0073e6'),
        ),
    ));
}
add_action('after_setup_theme', 'universal_custom_editor_color_palette');


