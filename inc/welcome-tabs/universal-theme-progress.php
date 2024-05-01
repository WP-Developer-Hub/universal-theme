<?php
/**
 * Them Progress Tab
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */
if (!defined('ABSPATH')) {
    return;
}

function percentage_to_text($percentage) {
    // Define text descriptions based on percentage ranges
    if ($percentage === 100) {
        return esc_html__('Perfect, A+.', 'universal-theme');
    } elseif ($percentage >= 90 && $percentage <= 99) {
        return esc_html__('Little To No Work Needed.', 'universal-theme');
    } elseif ($percentage >= 75 && $percentage <= 80) {
        return esc_html__('Not That Bad, Has Minor Bugs, But Still Useable.', 'universal-theme');
    } elseif ($percentage >= 50 & $percentage <= 65) {
        return esc_html__('Only ' . $percentage . '% Complete Fuck Me How Much More Do I Have Left To Fix!!!!', 'universal-theme');
    } elseif ($percentage < 50 && $percentage >= 1 ) {
        return esc_html__('Fuck Me!!!!', 'universal-theme');
    } elseif ($percentage === 0 || isset($percentage)) {
        return esc_html__('Unknown?', 'universal-theme');
    }
}
$progressItems = array(
    __('JS Code (Theme does not use JS Code for anything)', 'universal-theme') => 0,
    __('Accessibility Support', 'universal-theme') => 25,
    __('Css Order', 'universal-theme') => 25,
    __('Input Tag type="range") Style') => 25,
    __('Common Widget Styles', 'universal-theme') => 33.3,
    __('Secondary Widget Styles', 'universal-theme') => 33.3,
    __('Footer Widget Styles', 'universal-theme') => 33.3,
    __('HTML Form Elements, Inputs:not(type["Submit, Reset, Button]"), Controls, Range Slider CSS', 'universal-theme') => 50,
    __('Post Single Styles', 'universal-theme') => 65,
    __('Input Tag:not(type="checkbox, radio, range") Style') => 75,
    __('Responsive Design Styles', 'universal-theme') => 75,
    __('Calendar Widget Style', 'universal-theme') => 80,
    __('Site Navigation Styles', 'universal-theme') => 95,
    __('Stander Image SEO Support', 'universal-theme') => 95,
    __('HTML CODE', 'universal-theme') => 96,
    __('PHP CODE', 'universal-theme') => 98,
    __('HTML Label Tag Styles', 'universal-theme') => 98,
    __('HTML Textarea Tag Styles', 'universal-theme') => 98,
    __('HTML Progress Tag Styles', 'universal-theme') => 99,
    __('Search Widget Style') => 100,
    __('Tag Cloud Widget Style') => 100,
    __('Section & Widget Title Style') => 100,
    __('HTML Select Tag Styles For Single & Mulit Mode"', 'universal-theme') => 100,
    __('HTML Button Tag Styles For type="(Submit, Reset, Button)"', 'universal-theme') => 100,
    __('HTML Inputs Tag Styles For type="(Submit, Reset, Button)"', 'universal-theme') => 100,
    __('Footer Copyright Styles', 'universal-theme') => 100,
    __('WordPress Alignments', 'universal-theme') => 100,
    __('Footer Styles', 'universal-theme') => 100,
    __('Header Styles', 'universal-theme') => 100,
    __('Post Common Styles', 'universal-theme') => 100,
    __('Post Styles', 'universal-theme') => 100,
    __('Post Meta Common Styles', 'universal-theme') => 100,
    __('Post Single Tag Styles', 'universal-theme') => 100,
    __('Post Single Paging Styles', 'universal-theme') => 100,
    __('Author Box Styles', 'universal-theme') => 100,
    __('Related Post Section Styles', 'universal-theme') => 100,
    __('Comment Section Styles', 'universal-theme') => 100,
    __('Common Pagination Styles', 'universal-theme') => 100,
    __('CSS 2024 Support', 'universal-theme') => 100,
    __('HTML 2024 Support', 'universal-theme') => 100,
);
echo '<table class="widefat">';
echo '<thead><tr><th scope="col" class="manage-column column-name column-feature">' . esc_html__('Progress', 'universal-theme') . '</th><th scope="col" class="column-cb column-number"></th><th scope="col" class="manage-column column-name column-status">' . esc_html__('Complated', 'universal-theme') . '</th><th scope="col" class="manage-column column-name column-status">' . esc_html__('Amount Of Work', 'universal-theme') . '</th></tr></thead>';
echo '<tbody class="u-scroll">';
foreach ($progressItems as $label => $percentage) {
    echo '<tr>';
    echo '<th scope="row" class="theme-progress-' . esc_attr($label) . '">' . esc_html($label) . '</th>';
    echo '<td scope="row" class="theme-progress-' . esc_attr($label) . '-number column-cb">';
        echo esc_html($percentage) .'%';
    echo '</td>';
    echo '<td scope="row" class="theme-progress' . esc_attr($label) . '-complated">';
        echo '<progress class="widefat" value="' . esc_attr($percentage) . '" max="100">' . esc_html($percentage) .'%</progress>';
    echo '</td>';
    echo '<th scope="row" class="theme-progress-' . esc_attr($percentage) . '">' . percentage_to_text($percentage) . '</th>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>

