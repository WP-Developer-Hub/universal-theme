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
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main id="wrapper">
    <header id="header" class="u-flex u-flex-row u-ai-c u-cf" title="Header">
        <div id="site-branding" class="u-flex u-flex-row u-flex-wrap u-cf">
            <?php universal_theme_custom_logo(); ?>
        </div>
        <nav id="site-navigation" class="u-flex u-flex-wrap u-cf" title="Main Manu">
            <?php
            wp_nav_menu(array(
                'container' => false,
                'fallback_cb'=> false,
                'sort_column' => 'menu_order',
                'theme_location' => 'primary-menu',
            ));
            ?>
        </nav>
    </header>
	<details id="mobile-navigation">
        <summary for="drop" id="main-toggle" class="menu-toggle u-jc-sb"><span class="menu-summary-name u-tt-all-uppercase"><?php echo esc_html('Menu', 'universal-theme')?></span>  <span class="dashicons dashicons-menu"></span> </summary>
        <?php
            wp_nav_menu(array(
                'container' => false,
                'fallback_cb'=> false,
                'sort_column' => 'menu_order',
                'theme_location' => 'primary-menu',
                'walker' => new universal_menu_walker_2_0(),
            ));
        ?>
    </details>
<?php //echo dimox_breadcrumbs(); ?>
