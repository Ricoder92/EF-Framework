<?php

################################################################################################################################################## 
### cookie law
##################################################################################################################################################

# duration options
$duration = array( 
    array( 'text' =>  '30', 'value' => 30),
    array( 'text' =>  '60', 'value' => 60),
    array( 'text' =>  '90', 'value' => 90)
);

# cookie law admin page with settings
$cookie_law_page = new EF_Settings_Page('ef-cookie', __('COOKIE_CONSENT', 'ef'), __('COOKIE_CONSENT', 'ef'), __('COOKIE_CONSENT_DESCRIPTION', 'ef'),'settings','fa-cookie', 4);
$cookie_law_page->addSection('cookie-banner', __('COOKIE_CONSENT', 'ef'));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-enable', __('COOKIE_CONSENT_ENABLE', 'ef'), __('COOKIE_CONSENT_ENABLE_DESCRIPTION', 'ef'), 'checkbox', null, array('checkboxText' => __('ENABLE', 'ef')));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-disable-css', __('COOKIE_CONSENT_DISABLE_CSS', 'ef'), __('COOKIE_CONSENT_DISABLE_CSS_DESCRIPTION', 'ef'), 'checkbox', null, array('checkboxText' => __('COOKIE_CONSENT_DONT_LOAD_CSS', 'ef')));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-title', __('COOKIE_CONSENT_TITLE', 'ef'),__('COOKIE_CONSENT_TITLE_DESCRIPTION', 'ef'), 'text');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-text', __('COOKIE_CONSENT_TEXT', 'ef'),__('COOKIE_CONSENT_TEXT_DESCRIPTION', 'ef'), 'textarea');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-duration', __('COOKIE_CONSENT_DURATION', 'ef'),__('COOKIE_CONSENT_DURATION_DESCRIPTION', 'ef'), 'selection', '30', array('options' => $duration));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-id', __('COOKIE_CONSENT_ID', 'ef'),__('COOKIE_CONSENT_ID_DESCRIPTION', 'ef'), 'text', '1');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-css-class', __('COOKIE_CONSENT_CUSTOM_CSS_CLASS', 'ef'), null, 'text');

################################################################################################################################################## 
### print banner
##################################################################################################################################################

add_action('wp_footer', function() {

    # check of cookie not set and module is enable
    if (checkConditions()) {

        $option = ef_get_option('ef-cookie');

        echo '<div class="ef-cookieconsent-blur-bg"></div>';
        
        echo '<div class="ef-cookieconsent">';

            echo '<div class="container h-100">';

                echo '<div class="row align-items-center h-100">';
                    echo '<div class="offset-lg-3 col-lg-6">';
                        echo '<div class="content">';
                            echo '<div class="title"><h3>'.$option['cookie-banner-title'].'</h3></div>';
                            echo '<div class="text"><p>'.$option['cookie-banner-text'].'</p></div>';
                            echo '<div class="accept" id="ef-cookieconsent-accept"><button>'.__('Accept', 'ef').'</button></div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            echo '</div>';
        echo '</div>';
    }

});

################################################################################################################################################## 
### get css
##################################################################################################################################################

function enfi_cookieconsent_css_enqueue() {

    if(checkConditions()) {

        wp_register_style('ef-cookieconsent', get_template_directory_uri().'/core/assets/modules/css/ef-cookie-law.css');
        wp_enqueue_style('ef-cookieconsent'); 

    }
}
add_action('wp_enqueue_scripts', 'enfi_cookieconsent_css_enqueue', 999);

################################################################################################################################################## 
### check conditions
##################################################################################################################################################

function checkConditions() {

    $option = ef_get_option('ef-cookie');

    @$enable = $option['cookie-banner-enable'];
    @$cookie = $option['cookie-banner-id'];

    if(!is_admin() && !isset($_COOKIE[$cookie]) && http_response_code() != 503 && $enable)
        return true;
    else   
        return false;

}

################################################################################################################################################## 
### set ajax cookie
##################################################################################################################################################

function enfi_cookieconsent_setcookie_callback() {

    $option = ef_get_option('ef-cookie');

    $id = $option['cookie-banner-id'];
    $hour = $option['cookie-banner-duration'];
    $calc = 3600 * $hour;
    setcookie($id , 1, time() + $calc, '/');

}
add_action( 'wp_ajax_nopriv_enfi_cookieconsent_setcookie', 'enfi_cookieconsent_setcookie_callback' );
add_action('wp_ajax_enfi_cookieconsent_setcookie', 'enfi_cookieconsent_setcookie_callback');

################################################################################################################################################## 
### load js
##################################################################################################################################################

function get_ajax_url(){
    if(checkConditions()) {
        wp_enqueue_script( 'enfi-cookieconsent', get_template_directory_uri(). '/core/assets/modules/js/ef-cookie-law.js', array('jquery'));
        wp_localize_script( 'enfi-cookieconsent', 'cookie_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
}
add_action('wp_enqueue_scripts', 'get_ajax_url');

?>