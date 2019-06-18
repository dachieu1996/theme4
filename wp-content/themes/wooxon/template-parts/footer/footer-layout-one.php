<?php
/*
 * @author themepiko
 */

?>
<footer id="colophon" class="site-footer layout1" role="contentinfo">      
    <div class="f-inner">
        <?php wooxon_footer_sidebar_three(); ?>
        <?php wooxon_footer_sidebar_two(); ?>
        <?php wooxon_footer_sidebar_one(); ?>
    </div>
    <?php get_template_part( 'template-parts/footer/footer', 'bottom' ); ?>
    <a class="scroll-top" href="#top" title="<?php esc_attr_e('Scroll top', 'wooxon'); ?>"><span class="icon-arrow-long-left up"></span></a>
</footer>