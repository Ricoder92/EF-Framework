<?php

$google_fonts_default = array(
    1 => 'Poppins:400,500,600,700',
    2 => 'Open+Sans:400,700',
);

$google_analytics_page = new EF_Settings_Page('google-api', __('Google API', 'enfi'), __('Google API', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'enfi'), 'settings', 'fa-chart-line', 7);

$google_analytics_page->addSection('google-analytics', __('Google Analytics', 'enfi'));
$google_analytics_page->addField('google-analytics', 'google-analtyics-enable', __('Enable Google Analytics', 'enfi'), null, 'checkbox', null, array( 'checkboxText' => __('Enable', 'enfi') ));
$google_analytics_page->addField('google-analytics', 'google-analytics-code', __('Tracking Code', 'enfi'), null, 'text', null);

$google_analytics_page->addSection('google-fonts', __('Google Analytics', 'enfi'));
$google_analytics_page->addField('google-fonts', 'google-fonts', __('Google Fonts', 'enfi'), null, 'list', $google_fonts_default);


$google_analytics_page->setDefaultValues();


?>