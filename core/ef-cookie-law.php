<?php

################################################################################################################################################## 
### cookie law
##################################################################################################################################################

# cookie law admin page with settings
$cookie_law_page = new EF_Settings_Page('ef-cookie', __('COOKIE_CONSENT', 'ef'), __('COOKIE_CONSENT', 'ef'), __('COOKIE_CONSENT_DESCRIPTION', 'ef'),'settings','fa-cookie', 4);
$cookie_law_page->addSection('cookie-banner', __('COOKIE_CONSENT', 'ef'));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-enable', __('COOKIE_CONSENT_ENABLE', 'ef'), __('COOKIE_CONSENT_ENABLE_DESCRIPTION', 'ef'), 'checkbox', null, array('checkboxText' => __('ENABLE', 'ef')));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-disable-default-stylesheet', __('COOKIE_CONSENT_DISABLE_DEFAULT_STYLESHEET', 'ef'), __('COOKIE_CONSENT_DISABLE_DEFAULT_STYLESHEET_DESC', 'ef'), 'checkbox', null, array('checkboxText' => __('ENABLE', 'ef')));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-title', __('COOKIE_CONSENT_TITLE', 'ef'),__('COOKIE_CONSENT_TITLE_DESCRIPTION', 'ef'), 'text');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-text', __('COOKIE_CONSENT_TEXT', 'ef'),__('COOKIE_CONSENT_TEXT_DESCRIPTION', 'ef'), 'html');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-accept-all-text', __('COOKIE_CONSENT_ACCEPT_ALL_TEXT', 'ef'),__('COOKIE_CONSENT_ACCEPT_ALL_TEXT_DESCRIPTION', 'ef'), 'text');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-accept-choosen-text', __('COOKIE_CONSENT_ALL_CHOOSEN_TEXT', 'ef'),__('COOKIE_CONSENT_ALL_CHOOSEN_TEXT_DESCRIPTION', 'ef'), 'text');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-duration', __('COOKIE_CONSENT_DURATION', 'ef'),__('COOKIE_CONSENT_DURATION_DESCRIPTION', 'ef'), 'text', '30');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-id', __('COOKIE_CONSENT_ID', 'ef'),__('COOKIE_CONSENT_ID_DESCRIPTION', 'ef'), 'text', '1');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-script-analytics', __('GOOGLE_ANALYTICS_TRACKING_CODE', 'ef'), null, 'html', null);
$cookie_law_page->setDefaultValues();

################################################################################################################################################## 
### print banner
##################################################################################################################################################

add_action('wp_footer', function() {

    # check of cookie not set and module is enable
    if (checkConditions()) {

        $option = ef_get_option('ef-cookie');

        echo '<div class="ef-cookie-consent">';

            echo '<div class="background"></div>';
            
            echo '<div class="box">';

                echo '<div class="content">';

                    echo '<div class="title"><h3>'.$option['cookie-banner-title'].'</h3></div>';
                    echo '<div class="text"><p>'.stripslashes($option['cookie-banner-text']).'</p></div>';
                    
                    echo '<div class="options">';
                        echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" id="necessary_cookies" value="1" disabled checked>';
                            echo '<label class="form-check-label" for="necessary_cookies">Notwendig</label>';
                        echo '</div>';

                    echo '<div class="form-check form-check-inline">';
                        echo '<input class="form-check-input" type="checkbox" id="analyse_cookies" value="1">';
                        echo '<label class="form-check-label" for="analyse_cookies">Statistik</label>';
                    echo '</div>';

                echo '</div>';

                echo '<button id="ef-cookieconsent-set-choosen" class="btn btn-reverse">'.__($option['cookie-banner-accept-choosen-text'], 'ef').'</button> <button id="ef-cookieconsent-set-all" class="btn btn-reverse">'.__($option['cookie-banner-accept-all-text'], 'ef').'</button></div>';
                        
            echo '</div>';

        echo '</div>';
    }

});

################################################################################################################################################## 
### get css
##################################################################################################################################################

function ef_cookie_law_css_enqueue() {

    if(checkConditions()) {

        $option = ef_get_option('ef-cookie');
        @$disable = $option['cookie-banner-disable-default-stylesheet'];

        if(!$disable) {
            wp_register_style('ef-cookie-law', get_template_directory_uri().'/assets/css/cookie-law.css');
            wp_enqueue_style('ef-cookie-law'); 
        }

        # cookie banner js
        wp_enqueue_script( 'ef-cookie-law', get_template_directory_uri(). '/assets/js/cookie-consent.min.js', array('jquery'));

        # prepare ajax stuff
        wp_localize_script( 'ef-cookie-law', 'cookie_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    }
}
add_action('wp_enqueue_scripts', 'ef_cookie_law_css_enqueue', 999);

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

function ef_cookie_law_setcookie_callback() {

    $set_analytics_cookie = $_POST['analyse_cookies'];

    $option = ef_get_option('ef-cookie');

    $id = $option['cookie-banner-id'];
    $days = $option['cookie-banner-duration'];
    $calc = 3600 * $days;


    $uid = uniqid (rand (),true);

    setcookie($id , $uid, time() + $calc, '/');

    if($set_analytics_cookie)
        setcookie($id."_analytics" , $uid, time() + $calc, '/');

}

add_action( 'wp_ajax_nopriv_ef_cookie_law_setcookie', 'ef_cookie_law_setcookie_callback' );
add_action('wp_ajax_ef_cookie_law_setcookie', 'ef_cookie_law_setcookie_callback');

################################################################################################################################################## 
### add analytics code to head
##################################################################################################################################################

add_action('wp_head', function() {

    $option = ef_get_option('ef-cookie');
    $script = $option['cookie-banner-script-analytics'];
    @$cookie = $option['cookie-banner-id'];

    ## if cookie consent is set 
    if(!checkConditions()) {

        ## if analytics is set
        if(!is_admin() && isset($_COOKIE[$cookie.'_analytics']) && http_response_code() != 503) {
            echo '<script>'.stripslashes($script).'</script>';
            
        ## if analytics is NOT set
        } 

    ## if cookie is not set, then prepare if analytics will be choosen. 
    } else {
        echo '<script>function prepared_analytics_code() {'.stripslashes($script).'}</script>';
    } 

}, 99);





