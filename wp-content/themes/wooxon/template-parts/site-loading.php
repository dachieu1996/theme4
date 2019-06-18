<?php
/**
 * @author themepiko
 *
 */
$home_preloader = wooxon_get_option_data('home_preloader', 'various-4');

$home_preloader_bg_color = wooxon_get_option_data('home_preloader_bg_color', '');
$home_preloader_spinner_color = wooxon_get_option_data('home_preloader_spinner_color');

$custom_bg_color = $css_dispaly = '';
$enable_preloader = $css_dispaly = wooxon_get_option_data('optn_enable_loader',false);
if($css_dispaly == false){
    $css_dispaly = 'display:none;';
}
if ($home_preloader_bg_color && $home_preloader_bg_color['rgba'] !='') {
    $custom_bg_color = 'background-color:'. $home_preloader_bg_color['rgba'];
}

$custom_spinner_color = $custom_spinner_various7 = $custom_spinner_various8 = '';
if (!empty($home_preloader_spinner_color)) {
    $custom_spinner_color = 'style="background-color:'. esc_attr($home_preloader_spinner_color).';"';
    $custom_spinner_various7 = 'style="border-left-color:'. esc_attr($home_preloader_spinner_color).';border-right-color:'. esc_attr($home_preloader_spinner_color).'"';
    $custom_spinner_various8 = 'style="border-top-color:'. esc_attr($home_preloader_spinner_color).';border-left-color:'. esc_attr($home_preloader_spinner_color).'"';
}

if($enable_preloader == true && $home_preloader == 'slide'):

?>

<div id="site-loading-slide">
    <div class="proggress"></div>
</div>
<div class="site-mask"></div>

<?php
endif;
$class = ''; 
if($home_preloader == 'slide'){
    $home_preloader = 'various-4';
    $class = 'dn';
}

?>
<div id="site-loading" style="<?php echo wp_kses_post($css_dispaly.$custom_bg_color);?>" class="<?php echo esc_attr($class .' '.$home_preloader); ?>">
    <div class="loading-center">
        <div class="site-loading-center-absolute">            
            <?php if ($home_preloader == 'round-1') : ?>
                <div <?php echo  wp_kses_post($custom_spinner_color);?> class="spinner" id="spinner_one"></div>
                <div <?php echo wp_kses_post($custom_spinner_color);?> class="spinner" id="spinner_two"></div>
                <div <?php echo wp_kses_post($custom_spinner_color);?> class="spinner" id="spinner_three"></div>
            <?php endif; ?>           
            <?php if ($home_preloader == 'various-3') : ?>
                <div class="piko-spin4 pa_center" <?php echo wp_kses_post($custom_spinner_color);?>></div>
            <?php endif; ?>
            <?php if ($home_preloader == 'various-4') : ?>
                <div class="piko-spin5 pa_center">
                    <div class="bounce1" <?php echo wp_kses_post($custom_spinner_color);?>></div>
                    <div class="bounce2" <?php echo wp_kses_post($custom_spinner_color);?>></div>
                </div>
            <?php endif; ?>
            <?php if ($home_preloader == 'various-5') : ?>
                 <div class="piko-spin6 pa_center db"></div>
            <?php endif; ?>

            <?php if ($home_preloader == 'various-7') : ?>
                <div class="spinner" id="spinner_four" <?php echo wp_kses_post($custom_spinner_various7);?>></div>
                <div class="spinner" id="spinner_three" <?php echo wp_kses_post($custom_spinner_various7);?>></div>
                <div class="spinner" id="spinner_two" <?php echo wp_kses_post($custom_spinner_various7);?>></div>
                <div class="spinner" id="spinner_one" <?php echo wp_kses_post($custom_spinner_various7);?>></div>
            <?php endif; ?>

            <?php if ($home_preloader == 'various-8') : ?>
                <div class="spinner" id="spinner_four" <?php echo wp_kses_post($custom_spinner_various8);?>></div>
                <div class="spinner" id="spinner_three" <?php echo wp_kses_post($custom_spinner_various8);?>></div>
                <div class="spinner" id="spinner_two" <?php echo wp_kses_post($custom_spinner_various8);?>></div>
                <div class="spinner" id="spinner_one" <?php echo wp_kses_post($custom_spinner_various8);?>></div>
            <?php endif; ?>
        </div>
    </div>
</div>


