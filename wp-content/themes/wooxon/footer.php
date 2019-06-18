<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>


                        </div><!-- .row -->
                        <?php do_action( 'wooxon_after_main_content' ); ?>
                    </div><!-- .site-content -->
                </div><!-- .site-inner -->           
            </div>

            <div id="mobile_menu_wrapper_overlay" class="push_overlay"></div>            
            <div id="mobile_menu_wrapper" class="dn_lg push-fixed push-menu">
                <button class="close-menu mfp-close"></button>
                <h3 class="f_s16 lh_1 mg0 c_w l_s2"><?php esc_html_e('MENU', 'wooxon'); ?></h3>
                <?php wooxon_get_mobile_main_menu(); ?>
            </div>

            <?php 
            wooxon_get_header_cart_canvas();            
            wooxon_footer_style();
            wooxon_newsletter_popup();
            ?>

        </div><!-- .site -->

    <?php wp_footer(); ?>
    </body>
</html>
