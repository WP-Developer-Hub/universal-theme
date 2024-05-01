<?php
/**
 * The template for displaying the header.
 *
 * This template is used to display the header of the website.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php echo universal_dynamic_css();?>
    </style>
    <meta name='theme-color' content='#212121' />
    <?php wp_head(); ?>
</head>
<?php wp_body_open(); ?>
<body <?php body_class(); ?>>
<main id="wrapper">
    <header id="header" class="u-flex u-flex-row" title="Header">
        <section id="header-inner" class="u-flex u-flex-row u-ai-c u-jc-sb">
            <div id="site-branding" class="u-flex u-flex-row u-flex-wrap">
                <?php universal_theme_custom_logo(); ?>
            </div>
            <nav id="site-navigation" class="u-flex u-flex-wrap" title="Main Manu">
                <label for="drop" id="main-toggle" class="toggle burger u-flex"><span class="dashicons dashicons-menu"></span><?php _e('Menu', 'universal-theme'); ?></label>
                <input type="checkbox" id="drop"  title="Toggle Main Menu"/>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => false,
                    'walker' => new universal_menu_walker(),
                ));
                ?>
            </nav>
        </section>
    </header>
<?php //echo dimox_breadcrumbs(); ?>
