<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>
<!-- Post Audio -->
<div id="post-item-thumbnail-<?php the_ID(); ?>" class="post-thumbnail u-cf">
    <?php echo universal_display_media($post->ID); ?>
</div>
