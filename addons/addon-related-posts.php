<?php if ( ! defined( 'ABSPATH' ) ) {
    return;
} ?>

<?php
// Get post tags
$post_tags = wp_get_post_tags( get_the_ID() );

// Get post categories
$post_categories = wp_get_post_categories( get_the_ID() );

// Combine tag and category IDs
$related_ids = array_merge( $post_tags, $post_categories );

// If there are no related IDs, set output message
if ( empty( $related_ids ) ) {
} else {
    // Query arguments
    $args = array(
        'posts_per_page'   => 4,
        'orderby'          => 'rand',
        'tax_query'        => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $post_tags,
            ),
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $post_categories,
            ),
        ),
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'post__not_in'     => array( get_the_ID() ),
        'post_format'      => 'standard',
        'has_password'     => false,
    );

    // The Query
    $random_related_posts_query = new WP_Query( $args );

    // Check if there are any random related posts
    if ( $random_related_posts_query->have_posts() ) {
        ?>
        <h3 id="Related-post-box-title" class="u-fw-thick u-flex u-flex-row u-flex-gap-5 u-margin-top-30 section-title">Related Post</h3>
        <section id="related-posts" class="related-posts u-grid u-grid-col-auto u-grid-gap-10">
        <?php
        while ( $random_related_posts_query->have_posts() ) {
            $random_related_posts_query->the_post();
            // Check if the post is sticky
            $is_sticky = is_sticky();
            // Output each random related post with thumbnail and title
            ?>
            <article id="reoated-post-<?php echo get_the_ID(); ?>" class="related-post-bg post-item u-fc <?php echo $is_sticky ? 'sticky' : ''; ?>">
                <a href="<?php echo esc_url( get_permalink() ); ?>" id="reoated-post-container-<?php echo get_the_ID(); ?>" class="post-common post-container u-grid u-cf" >
                    <div id="related-post-item-thumbnail-<?php echo get_the_ID(); ?>" class="post-item-thumbnail">
                        <?php
                        if ( has_post_thumbnail() ) {
                            echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class' => 'post-thumbnail-missing post-common-bg'));

                        } else {
                            echo '<div class="post-common-bg post-thumbnail-missing">?</div>';
                        }
                        ?>
                    </div>
                    <span class="u-spacer-h u-spacer-light"></span>
                    <span class="post-title u-flex u-ai-c u-jc-c"><?php echo get_the_title(); ?></span>
                </a>
            </article>
            <?php
        }
        ?>
        </section>
        <?php
        // Restore original post data
        wp_reset_postdata();
    } else {
    }
}
?>
