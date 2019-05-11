<?php


# duration options
$duration = array( 
    array( 'text' =>  '30', 'value' => 30),
    array( 'text' =>  '60', 'value' => 60),
    array( 'text' =>  '90', 'value' => 90)
);

# cookie law admin page with settings
$cookie_law_page = new EF_Settings_Page('cookie-law', __('Cookie Law', 'ef'), __('Cookie Law', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'),'settings','fa-cookie', 4);
$cookie_law_page->addSection('cookie-banner', __('Cookie banner', 'ef'));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-enable', __('Enable', 'ef'), __('Activate cookie banner mode', 'ef'), 'checkbox', null, array('checkboxText' => __('Enable', 'ef')));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-title', __('Cookie banner title', 'ef'),__('Cookie banner title', 'ef'), 'text', __('Privacy Policy', 'ef'));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-text', __('Cookie banner text', 'ef'),__('Cookie banner text', 'ef'), 'textarea', __('Privacy Policy', 'ef'));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-background-color', __('Cookie banner background color', 'ef'),__('Cookie banner background color', 'ef'), 'color-picker', '#f9f9f9');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-title-color', __('Cookie banner title color', 'ef'),__('Cookie banner title color', 'ef'), 'color-picker', '#000');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-text-color', __('Cookie banner text color', 'ef'),__('Cookie banner text color', 'ef'), 'color-picker', '#000');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-button-background-color', __('Cookie banner button background color', 'ef'),__('Cookie banner button background color', 'ef'), 'color-picker', '#000');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-button-text-color', __('Cookie banner button text color', 'ef'),__('Cookie banner button text color', 'ef'), 'color-picker', '#fff');
$cookie_law_page->addField('cookie-banner', 'cookie-banner-private-policy-page', __('Cookie banner private policy page', 'ef'), __('Cookie banner private policy page', 'ef'), 'selection', null, array( 'posts' => 'page'));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-duration', __('Duration', 'ef'),__('Duration', 'ef'), 'selection', '30', array('options' => $duration));
$cookie_law_page->addField('cookie-banner', 'cookie-banner-id', __('Cookie banner id', 'ef'),__('Cookie banner id', 'ef'), 'text', 'cookie-1');



# print cookie banner
function enfi_cookieconsent_print() {

    # check of cookie not set and module is enable
    if (checkConditions()) {

        ## get seo option (+child)
        if(is_child_theme()) {
            $child_theme = get_stylesheet();
            $option = get_option('cookie-law-'.$child_theme);
        } else {
            $option = get_option('cookie-law');
        }

        echo '<div class="enfi-cookieconsent">';
        
            echo '<div class="title">';
                echo '<h3>'.$option['cookie-banner-title'].'</h3>';
            echo '</div>';
            
            echo '<div class="content">';
                echo '<p>'.$option['cookie-banner-text'].'</p>';
                echo '</div>';
                
            echo '<div class="accept" id="enfi-cookieconsent-accept"><button>'.__('Accept', 'ef').'</button></div>';
        echo '</div>';
    }
}
add_action('wp_footer', 'enfi_cookieconsent_print');

# get css for cookie law banner
function enfi_cookieconsent_css_enqueue() {

    if(checkConditions()) {
        if(is_child_theme()) {
            $child_theme = get_stylesheet();
            $option = get_option('cookie-law-'.$child_theme);
        } else {
            $option = get_option('cookie-law');
        }

        wp_register_style('ef-cookieconsent', get_template_directory_uri().'/core/assets/modules/css/ef-cookie-law.css');
        wp_enqueue_style('ef-cookieconsent'); 

        ## set custom colors from backend 
        $titleColor =  $option['cookie-banner-title-color'];
        $textColor =  $option['cookie-banner-text-color'];
        $buttonTextColor =  $option['cookie-banner-button-text-color'];
        $buttonBackgroundColor =  $option['cookie-banner-button-background-color'];
        $bgColor =  $option['cookie-banner-background-color'];
        $custom_css = "
        \t.enfi-cookieconsent .title        {   color: {$titleColor}!important; }
        \t.enfi-cookieconsent .content      {   color: {$textColor}!important; }
        \t.enfi-cookieconsent               {   background-color: {$bgColor}!important; }
        \t.enfi-cookieconsent .accept       {   background: {$buttonBackgroundColor} !importantn; color: {$buttonTextColor}!important; }";
        
        wp_add_inline_style( 'ef-cookieconsent', "".$custom_css );
    }
}
add_action('wp_enqueue_scripts', 'enfi_cookieconsent_css_enqueue', 999);

# check if cookie not set and module is enable
function checkConditions() {

    if(is_child_theme()) {
        $child_theme = get_stylesheet();
        $option = get_option('cookie-law-'.$child_theme);
    } else {
        $option = get_option('cookie-law');
    }

    $enable = $option['cookie-banner-enable'];
    $cookie = $option['cookie-banner-id'];

    if(!is_admin() && !isset($_COOKIE[$cookie]) && http_response_code() != 503 && $enable)
        return true;
    else   
        return false;

}

# ajax callback, set cookie!
function enfi_cookieconsent_setcookie_callback() {

    ## get seo option (+child)
    if(is_child_theme()) {
        $child_theme = get_stylesheet();
        $option = get_option('cookie-law-'.$child_theme);
    } else {
        $option = get_option('cookie-law');
    }

    $id = $option['cookie-banner-id'];
    $hour = $option['cookie-banner-duration'];
    $calc = 3600 * $hour;
    setcookie($id , 1, time() + $calc, '/');

}
add_action( 'wp_ajax_nopriv_enfi_cookieconsent_setcookie', 'enfi_cookieconsent_setcookie_callback' );
add_action('wp_ajax_enfi_cookieconsent_setcookie', 'enfi_cookieconsent_setcookie_callback');

# get assets
function get_ajax_url(){
    if(checkConditions()) {
        wp_enqueue_script( 'enfi-cookieconsent', get_template_directory_uri(). '/core/assets/modules/js/ef-cookie-law.js', array('jquery'));
        wp_localize_script( 'enfi-cookieconsent', 'cookie_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
}
add_action('wp_enqueue_scripts', 'get_ajax_url');

?>