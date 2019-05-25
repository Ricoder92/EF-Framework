<?php

################################################################################################################################################## 
### google API
##################################################################################################################################################

$google_fonts_default = array(
    1 => 'Poppins:400,500,600,700',
    2 => 'Open+Sans:400,700',
);

$google_analytics_page = new EF_Settings_Page('google-api', __('Google API', 'ef'), __('Google API', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'settings', 'fa-chart-line', 7);

$google_analytics_page->addSection('google-analytics', __('Google Analytics', 'ef'));
    $google_analytics_page->addField('google-analytics', 'google-analtyics-enable', __('Enable Google Analytics', 'ef'), null, 'checkbox', null, array( 'checkboxText' => __('Enable', 'ef') ));
    $google_analytics_page->addField('google-analytics', 'google-analytics-code', __('Tracking Code', 'ef'), null, 'text', null);

$google_analytics_page->addSection('google-fonts', __('Google Analytics', 'ef'));
    $google_analytics_page->addField('google-fonts', 'google-fonts', __('Google Fonts', 'ef'), null, 'list', $google_fonts_default);


$google_analytics_page->setDefaultValues();

################################################################################################################################################## 
### add google fonts
##################################################################################################################################################

add_action('wp_enqueue_scripts', function() {

    # google Font
    $option = ef_get_option('google-api');
    $fonts = $option['google-fonts'];

    if($fonts) {
        $fonts_arr = implode($fonts, '|');
        wp_register_style('google-font-1', 'https://fonts.googleapis.com/css?family='.$fonts_arr);
        wp_enqueue_style( 'google-font-1' );
    }
            
})


?>