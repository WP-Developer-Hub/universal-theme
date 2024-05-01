<?php
/**
 * Theme Progress Tab
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */
if (!defined('ABSPATH')) {
    return;
}
$theme = wp_get_theme();
$theme_name = esc_html($theme->get('Name'));
$theme_author = esc_html($theme->get('Author'));
$theme_description = esc_html($theme->get('Description'));
?>

<div>
    <h4><?php echo esc_html__('GPL License', 'universal-theme'); ?></h4>
    <p>This theme is licensed under the GPL license. This means you can use it for anything you like as long as it remains GPL.</p>
</div>

<div>
    <h4><?php echo esc_html__('Credits', 'universal-theme'); ?></h4>
    <p><?php echo esc_html($theme_name); ?> was created by <?php echo esc_html($theme_author); ?> as <?php echo strtolower(esc_html(str_replace('.', '', $theme_description))); ?> to replace the current theme used for his music page and graphic design portfolio.</p>
    <p>
        <a href="https://www.instagram.com/DJABHipHop/" class="button button-secondary" target="_blank">Instagram</a>
        <a href="https://www.facebook.com/DJABHipHop_1/" class="button button-secondary" target="_blank">Facebook</a>
        <a href="https://www.youtube.com/user/DJABHipHop" class="button button-secondary" target="_blank">YouTube</a>
        <a href="https://twitter.com/DJABHipHop" class="button button-secondary" target="_blank">Twitter</a>
    </p>
</div>

<div>
    <h4><?php echo esc_html__('Liability', 'universal-theme'); ?></h4>
    <p><?php echo $theme_author; ?> shall not be held liable for any damages, including, but not limited to, the loss of data or profit, arising from the use of, or inability to use, this theme.</p>
</div>
<hr>
