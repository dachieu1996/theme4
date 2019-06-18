<?php
$theme = wp_get_theme();
if ($theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $theme = wp_get_theme($template_dir);
    
}

?>
<div class="wrap about-wrap theme-wrap">
    <h1><?php esc_attr_e( 'Welcome to Wooxon!', 'pikoworks_core' ); ?></h1>
    <div class="about-text"><?php echo esc_html__( 'Wooxon is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'pikoworks_core' ); ?></div>
    <div class="theme-logo"><span class="theme-version"><?php esc_html_e( 'Version', 'pikoworks_core' ); ?> <?php echo $theme->get('Version'); ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=pikoworks' ), esc_html__( "Welcome", 'pikoworks_core' ) );
        printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Support", 'pikoworks_core' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=theme_options' ), esc_html__( "Theme Options", 'pikoworks_core' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=pikowroks_currency' ), esc_html__( "Currency Switcher", 'pikoworks_core' ) );
        
        ?>
    </h2>
    <div class="theme-section">
     <?php  echo pikoworks_core_get_remote_page(); ?>
    </div>    
   
    <div class="theme-thanks">
        <p class="description"><?php esc_html_e( 'Thank you, we hope you to enjoy using Wooxon!', 'pikoworks_core' ); ?></p>
    </div>
</div>