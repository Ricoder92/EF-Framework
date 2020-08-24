<?php

################################################################################################################################################## 
### google API
##################################################################################################################################################

$google_fonts_default = array(
    1 => 'Poppins:400,500,600,700',
    2 => 'Open+Sans:400,700',
);

$google_analytics_page = new EF_Settings_Page('ef-google-api', __('GOOGLE_API', 'ef'), __('GOOGLE_API', 'ef'), __('GOOGLE_API_DESCRIPTION', 'ef'), 'settings', 'fa-chart-line', 7);

$google_analytics_page->addSection('google-analytics', __('GOOGLE_ANALYTICS', 'ef'));
    $google_analytics_page->addField('google-analytics', 'google-analytics-enable', __('GOOGLE_ANALYTICS_ENABLE', 'ef'), null, 'checkbox', null, array( 'checkboxText' => __('ENABLE', 'ef') ));
    $google_analytics_page->addField('google-analytics', 'google-analytics-code', __('GOOGLE_ANALYTICS_TRACKING_CODE', 'ef'), null, 'text', null);

$google_analytics_page->addSection('google-fonts', __('GOOGLE_FONTS', 'ef'));
    $google_analytics_page->addField('google-fonts', 'google-fonts', __('GOOGLE_FONTS', 'ef'), __('GOOGLE_FONTS_DESCRIPTION', 'ef'), 'list', $google_fonts_default);


$google_analytics_page->setDefaultValues();

################################################################################################################################################## 
### add google fonts
##################################################################################################################################################

add_action('wp_enqueue_scripts', function() {

    # google Font
    $option = ef_get_option('ef-google-api');
    $fonts = $option['google-fonts'];

    if($fonts) {
        $fonts_arr = implode($fonts, '|');
        wp_register_style('google-font-1', 'https://fonts.googleapis.com/css?family='.$fonts_arr.'&display=swap');
        wp_enqueue_style( 'google-font-1' );
    }
            
});

add_action('wp_head', function() {

    $option = ef_get_option('ef-google-api');
    @$tracking_enable = $option['google-analytics-enable'];
    @$tracking_code = $option['google-analytics-code'];

    if(isset($tracking_enable)) { ?>

    <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', '<?php echo $tracking_code; ?>', 'auto');
        ga('send', 'pageview');
        </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>

    <?php }

}, -1);





?>