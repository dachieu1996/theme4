<?php
/**
 * Template part for displaying header layout.
 * 
 * @author themepiko
 */
$prefix = 'wooxon_';
$menu_width =  get_post_meta(get_the_ID(), $prefix . 'manu_width',true);
if (!isset($menu_width) || $menu_width == '-1' || $menu_width == '') {
    $menu_width = isset( $GLOBALS['wooxon']['full_width_menu'] ) ? $GLOBALS['wooxon']['full_width_menu'] : 'container';
}
$topbar =  get_post_meta(get_the_ID(), $prefix . 'enable_top_bar',true);
if (!isset($topbar) || $topbar == '-1' || $topbar == 0) {
   $topbar = wooxon_get_option_data('enable_top_bar', false); 
}
?>
<div class="header-wrapper">
	<header id="header" class="site-header sticky-menu-header">
		 <?php if($topbar){ wooxon_get_topbar(); } ?>
		<div class="header-main">
                    <div class="<?php echo esc_attr($menu_width); ?>">			
			<div class="header-right columns">
                             <div id="header-search-form" class="dn" data-togole="hidden"><?php wooxon_get_template('search-form/search','form');?></div>
				<div class="main-menu-wrap">
					<div class="row">
						<div class="col-12">
							<div id="main-menu">
                                                            <div class="nav-left">
                                                                <div class="logo-left-width"></div>                                                                
                                                                <?php wooxon_get_main_menu();?>                                                                 
                                                            </div>
                                                                
                                                                <?php wooxon_get_brand_logo(); ?>
								<?php wooxon_get_sticky_logo();?>
                                                                
                                                            <div class="nav-right d_flex">
                                                                <div class="logo-right-width"></div>
                                                                <?php wooxon_get_secondary_menu();?>
                                                                <div class="header-actions">
								<?php wooxon_get_header_action();?>
                                                                </div>
                                                            </div>
							</div>
						</div>
					</div>
				</div>
			</div>
                    </div>
		</div>
	</header>
</div>