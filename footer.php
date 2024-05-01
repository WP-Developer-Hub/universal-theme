<?php
/**
* The template for displaying the footer.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package Universal Theme
*/
if ( ! defined( 'ABSPATH' ) ) {
   return;
}
?>

                <footer id="footer" class="u-grid">
                    <section id="footer-inner" class="u-flex u-flex-gap-20">
                        <div id="footer-widget-1" class="footer-widget u-col-3">
                            <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
                                <?php dynamic_sidebar( 'footer-widget-1' ); ?>
                            <?php endif; ?>
                        </div>
                        <span class="u-spacer-v u-spacer-dark"></span>
                        <div id="footer-widget-3" class="footer-widget u-col-3">
                            <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
                                <?php dynamic_sidebar( 'footer-widget-2' ); ?>
                            <?php endif; ?>
                        </div>
                        <span class="u-spacer-v u-spacer-dark"></span>
                        <div id="footer-widget-3" class="footer-widget u-col-3">
                            <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
                                <?php dynamic_sidebar( 'footer-widget-3' ); ?>
                            <?php endif; ?>
                        </div>
                    </section>
                    <span class="u-spacer-h u-spacer-dark"></span>
                    <span id="copyright">
                        <?php echo universal_get_copyright_info(); ?>
                    </span>
                </footer>
            <?php wp_footer(); ?>
        </main>
    </body>
</html>

