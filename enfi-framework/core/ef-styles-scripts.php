<?php

################################################################################################################################################## 
### style and script stuff
##################################################################################################################################################

$styles_scripts = new EF_Settings_Page('ef-styles-scripts', __('Styles & Scripts', 'ef'), __('Styles & Scripts', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'layout', '', 6);
$styles_scripts->addContent('styles_scripts_render');

$styles_scripts->addSection('settings', __('Settings', 'ef'));
$styles_scripts->addField('settings', 'use-parent-style', __('Use parent CSS style', 'ef'), null, 'checkbox', true, array('checkboxText' => __('Enable', 'ef')));
$styles_scripts->addField('settings', 'use-parent-js', __('Use parent JS', 'ef'), null, 'checkbox', true, array('checkboxText' => __('Enable', 'ef')));

$styles_scripts->setDefaultValues();

function styles_scripts_render() {
 echo '<table class="ef-admin-table">';

    echo '<thead><tr>';
        echo '<th class="center" style="width:10%;">Frontend</th>';
        echo '<th class="center" style="width:10%;">Backend</th>';
        echo '<th class="left" style="width:20%;">Slug</th>';
        echo '<th class="left" style="width:40%;">URL</th>';
        echo '<th class="left" style="width:20%;">Dependend</th>';
    echo '</tr></thead>';

    echo '<tbody><tr  align="center">';
        echo '<td class="center"><input class="enfi-admin-input-checkbox"  type="checkbox"></th>';
        echo '<td class="center"><input class="enfi-admin-input-checkbox" type="checkbox"></th>';
        echo '<td class="left"><input class="enfi-admin-input-text" placeholder="'.__('Slug here').'"type="text"></th>';
        echo '<td class="left"><input class="enfi-admin-input-text" placeholder="'.__('URL here').'"type="text"></th>';
        echo '<td class="left"><input class="enfi-admin-input-text" placeholder="'.__('Dependenies here').'"type="text"></th>';
    echo '</tr><tbody>';

    echo '<tr  align="center">';
        echo '<td><input class="enfi-admin-input-checkbox"  type="checkbox"></th>';
        echo '<td><input class="enfi-admin-input-checkbox" type="checkbox"></th>';
        echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Slug here').'"type="text"></th>';
        echo '<td><input class="enfi-admin-input-text" placeholder="'.__('URL here').'"type="text"></th>';
        echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Dependenies here').'"type="text"></th>';
    echo '</tr>';    echo '<tr  align="center">';
    echo '<td><input class="enfi-admin-input-checkbox"  type="checkbox"></th>';
    echo '<td><input class="enfi-admin-input-checkbox" type="checkbox"></th>';
    echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Slug here').'"type="text"></th>';
    echo '<td><input class="enfi-admin-input-text" placeholder="'.__('URL here').'"type="text"></th>';
    echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Dependenies here').'"type="text"></th>';
echo '</tr>';    echo '<tr  align="center">';
echo '<td><input class="enfi-admin-input-checkbox"  type="checkbox"></th>';
echo '<td><input class="enfi-admin-input-checkbox" type="checkbox"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Slug here').'"type="text"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('URL here').'"type="text"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Dependenies here').'"type="text"></th>';
echo '</tr>';    echo '<tr  align="center">';
echo '<td><input class="enfi-admin-input-checkbox"  type="checkbox"></th>';
echo '<td><input class="enfi-admin-input-checkbox" type="checkbox"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Slug here').'"type="text"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('URL here').'"type="text"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Dependenies here').'"type="text"></th>';
echo '</tr>';    echo '<tr  align="center">';
echo '<td><input class="enfi-admin-input-checkbox"  type="checkbox"></th>';
echo '<td><input class="enfi-admin-input-checkbox" type="checkbox"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Slug here').'"type="text"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('URL here').'"type="text"></th>';
echo '<td><input class="enfi-admin-input-text" placeholder="'.__('Dependenies here').'"type="text"></th>';
echo '</tr>';

    echo '</table>';
}

################################################################################################################################################## 
### frontend
##################################################################################################################################################

