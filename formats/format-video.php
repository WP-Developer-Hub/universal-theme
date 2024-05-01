<?php
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>
<!-- Post Video -->
<div id="post-item-thumbnail-<?php the_ID(); ?>" class="post-thumbnail u-cf">
    <?php echo universal_display_media(intval($post->ID));?>
</div>
