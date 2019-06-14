<?php

$settings_page = new EF_Settings_Page('settings', __('SETTINGS', 'ef'), __('SETTINGS', 'ef'), __('SETTINGS_DESCRIPTION', 'ef'), 'settings', null, 1);

$settings_page->addSection('disable_wp_stuff', __('GENEREL_WP_FUNCTIONS', 'ef'));
$settings_page->addField('disable_wp_stuff', 'disable-posts', __('GENEREL_SETTINGS_DISABLE_POSTS', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-comments', __('GENEREL_SETTINGS_DISABLE_COMMENTS', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-emoji', __('GENEREL_SETTINGS_DISABLE_EMOJI', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-rss', __('GENEREL_SETTINGS_DISABLE_RSS', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-oembed', __('GENEREL_SETTINGS_DISABLE_OEMBED', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-ping', __('GENEREL_SETTINGS_DISABLE_PING', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-rsd', __('GENEREL_SETTINGS_DISABLE_RSD', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-wlwmanifest', __('GENEREL_SETTINGS_DISABLE_WLWMANIFEST', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));
$settings_page->addField('disable_wp_stuff', 'disable-generator', __('GENEREL_SETTINGS_DISABLE_GENERATOR', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));

$settings_page->addSection('disable_ef_stuff', __('GENEREL_EF_FUNCTIONS', 'ef'));
$settings_page->addField('disable_ef_stuff', 'enable-dark-mode', __('GENEREL_SETTINGS_ENABLE_DARK_MODE', 'ef'), null, 'checkbox', null, array('checkboxText' => __('ENABLE', 'ef')));
$settings_page->addField('disable_ef_stuff', 'disable-admin-bar', __('GENEREL_SETTINGS_DISABLE_ADMIN_BAR', 'ef'), null, 'checkbox', null, array('checkboxText' => __('DISABLE', 'ef')));

?>