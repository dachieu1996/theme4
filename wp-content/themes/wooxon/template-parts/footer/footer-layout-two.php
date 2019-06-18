<?php
/*
 * @author themepiko
 */

$footer_parallax = isset( $GLOBALS['wooxon']['footer_parallax'] ) ? $GLOBALS['wooxon']['footer_parallax'] : '';
 $parallax_class = 'layout2';
 if($footer_parallax == 1){
       $parallax_class = 'footer-parallax';
    }

?>

<footer id="colophon" class="site-footer <?php echo esc_attr($parallax_class); ?>" role="contentinfo">
    <div class="footer-perallx-wrap">
        <div class="f-inner">
            <?php wooxon_footer_sidebar_three(); ?>
            <?php wooxon_footer_sidebar_two(); ?>
            <?php wooxon_footer_sidebar_one(); ?>
        </div>
        <?php get_template_part( 'template-parts/footer/footer', 'bottom' ); ?>
    </div>
    <a class="scroll-top" href="#top" title="<?php esc_attr_e('Scroll top', 'wooxon'); ?>"><span class="icon-arrow-long-left up"></span></a>
</footer>