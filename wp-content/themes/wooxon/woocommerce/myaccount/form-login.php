<?php
/**
 * Login Form || edit lot
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$login_div_id = uniqid( 'piko-login-form-' );
$redister_div_id = uniqid( 'piko-register-form-' );

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="piko-my-account">
    <div class="inner-my-acount">
        
        <div id="<?php echo esc_attr( $login_div_id ); ?>" class="piko-login-form login-form piko-woo piko-my-account-form show slide">
            <span class="title"><?php esc_html_e( 'Login', 'woocommerce' ); ?></span>
            <form method="post" class="woocommerce-form woocommerce-form-login login">
    
    			<?php do_action( 'woocommerce_login_form_start' ); ?>
                
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-group">
                    <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text input form-control" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/>
		</div>
                
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login-password form-group">
                    <label for="password" class="lb-user-pw"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text input form-control" type="password" name="password" id="password" autocomplete="current-password"/>
    		</div>
                <?php do_action( 'woocommerce_login_form' ); ?>
                <div class="login-submit form-group"> 
                    <input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>" />
                    <input type="hidden" name="redirect_to" value="" />
    		</div>
                
                <div class="bottom-login">
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <div class="checkbox-remember">
                        <label class="lb-remember"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label>
                    </div>
                    <p class="lost_password">
                        <a class="lost-pass-link"  href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                    </p>                   
                </div>
    
    			<?php do_action( 'woocommerce_login_form_end' ); ?>
    
    		</form>
            
            <span class="hr"></span>
            <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ): ?>
                <a href="#<?php echo esc_attr( $redister_div_id ); ?>" class="piko-togoleform button hover w100 t_c"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a>
            <?php endif; // End if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) ?>
            
        </div><!-- /.piko-login-form  -->
        
        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ): ?>
            
            <div id="<?php echo esc_attr( $redister_div_id ); ?>" class="piko-register-form piko-woo piko-my-account-form">
                <span class="title"><?php esc_html_e( 'Register', 'woocommerce' ); ?></span>
                
                <form method="post" class="register">
        
        			<?php do_action( 'woocommerce_register_form_start' ); ?>
        
        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                        
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-group">
                            <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp; <span class="required">*</span></label>
        					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" autocomplete="username"  id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
						</div>
        
        			<?php endif; ?>
                    
                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-group">
                        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </div>
        
        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                        
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-group">
                            <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
        		</div>
        
        			<?php endif; ?>        
        			<?php do_action( 'woocommerce_register_form' ); ?>
        			<?php do_action( 'register_form' ); ?>
        
        			<p class="oocommerce-FormRow form-row">
        				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
        				<input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
        			</p>
                    
                    <span class="hr"></span>
                    <a href="#<?php echo esc_attr( $login_div_id ); ?>" class="piko-togoleform button w100 hover t_c"><?php esc_attr_e( 'Log in', 'woocommerce' ); ?></a>
        
        			<?php do_action( 'woocommerce_register_form_end' ); ?>
        
        		</form>
            </div><!-- /.piko-register-form -->
        
        <?php endif; // End if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) ?>
        
    </div><!-- /.inner-my-acount -->
</div><!-- /.piko-my-account -->

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
