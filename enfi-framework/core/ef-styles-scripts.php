<?php

$styles_scripts = new EF_Settings_Page('styles-scripts', __('Styles & Scripts', 'ef'), __('Styles & Scripts', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'layout', '', 6);
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

# function for frontend styles and scripts
function enqueue_styles_and_scripts() {

    if(!is_admin()) {

        # default jquery deregister 
        wp_deregister_script( 'jquery' );

        # jQuery
        wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', '', '', false);
        wp_enqueue_script( 'jquery' );

        # jQuery UI
        wp_register_script( 'jqueryUI',  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js', array( 'jquery' ), '', false);
        wp_enqueue_script( 'jqueryUI' );

        # google Font
        $option = ef_get_option('google-api');
        $fonts = $option['google-fonts'];

        
        if($fonts) {
            $fonts_arr = implode($fonts, '|');
            wp_register_style('google-font-1', 'https://fonts.googleapis.com/css?family='.$fonts_arr);
            wp_enqueue_style( 'google-font-1' );
        }

        # fontawesome
        wp_register_style('fontawesome', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');
        wp_enqueue_style( 'fontawesome' );

        # bootstrap CSS Grid
        wp_register_style('bootstrapCSS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css');
        wp_enqueue_style( 'bootstrapCSS' );

        # animation on scroll
        wp_register_style('aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css');
        wp_enqueue_style( 'aos' );

        # theme JS
        wp_register_script('aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js', array( 'jquery', 'main' ),'', false);
        wp_enqueue_script( 'aos' );

        # bootstrap
        wp_register_script( 'bootstrapJS', get_template_directory_uri().'/assets/thirdparty/bootstrap/bootstrap.min.js', '', '', false);
        wp_enqueue_script( 'bootstrapJS' );

        # theme JS
        wp_register_script('main', get_template_directory_uri().'/assets/js/themeJS.js', array( 'jquery' ), '', false);
        wp_enqueue_script( 'main' );

        # theme CSS
        $option = ef_get_option('styles-scripts');

        wp_register_style('main', get_template_directory_uri().'/style.css');

        if(is_child_theme()) {
            wp_register_style('main-child', get_stylesheet_directory_uri().'/style.css');
            wp_enqueue_style( 'main-child' );
            
            $child_theme = get_stylesheet();
            $option = get_option('styles-scripts-'.$child_theme);
            
            if(isset($option['use-parent-style']))
            wp_enqueue_style( 'main' );
            
        } else {
            wp_enqueue_style( 'main' );
        }
        
    }
}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

# function for admin styles and scripts
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


# prettifier style tags
function prettifier_styles($tag, $handle) {
    $tag = str_replace( "<link rel='stylesheet'", "\t<link rel='stylesheet'", $tag );
    return $tag;
}
add_filter('style_loader_tag', 'prettifier_styles', 10, 2);

# prettifier script tags
function prettifier_scripts($tag, $handle) {
    $tag = str_replace( "<script", "\t<script", $tag );
    return $tag;
}
add_filter('script_loader_tag', 'prettifier_scripts', 10, 2);

# prettifier style tags #2
function prettifier_styles_comment() {
    ef_html_comment('Stylesheets');
}
add_filter('wp_print_styles', 'prettifier_styles_comment', 10);

# prettifier script tags #2
function prettifier_scripts_comment() {
    ef_html_comment('Scripts');
}
add_filter('wp_print_scripts', 'prettifier_scripts_comment', 10);

# prettifier script tags #3
function prettifier_scripts_comment_footer() {
    ef_html_comment('Scripts');
}
add_filter('wp_print_footer_scripts', 'prettifier_scripts_comment_footer', 0);






?>