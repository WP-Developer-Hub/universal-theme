<?php 
/**
 * The template for displaying the search form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
} ?>

<form method="get" id="searchbar" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off" results="0">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'universal-theme' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'universal-theme' ) ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'universal-theme' ); ?>" autocomplete="off" results='0' <?php if ( is_search() || is_tag() ) : ?> onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" <?php endif; ?> />
        <?php if ( is_search()) : ?>
            <input type="submit" name="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'universal-theme' ); ?>" />
        <?php endif; ?>
    </label>
        <?php if ( is_search()) : ?>
            <?php get_template_part('addons/addon-search-filter-control'); ?>
        <?php endif; ?>
</form>
