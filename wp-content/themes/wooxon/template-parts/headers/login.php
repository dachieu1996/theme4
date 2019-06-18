<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
$class_login = is_user_logged_in() ? 'logged-in' : 'not-logged-in';
$login_form_args = array(
	'echo' => true,
	'form_id' => 'loginform',
	'label_username' => esc_html__( 'Username or email address ', 'wooxon' ),
	'label_password' => esc_html__( 'Password ', 'wooxon' ),
	'label_remember' => esc_html__( 'Remember Me', 'wooxon' ),
	'label_log_in' => esc_html__( 'LogIn Account', 'wooxon' ),
	'id_username' => 'user_login',
	'id_password' => 'user_pass',
	'id_remember' => 'rememberme',
	'id_submit' => 'wp-submit',
	'remember' => true,
	'value_username' => '',
	'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
);

$login_div_id = uniqid( 'piko-login-form-' );
$redister_div_id = uniqid( 'piko-register-form-' );

$logout_endpoint = get_option( 'woocommerce_logout_endpoint', '' );
$my_count_page = get_option( 'woocommerce_myaccount_page_id', 0 );
$my_account_url = get_current_user_id() != 0 ? get_edit_user_link( get_current_user_id() ) : wp_login_url();
$logout_url = wp_logout_url();
global $current_user;
$userName = $current_user->display_name;

if ( intval( $my_count_page ) > 0 && class_exists( 'WooCommerce' ) ) {
    $my_account_url = get_permalink( $my_count_page );
    if ( trim( $logout_endpoint ) != '' ) {
        $logout_url = rtrim( $my_account_url, '/' ) . '/' . $logout_endpoint;
    }
}
?>

<div id="piko-show-account" class="piko-show-account fullheight piko-dropdown t_c <?php echo esc_attr( $class_login ); ?>">
    <?php if ( is_user_logged_in() ): ?>
    
        <div class="piko-my-account">            
            <div class="t_c user-info mb30">
                <div class="pr">
                    <?php 
                    echo get_avatar( $current_user->ID, 80, null, null, array( 'class' => 'br50' ) );
                    echo '<span class="pa_center f_s12 c_w"> ' . esc_attr($userName) .'</span>';
                    ?>
                    
                </div>
            </div>
            <?php if ( class_exists( 'WooCommerce' ) ): ?>
                <ol class="link-external ul-no">
                    <li><a href="<?php echo esc_url( $my_account_url ); ?>"><?php esc_attr_e( 'My account', 'wooxon' ); ?></a></li>                    
                   <?php 
                   
                   if ( function_exists( 'wooxon_wishlist_number') ) { 
                        echo '<li>';
                        wooxon_wishlist_number();
                        echo '</li>';
                    }                  
                   
                   if ( function_exists( 'wooxon_compare_number') ) { 
                        echo '<li>';
                        wooxon_compare_number();
                        echo '</li>';
                        } ?>
                    <li><a href="<?php echo esc_url( $logout_url ); ?>"><?php esc_attr_e( 'Logout', 'wooxon' ); ?></a></li>
                </ol>                
            <?php endif; // End if ( !class_exists( 'WooCommerce' ) ): ?>
        </div><!-- /.piko-my-account -->
        
    <?php else: ?>
        
        <div class="piko-my-account">
            <div class="inner-my-acount">                
            <div id="<?php echo esc_attr( $login_div_id ); ?>" class="piko-login-form piko-my-account-form show slide">
                <span class="title"><?php esc_html_e( 'Login Form', 'wooxon' ); ?></span>
                <?php wooxon_custom_login( $login_form_args ); ?>
                
                    <p class="no-account mt30 mb10 f_s20 c_s2"><?php esc_html_e( 'Don\'t have account?', 'wooxon' ); ?></p>
                    <a href="#<?php echo esc_attr( $redister_div_id ); ?>" class="piko-togoleform button hover"><?php esc_attr_e( 'Register Now', 'wooxon' ); ?></a>
             </div><!-- /.piko-login-form -->
                <?php
                    $terms_page_id = wooxon_get_option_data( 'optn_terms_of_use_url', 0);
                    $terms_of_use_url =  get_page_link( $terms_page_id );
                ?>
                <div id="<?php echo esc_attr( $redister_div_id ); ?>" class="piko-register-form piko-my-account-form">
                    <span class="title"><?php esc_html_e( 'Register Form', 'wooxon' ); ?></span>
                    
                    <form name="registerform" class="register-form" method="POST" >
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="<?php esc_attr_e( 'Enter your username ', 'wooxon' ); ?>" />                           
                        </div>
                        <div class="form-group label-overlay">
                            <input type="text" class="form-control" id="email-register" name="email" placeholder="<?php esc_attr_e( 'Enter your email ', 'wooxon' ); ?>" />                           
                        </div>
                        <div class="form-group label-overlay">
                             <input type="password" class="form-control" id="password" name="password" placeholder="<?php esc_attr_e( 'Enter your password ', 'wooxon' ); ?>" />
                        </div>
                        <div class="form-group label-overlay">
                             <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="<?php esc_attr_e( 'Enter Confirm Password ', 'wooxon' ); ?>" />
                        </div>
                        <div class="remember c_s2 f_w5 mb10">
                            <label><input type="checkbox" name="agree" /> <?php esc_attr_e( 'I Agree To The ', 'wooxon' ); ?>
                                <?php if ( trim( $terms_of_use_url ) != '' ): ?>
                                    <a href="<?php echo esc_url( $terms_of_use_url ); ?>" target="_blank"><?php esc_attr_e( 'Terms Of Use ?', 'wooxon' ); ?></a>
                                <?php else: ?>
                                    <?php esc_attr_e( 'Terms Of Use? ', 'wooxon' ); ?>
                                <?php endif; ?>
                            </label>
                        </div>
                        
                        <?php wp_nonce_field( 'ajax-register-nonce', 'register-ajax-nonce' ); ?>
                        <button type="submit"><?php esc_attr_e( 'Register Account', 'wooxon' ); ?></button>
                        <span class="hr"></span>
                        <a href="#<?php echo esc_attr( $login_div_id ); ?>" class="piko-togoleform button hover"><?php esc_attr_e( 'Login Account', 'wooxon' ); ?></a>
                    </form><!-- /.register-form -->
                </div><!-- /piko-register-form -->
            </div><!-- /.inner-my-acount -->
        </div><!-- /.piko-my-account -->
        
    <?php endif; //is_user_logged_in ?>
</div>
