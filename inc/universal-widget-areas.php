<?php
/**
 * Widget Areas (Sidebars) Registration
 * Registers widget areas (sidebars) for the theme.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

class UniversalWidgetAreas{
    public function init_widget_areas() {
        // Add actions or filters related to sidebar handling here
        add_action('widgets_init', array($this, 'register_sidebars'));
    }

    public function register_sidebars() {
        // Register the main sidebar
        register_sidebar( array(
            'name' => __( 'Main Sidebar', 'universal-theme'),
            'id' => 'main-sidebar',
            'description' => __( 'Widgets in this area will be displayed in the main sidebar.', 'universal-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s" title="%2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ) );

        // Register the footer widget areas
        for ($i = 1; $i <= 3; $i++) {
            $footer_name = sprintf(__('Footer Widget %d', 'universal-theme'), $i);
            $footer_description = sprintf(__('Widgets in this area will be displayed in the %d footer widget area.', 'universal-theme'), $i);
            register_sidebar( array(
                'name' => $footer_name,
                'id' => 'footer-widget-' . $i,
                'description' => $footer_description,
                'before_widget' => '<section id="%1$s" class="widget %2$s" title="%2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ) );
        }
    }
}

// Instantiate the class
$universal_widget_area = new UniversalWidgetAreas();
$universal_widget_area  -> init_widget_areas();
