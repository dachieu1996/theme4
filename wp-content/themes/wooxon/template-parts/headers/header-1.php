<?php
/**
 * Template part for displaying header layout.
 * 
 * @author themepiko
 */
$prefix = 'wooxon_';
$menu_width =  get_post_meta(get_the_ID(), $prefix . 'manu_width',true);
if (!isset($menu_width) || $menu_width == '-1' || $menu_width == '') {
    $menu_width = wooxon_get_option_data('full_width_menu', 'container'); 
}
$topbar =  get_post_meta(get_the_ID(), $prefix . 'enable_top_bar',true);
if (!isset($topbar) || $topbar == '-1' || $topbar == 0) {
   $topbar = wooxon_get_option_data('enable_top_bar', false); 
}
$menu_category = wooxon_get_option_data('enable_main_menu_category', 0);
$header_info = wooxon_get_option_data('menu_custom_info', '');
?>
<div class="header-wrapper">
	<header id="header" class="site-header sticky-menu-header">
                <?php if($topbar){ wooxon_get_topbar(); } ?>
            <div class="header-main"> 
            <div class="columns <?php echo esc_attr($menu_width); ?>">
		                   
                    <div class="header-left">                        
                            <div class="row">
                                    <div class="col-12">                                       
                                     <?php wooxon_get_brand_logo(); ?>
                                    </div>
                                    
                                        <?php 
                                        if(!empty($header_info)){
                                            echo '<div class="pr site-logo">';
                                            wooxon_get_header_action_info();
                                            echo '</div>';
                                        }
                                        ?>                                    
                            </div>                        
                    </div>                   
                    <div class="header-right ">                        
                            <div id="header-search-form" class="dn" data-togole="hidden"><?php wooxon_get_template('search-form/search','form');?></div>
                            <div class="main-menu-wrap">
                                <?php if($menu_category == 1): ?>
                                <div id="main-menu-1" class="row">
                                    <div class="col-lg-3 col-xl-2">
                                         <?php wooxon_get_menu_category_wrap();?>
                                    </div>
                                    <div class="col-lg-6 col-xl-8">
                                        <?php wooxon_get_sticky_logo();?>
                                         <?php wooxon_get_main_menu();?>
                                    </div>
                                    <div class="col-lg-3 col-xl-2 header-actions">
                                        <?php wooxon_get_header_action();?>
                                    </div>
                                </div>                                
                                 <?php else: ?>
                                <div class="row">
                                    <div class="col-12 ">
                                        <div id="main-menu-2">								
                                            <?php wooxon_get_sticky_logo();?>
                                            <?php wooxon_get_main_menu();?>
                                            <div class="header-actions">
                                            <?php wooxon_get_header_action();?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
			
                    </div>
		</div>
                </div>
	</header>
</div>