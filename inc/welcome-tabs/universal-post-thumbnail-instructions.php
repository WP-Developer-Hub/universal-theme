<?php
/**
 * Post Thumbnail Instructions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Universal Theme
 */
if (!defined('ABSPATH')) {
    return;
}
?>
<div>
    <h3><?php echo esc_html__('To ensure your theme thumbnails look great, follow these guidelines', 'universal-theme'); ?></h3>
    <h4><?php echo esc_html__('Post Thumbnail Image', 'universal-theme'); ?></h4>
    <p>
        <ul>
            <li><strong><?php echo esc_html__('Recommended Size:', 'universal-theme'); ?></strong> 859px (width) x 550px (height)</li>
            <li><strong><?php echo esc_html__('Aspect Ratio:', 'universal-theme'); ?></strong> Approximately 1.56 (Width to Height)</li>
            <li><strong><?php echo esc_html__('Cropping:', 'universal-theme'); ?></strong> Maintain the aspect ratio to fit within the specified dimensions</li>
        </ul>
    </p>
</div>
<div>
    <h4><?php echo esc_html__('Additional Tips', 'universal-theme'); ?></h4>
    <p>
        <ul>
            <li><strong><?php echo esc_html__('Quality Considerations', 'universal-theme'); ?></strong> Use high-resolution images for clarity and sharpness</li>
            <li><strong><?php echo esc_html__('Mobile Optimization', 'universal-theme'); ?></strong> Test how the thumbnail appears on mobile devices for readability</li>
        </ul>
    </p>
</div>
<hr>
