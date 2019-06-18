<?php
/*
 * @author themepiko
 */
$prefix = 'wooxon_';

$footer_width = isset( $GLOBALS['wooxon']['footer_bottom_width'] ) ? $GLOBALS['wooxon']['footer_bottom_width'] : 'container';
$footer_style = isset( $GLOBALS['wooxon']['optn_footer_style'] ) ? $GLOBALS['wooxon']['optn_footer_style'] : 'style1';


$footer_right = isset( $GLOBALS['wooxon']['optn_footer_right'] ) ? $GLOBALS['wooxon']['optn_footer_right'] : '3';
$footer_copyright_text = isset( $GLOBALS['wooxon']['sub_footer_text'] ) ? $GLOBALS['wooxon']['sub_footer_text'] : sprintf( esc_html__( 'Proudly powered by %s', 'wooxon' ), 'WordPress' );

?>
<div class="f-bottom">
    <div class="<?php echo esc_attr($footer_width); ?>">
    <?php if($footer_style == 'style1'): ?>        
            <div class="site-info c_s2 t_c">
                <a class="site-title f_w5 c_s1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php echo do_shortcode( $footer_copyright_text); ?>
            </div><!-- .site-info -->        
        <?php else: ?>
            <div class="row main-footer align-items-center">            
                <div class="col-sm-12 col-md-6 order-md-2">                                       
                    <div class="info-right-wrap">
                   <?php if($footer_right == 1 || $footer_right == 4 ): ?>
                        <div class="social-icon">
                            <?php
                                foreach ($GLOBALS['wooxon']['footer_social'] as $key => $val){
                                   if(! empty($GLOBALS['wooxon'][$key]) && $val == 1 ){
                                       echo "<a target='_blank' href='" . esc_url($GLOBALS['wooxon'][$key]) ."'><i class='social-icon fa fa-" . esc_attr($key) . "'></i></a>";
                                   }
                               }
                            ?>
                        </div><!-- .social-icon -->
                     <?php endif;?>
                    <?php if($footer_right == 2 || $footer_right == 5):?>
                        <div class="payments-icon">
                            <ul>
                                <?php
                                $payment_photo_ids = explode( ',', $GLOBALS['wooxon']['optn_payment_logo_upload']);
                                foreach($payment_photo_ids as $payment_photo_id):                                           
                                ?>                                           
                                <li><img src="<?php echo wp_get_attachment_url( $payment_photo_id ); ?>" alt="<?php echo wp_get_attachment_caption($payment_photo_id) ?>"/></li>                                       
                                <?php endforeach; ?>                                      
                            </ul>
                        </div><!-- .payments-icon-->
                    <?php endif;?>

                    <?php if ( has_nav_menu( 'footer' ) && ($footer_right == 3 || $footer_right == 4 || $footer_right == 5) ) : ?>
                        <nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Links Menu', 'wooxon' ); ?>">
                                <?php
                                        wp_nav_menu( array(
                                                'theme_location' => 'footer',
                                                'menu_class'     => 'footer-links-menu',
                                                'depth'          => 1,

                                        ) );
                                ?>
                        </nav><!-- .footer-navigation -->                   
                    <?php endif; ?>
                    </div> <!--.info-right-wrap-->
                </div>
                <div class="col-sm-12 col-md-6 order-md-1">
                    <div class="site-info">
                        <a class="site-title f_w5 c_s1" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        <?php echo do_shortcode( $footer_copyright_text); ?>
                    </div><!-- .site-info -->
                </div>            
            </div><!-- .row -->
    <?php endif; //$footer_style ?>       
    </div>     
</div>