<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>

<!-- Post oEmbed -->
<?php $universal_oembed_url = get_post_meta(get_the_ID(), 'universal_oembed_url', true); ?>
    <?php if ($universal_oembed_url) { ?>
        <div id="post-item-thumbnail-<?php the_ID(); ?>" class="post-item-thumbnail u-cf">
        <?php
        // Check if the value is retrieved successfully
        $oembed_response = wp_oembed_get($universal_oembed_url, array('discover' => true));

        if (trim($oembed_response) ) {
            echo $oembed_response;
        } else {
            echo esc_url(trim(preg_replace('/(\s|\r|\n|\t)+/', 'a', $universal_oembed_url)));
        }
        ?>
        </div>
        <?php if (is_single()) : ?>
            <span class="u-spacer-h u-spacer-light"></span>
        <?php endif; ?>
<?php } ?>
