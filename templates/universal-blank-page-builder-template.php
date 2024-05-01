<?php
/**
 * Template Name: Universal Blank
 *
 * This template is used to display the content of a WordPress page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Universal Blank
 */

// Prevent direct access to this file
defined('ABSPATH') || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#212121">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <main id="content" class="site-content">
        <section id="container" class="u-flex">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_content(); ?>
                </article>
            <?php endwhile; else : ?>
                <?php echo universal_error_container('Sorry', 'No Page Found.') ?>
            <?php endif; ?>
        </section>
        <?php wp_footer(); ?>
    </body>
</html>
