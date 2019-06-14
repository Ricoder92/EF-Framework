<?php

################################################################################################################################################## 
### style and script stuff
##################################################################################################################################################

$styles_scripts = new EF_Settings_Page('ef-styles-scripts', __('STYLES_SCRIPTS', 'ef'), __('STYLES_SCRIPTS', 'ef'), __('STYLES_SCRIPTS_DESCRIPTION', 'ef'), 'layout', '', 6);

if(is_child_theme()) {
    $styles_scripts->addSection('settings', __('STYLES_SCRIPTS_SETTINGS', 'ef'));
    $styles_scripts->addField('settings', 'use-parent-style', __('STYLES_SCRIPTS_USE_PARRENT_CSS', 'ef'), null, 'checkbox', true, array('checkboxText' => __('ENABLE', 'ef')));
    $styles_scripts->addField('settings', 'use-parent-js', __('STYLES_SCRIPTS_USE_PARRENT_JS', 'ef'), null, 'checkbox', true, array('checkboxText' => __('ENABLE', 'ef')));
}

$styles_scripts->addSection('thirdparty', __('STYLES_SCRIPTS_THIRDPARTY', 'ef'));
$styles_scripts->addField('thirdparty', 'jqueryui', __('JQUERY_UI', 'ef'), null, 'checkbox', true, array('checkboxText' => __('ENABLE', 'ef')));
$styles_scripts->addField('thirdparty', 'bootstrap', __('BOOTSTRAP', 'ef'), null, 'checkbox', true, array('checkboxText' => __('ENABLE', 'ef')));
$styles_scripts->addField('thirdparty', 'aos', __('AOS', 'ef'), null, 'checkbox', true, array('checkboxText' => __('ENABLE', 'ef')));
$styles_scripts->addField('thirdparty', 'fontawesome', __('FONTAWESOME', 'ef'), null, 'checkbox', true, array('checkboxText' => __('ENABLE', 'ef')));

$styles_scripts->addSection('styles_scripts_render', __('STYLES_SCRIPTS_SETTINGS', 'ef'));
$styles_scripts->addContent('styles_scripts_render', 'styles_scripts_render');

$styles_scripts->setDefaultValues();

function styles_scripts_render() {
 echo '<table class="ef-admin-table">';

    echo '<thead><tr>';
        echo '<th class="center" style="width:10%;">'.__('FRONTEND', 'ef').'</th>';
        echo '<th class="center" style="width:10%;">'.__('BACKEND', 'ef').'</th>';
        echo '<th class="left" style="width:20%;">'.__('SLUG', 'ef').'</th>';
        echo '<th class="left" style="width:40%;">'.__('URL', 'ef').'</th>';
        echo '<th class="left" style="width:20%;">'.__('DEPENDENCE', 'ef').'</th>';
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

        $options = ef_get_option('ef-styles-scripts');

        # default jquery deregister 
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js');
        wp_enqueue_script( 'jquery' );
        
        # jQuery UI
        if(isset($options['jqueryui'])) {
            wp_register_script( 'jqueryUI',  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', array( 'jquery' ));
            wp_enqueue_script( 'jqueryUI' );
        }

        # fontawesome
        if(isset($options['fontawesome'])) {
            wp_register_style('fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');
            wp_enqueue_style( 'fontawesome' );
        }

        # animation on scroll
        if(isset($options['aos'])) {
            wp_register_style('aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css');
            wp_enqueue_style( 'aos' );
            wp_register_script('aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js', array( 'jquery', 'main' ));
            wp_enqueue_script( 'aos' );
        }

        # bootstrap
        if(isset($options['bootstrap'])) {
            wp_register_style('bootstrapCSS', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css');
            wp_enqueue_style( 'bootstrapCSS' );
            wp_register_script( 'bootstrapJS', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'));
            wp_enqueue_script( 'bootstrapJS' );
        }

        # theme CSS and JS
        wp_register_style('mainCSS', get_template_directory_uri().'/style.css');
        wp_register_script('mainJS', get_template_directory_uri().'/assets/js/themeJS.js', array( 'jquery' ));

       
        if(is_child_theme()) {
            wp_register_script('mainJS-child', get_stylesheet_directory_uri().'/assets/js/themeJS.js', array( 'jquery' ));
            wp_enqueue_script( 'mainJS-child' );

            if(isset($options['use-parent-js'])) {
                wp_enqueue_script( 'mainJS' );
            }

        } else  {
            wp_enqueue_script( 'mainJS' );
        }
        
        if(is_child_theme()) {
            wp_register_style('mainCSS-child', get_stylesheet_directory_uri().'/style.css');
            wp_enqueue_style( 'mainCSS-child' );

            if(isset($options['use-parent-style'])) {
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
    #wp_register_style('bootstrap-grid', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css', array('enfi-admin'),'', false);
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles_and_scripts'); 

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_styles($tag, $handle) {
    $tag = str_replace( "<link rel='stylesheet'", "<link rel='stylesheet'", $tag );
    return $tag;
}
add_filter('style_loader_tag', 'prettifier_styles', 10, 2);

################################################################################################################################################## 
### prettifier script tags
##################################################################################################################################################

function prettifier_scripts($tag, $handle) {
    $tag = str_replace( "<script", "<script", $tag );
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