function enqueue_styles_and_scripts() {

    if(!is_admin()) {

        # default jquery deregister 
        wp_deregister_script( 'jquery' );

        # jQuery
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', '', '', true);
        wp_enqueue_script( 'jquery' );

        # jQuery UI
        wp_register_script( 'jqueryUI',  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', array( 'jquery' ),'', true);
        wp_enqueue_script( 'jqueryUI' );

        # fontawesome
        wp_register_style('fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');
        wp_enqueue_style( 'fontawesome' );

        # animation on scroll
        wp_register_style('aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css');
        wp_enqueue_style( 'aos' );
        wp_register_script('aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js', array( 'jquery', 'main' ));
        wp_enqueue_script( 'aos' );

        # bootstrap CSS Grid
        wp_register_style('bootstrapCSS', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css');
        wp_enqueue_style( 'bootstrapCSS' );
  
        # bootstrap
        wp_register_script( 'bootstrapJS', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'));



        wp_enqueue_script( 'bootstrapJS' );

        # theme CSS and JS
        wp_register_style('mainCSS', get_template_directory_uri().'/style.css');
        wp_register_script('mainJS', get_template_directory_uri().'/assets/js/themeJS.js', array( 'jquery' ), '', true);

        # theme CSS
        $option = ef_get_option('ef-styles-scripts');
       
        if(is_child_theme()) {
            wp_register_script('mainJS-child', get_stylesheet_directory_uri().'/assets/js/themeJS.js', array( 'jquery' ), '', true);
            wp_enqueue_script( 'mainJS-child' );

            if(isset($option['use-parent-js'])) {
                wp_enqueue_script( 'mainJS' );
            }

        } else  {
            wp_enqueue_script( 'mainJS' );
        }
        
        if(is_child_theme()) {
            wp_register_style('mainCSS-child', get_stylesheet_directory_uri().'/style.css');
            wp_enqueue_style( 'mainCSS-child' );

            if(isset($option['use-parent-style'])) {
                wp_enqueue_style( 'mainCSS' );
            }
            
        } else {
            wp_enqueue_style( 'mainCSS' );
        }
    }
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts', 1);

################################################################################################################################################## 
### backend
##################################################################################################################################################

function enqueue_admin_styles_and_scripts() {

    # load all css files in admin/assets/css
    foreach(glob(get_template_directory() . "/core/assets/css/*.css") as $file){
        wp_register_style(basename($file, ".css"), get_template_directory_uri() . "/core/assets/css/".basename($file));
        wp_enqueue_style(basename($file, ".css"));
    }

    # load all js files in admin/assets/js
    foreach(glob(get_template_directory() . "/core/assets/js/*.js") as $file){
        wp_register_script(basename($file, ".js"), get_template_directory_uri() . "/core/assets/js/".basename($file));
        wp_enqueue_script(basename($file, ".js"));
    }

    # wp default color picker
    wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker');

    # wp media upload
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    # fontawesome
    wp_register_style('fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css');
    wp_enqueue_style( 'fontawesome' );

    # theme admin CSS
    wp_register_style('enfi-admin', get_template_directory_uri().'/assets/css/admin.css', '', '', false);
    wp_enqueue_style( 'enfi-admin' );

    # theme admin js
    wp_register_script('enfi-admin-script', get_template_directory_uri().'/assets/js/admin-themeJS.js');
    wp_enqueue_script( 'enfi-admin-script' );

    # bootstrap grid
    wp_register_style('bootstrap-grid', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css', array('enfi-admin'),'', false);

}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles_and_scripts'); 

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_styles($tag, $handle) {
    $tag = str_replace( "<link rel='stylesheet'", "\t<link rel='stylesheet'", $tag );
    return $tag;
}
add_filter('style_loader_tag', 'prettifier_styles', 10, 2);

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_scripts($tag, $handle) {
    $tag = str_replace( "<script", "\t<script", $tag );
    return $tag;
}
add_filter('script_loader_tag', 'prettifier_scripts', 10, 2);

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_styles_comment() {
    ef_html_comment('Stylesheets');
}
add_filter('wp_print_styles', 'prettifier_styles_comment', 10);

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_scripts_comment() {
    ef_html_comment('Scripts');
}
add_filter('wp_print_scripts', 'prettifier_scripts_comment', 10);

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_scripts_comment_footer() {
    ef_html_comment('Scripts');
}
add_filter('wp_print_footer_scripts', 'prettifier_scripts_comment_footer', 0);


?>