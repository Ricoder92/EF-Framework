<?php

$google_analytics_page = new Enfi_Framework_Admin_Plugin_Page('google-api', __('Google Analytics', 'enfi'), __('Google Analytics', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'enfi'), 'settings', 'fa-chart-line', 7);

$google_analytics_page->addSection('google-analytics', __('Google Analytics', 'enfi'));
$google_analytics_page->addField('google-analytics', 'google-analtyics-enable', __('Enable Google Analytics', 'enfi'), null, 'checkbox', null, array( 'checkboxText' => __('Enable', 'enfi') ));
$google_analytics_page->addField('google-analytics', 'google-analytics-code', __('Tracking Code', 'enfi'), null, 'text', null);

$google_analytics_page->addSection('google-fonts', __('Google Analytics', 'enfi'));
$google_analytics_page->addField('google-fonts', 'google-fonts', __('Google Fonts', 'enfi'), null, 'list', null);


$google_analytics_page->setDefaultValues();


?>