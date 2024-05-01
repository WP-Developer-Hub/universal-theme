<?php
/**
 * Welcome Page Class
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Universal_Welcome_Page {
    public function __construct() {
        // Hook into the admin menu initialization
        add_action('admin_menu', array($this, 'universa_theme_add_welcome_page'));
        add_action('admin_enqueue_scripts', array($this, 'universa_theme_enqueue_welcome_page_styles'));
    }

    // Enqueue custom admin styles
    public function universa_theme_enqueue_welcome_page_styles($hook_suffix) {
        if ($hook_suffix === 'appearance_page_universa-theme') {
            wp_enqueue_style('welcome-page-styles', get_stylesheet_directory_uri() . '/css/welcome-page-styles.css');
        }
    }

    // Method to add the theme welcome page under the "Appearance" menu
    public function universa_theme_add_welcome_page() {
        add_theme_page(
            __('Universal Theme', 'universal-theme'),
            __('Universal Theme', 'universal-theme'),
            'manage_options',
            'universa-theme',
            array($this, 'universa_theme_render_welcome_page')
        );
    }

    // Method to add tab to the welcome page
    public function universa_theme_add_tab($title, $content_file) {
        // Get the path to the theme directory
        $theme_dir = get_stylesheet_directory();

        // Construct the full path to the content file within the theme directory
        $full_path = trailingslashit($theme_dir . '/inc/welcome-tabs') . $content_file;

        // Begin outputting the tab details
        echo '<div style="margin-top:25px; margin-bottom:25px;">';
        echo '<h1 style="text-align:left;font-size:18px;font-weight:bold;margin:0 0 5px;line-height:1em;">' . esc_html($title) . '</h1>';
        echo '<hr>';
        // Check if the specified content file exists
        if (file_exists($full_path)) {
            // Output the content of the file
            require_once $full_path;
        } else {
            // Output an error message if the file is not found
            echo '<p>Error: Content file not found!</p>';
        }
        echo '</div>';
    }

    // Method to render the custom welcome page content
    public function universa_theme_render_welcome_page() {
        $theme = wp_get_theme();
        $theme_name = esc_html($theme->get('Name'));
        $theme_version = esc_html($theme->get('Version'));
        $theme_author = esc_html($theme->get('Author'));
        $theme_description = esc_html($theme->get('Description'));

        ?>
        <div class="u-wrap wrap about-wrap">
            <h1><?php echo $theme_name . ' ' . $theme_version; ?></h1>
            <span class="about-text"><?php echo str_replace('.', '', $theme_description) . ' by ' . $theme_author; ?></span>
            <div style="padding-bottom:100px;">
            <?php
                $this->universa_theme_add_tab(__('Theme Progress', 'universal-theme'), 'universal-theme-progress.php');
                $this->universa_theme_add_tab(__('Theme Feature', 'universal-theme'), 'universal-theme-feature-list.php');
                $this->universa_theme_add_tab(__('About', 'universal-theme'), 'universal-theme-about.php');
                $this->universa_theme_add_tab(__('Post Thumbnail Instructions', 'universal-theme'), 'universal-post-thumbnail-instructions.php');
            ?>
            </div>
        </div>
        <?php
    }
}

// Instantiate the Universal_Welcome_Page class to initialize the theme welcome page
$universal_welcome_page = new Universal_Welcome_Page();
