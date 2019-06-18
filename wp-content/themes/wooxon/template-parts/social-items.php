<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="social-icons">
<?php if ( trim( $GLOBALS['wooxon']['twitter'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['twitter'] ); ?>">
        <i class="social-icon fa fa-twitter"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Twitter link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['facebook'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['facebook'] ); ?>">
        <i class="social-icon fa fa-facebook"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Facebook link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['googleplus'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['googleplus'] ); ?>">
        <i class="social-icon fa fa-google-plus"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Google Plus link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['dribbble'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['dribbble'] ); ?>">
        <i class="social-icon fa fa-dribbble"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Dribbble link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['behance'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['behance'] ); ?>">
        <i class="social-icon fa fa-behance"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Behance link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['tumblr'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['tumblr'] ); ?>">
        <i class="social-icon fa fa-tumblr"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Tumblr link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['instagram'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['instagram'] ); ?>">
        <i class="social-icon fa fa-instagram"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Instagram link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['pinterest'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['pinterest'] ); ?>">
        <i class="social-icon fa fa-pinterest"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Pinterest link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['youtube'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['youtube'] ); ?>">
        <i class="social-icon fa fa-youtube"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Youtube link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['vimeo'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['vimeo'] ); ?>">
        <i class="social-icon fa fa-vimeo"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Vimeo link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['linkedin'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['linkedin'] ); ?>">
        <i class="social-icon fa fa-linkedin"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'LinkedIn link', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['flickr'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['flickr'] ); ?>">
        <i class="social-icon fa fa-flickr"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Flickr feed', 'wooxon' ); ?></span>
    </a>
<?php endif; ?>
<?php if ( trim( $GLOBALS['wooxon']['soundcloud'] ) != '' ): ?>
    <a href="<?php echo esc_url( $GLOBALS['wooxon']['soundcloud'] ); ?>">
        <i class="social-icon fa fa-soundcloud"></i>
        <span class="screen-reader-text"><?php esc_html_e( 'Soundcloud', 'wooxon' ); ?></span>
    </a>  
<?php endif; ?>
</div>