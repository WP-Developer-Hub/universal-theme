<?php
/**
 * Script and Style Handler
 * Registers and enqueues scripts and styles for the theme.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

class UniversalScriptHandler {
    public function __construct() {
        // Add an action to the wp_enqueue_scripts hook for handling scripts and styles
        add_action('wp_footer', array($this, 'enqueue_custom_footer_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_custom_scripts'));
        add_action('wp_print_footer_scripts', array($this, 'universal_mejs_add_container_class'));

    }

    public function enqueue_custom_scripts() {
        // Get the URI and directory path for the theme
        $theme_uri = get_stylesheet_directory_uri();
        $theme_directory = get_template_directory();

        if (!current_user_can('activate_plugins')) {
            wp_enqueue_style('dashicons');
        }
        // The new css normalize
        wp_enqueue_style('universal-normalize-style', $theme_uri . '/css/normalize.css');

        // Enqueue Universal Flex Grid stylesheet
        wp_enqueue_style('universal-flex-grid-style', $theme_uri . '/css/ufg.css');

        // Enqueue Universal Form Control stylesheet
        wp_enqueue_style('universal-form-control-style', $theme_uri . '/css/ufc.css');

        // Enqueue Universal theme stylesheet
        wp_enqueue_style('universal-theme-style', $theme_uri . '/style.css');
//        wp_enqueue_style('universal-theme-style', $theme_uri . '/style_new_temp.css');

        // Enqueue Universal plugin stylesheet
        wp_enqueue_style('universal-plugins-style', $theme_uri . '/css/plugins.css');

        // Enqueue Universal responsive stylesheet
//        wp_enqueue_style('universal-responsive-theme-style', $theme_uri . '/css/responsive.css');

        // Enqueue Google Fonts stylesheet for Space Mono
        wp_enqueue_style(
            'space-mono-font', // Handle
            'https://fonts.googleapis.com/css2?family=Space+Mono&display=swap', // URL
            array(), // Dependencies
            null // Version
        );
    }

    public function enqueue_custom_footer_scripts() {
        // Enqueue Universal player stylesheet
        wp_enqueue_style( 'universal-player', get_template_directory_uri() . '/css/universal-player.css', array(
            'wp-mediaelement',
        ), '1.0' );

        wp_enqueue_script('wp-admin');
        wp_enqueue_style('buttons');
        wp_enqueue_style('wp-admin-rtl');
    }

    public function universal_mejs_add_container_class() {
        if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
            return;
        }
        ?>
        <script>
        (function() {
            var settings = window._wpmejsSettings || {};
            settings.features = settings.features || mejs.MepDefaults.features;
            settings.features.push( 'exampleclass' );
            MediaElementPlayer.prototype.buildexampleclass = function( player ) {
                player.container.addClass( 'universal-mejs-container' );
            };
        })();
        </script>
        <?php
    }
}

// Instantiate the UniversalScriptHandler class to handle script and style enqueuing
$universal_script_handler = new UniversalScriptHandler();
