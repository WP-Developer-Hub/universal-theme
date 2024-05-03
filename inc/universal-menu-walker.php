<?php
/**
 * Custom Menu Walker Class
 * Defines a custom walker class for WordPress navigation menus.
 *
 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/
 *
 * @package Universal Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
   return;
}

class universal_menu_walker extends Walker_Nav_Menu {
    // Override the start_lvl method to modify sub-menu (ul) output
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $menu_item_id = 'sub-menu-' . $depth;
        if ( $depth === 0 ) {
            $output .= '<ul class="sub-menu" id="' . esc_attr( $menu_item_id ) . '" title="' . esc_attr( $menu_item_id ) . '" title="' . esc_attr( $menu_item_id ) . '">';
        } else {
            $output .= '<ul class="sub-menu sub-menu-' . $depth . '" id="' . esc_attr( $menu_item_id ) . '" title="' . esc_attr( $menu_item_id ) . '">';
        }
    }

    // Override the start_el method to modify menu item (li) output
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $menu_item_classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $menu_item_id = esc_attr( $item->ID );

        // Add default classes and ID
        $menu_item_classes[] = 'menu-item';
        $menu_item_classes[] = 'menu-item-' . $menu_item_id;

        // Check if the item has children and add toggle label if needed
        if ( in_array( 'menu-item-has-children', $item->classes ) ) {
            $menu_item_classes[] = 'menu-item-has-children';
            $output .= '<li id="menu-item-' . esc_attr( $menu_item_id ) . '" class="' . implode( ' ', $menu_item_classes ) . '">';
            $output .= '<span class="drop-header"><a href="' . esc_url( $item->url ) . '" title="' . esc_attr( $item->title ) . '">' . esc_html( $item->title ) . '</a><label for="drop-' . $menu_item_id . '" class="toggle ic_arrow_drop " title="toggle ' . esc_attr( $item->title ) . ' menu">+</label></span><input type="checkbox" id="drop-' . $menu_item_id . '" />';
        } else {
            $output .= '<li id="menu-item-' . esc_attr( $menu_item_id ) . '" class="' . implode( ' ', $menu_item_classes ) . '">';
            // Generate the anchor tag for the menu item
            $output .= '<a href="' . esc_url( $item->url ) . '" title="' . esc_attr( $item->title ) . '">' . esc_html( $item->title ) . '</a>';
        }
    }

    // Override the end_lvl method to modify sub-menu (ul) closing tag
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    // Override the end_el method to modify menu item (li) closing tag
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

