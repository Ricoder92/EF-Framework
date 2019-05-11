<?php

class Enfi_Framework {
 
    public function __construct($title, $description, $capability = 'manage_options') {

        # set title and description for Enfi Framework
        $this->title = $title;
        $this->description = $description;

        # dashboard Menu
        add_action( 'admin_menu', array(&$this, 'admin_menu') );

        # filter for defer tags
        if(!is_admin()) 
            add_filter('script_loader_tag', array(&$this, 'defer_scripts'), 10, 2);

        # theme setup stuff
        add_action( 'after_setup_theme', array(&$this, 'setup_theme') );

        # widgets hook
        add_action( 'widgets_init',  array(&$this, 'register_widgets' ));

        # adminbar link hook
        add_action('admin_bar_menu', array(&$this, 'admin_bar_link'), 100);

        # remove rss
        add_action('wp_head', array(&$this, 'ef_head'), -9999);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');

        # global header stuff (except titletag)
        add_action( 'wp_head', array(&$this, 'global_header'), -999 );
      

    
        # require some ef stuff
        require_once get_template_directory().'/core/class/ef-admin-meta-box.php';
        require_once get_template_directory().'/core/class/ef-admin-settings-page.php';
        require_once get_template_directory().'/core/class/ef-admin-navigation.php';
        require_once get_template_directory().'/core/class/ef-admin-post-type.php';
        
        require_once get_template_directory().'/core/ef-functions.php';
        require_once get_template_directory().'/core/ef-post-types.php';
        require_once get_template_directory().'/core/ef-styles-scripts.php';
        require_once get_template_directory().'/core/ef-layout.php';
        require_once get_template_directory().'/core/ef-debug.php';
        require_once get_template_directory().'/core/ef-google-api.php';
        require_once get_template_directory().'/core/ef-widgets.php';
        require_once get_template_directory().'/core/ef-shortcodes.php';
        require_once get_template_directory().'/core/ef-modules.php';
        require_once get_template_directory().'/core/ef-seo.php';
        require_once get_template_directory().'/core/ef-social-media.php';
        require_once get_template_directory().'/core/ef-blocks.php';
        require_once get_template_directory().'/core/ef-cookie-law.php';

        require_once get_template_directory().'/shortcodes/enfi-post-grid.php';


    }

    # ef head
    function ef_head() {

        echo "\n\t<!--#################################################################\n";
        echo "\t\tpowered by Enfi Framework\n";
        echo "\t\tcreated by Enrico Fischer - Halle(Saale)\n";
        echo "\t\twww.ricoder.de | info@ricoder.de \n";
        echo "\t#################################################################--!>\n";
    }

    # admin bar link
    function admin_bar_link($admin_bar){
        $admin_bar->add_menu( array(
            'id'    => 'enfi-framework',
            'title' => __('Enfi Framework'),
            'href'  => site_url().'/wp-admin/themes.php?page=enfi-framework',
            'meta'  => array(
                'title' => __('Enfi Framework'),            
            ),
        ));
    }

    # function for admin menu
    function admin_menu() {
        add_menu_page('Enfi Framework','Enfi Framework','manage_options','enfi-framework',array($this,'admin_menu_render'),'','99');
    }

    # function for admin menu render
    function admin_menu_render() {

        wp_enqueue_style('bootstrap-grid');

        echo '<div class="enfi-admin-page-head">';
            echo '<div class="container-fluid">';
                echo '<div class="row">';
                    echo '<div class="col-lg-12">';
                        echo '<div class="title-description">';
                            echo '<h1>'.__($this->title).'</h1>';
                            echo '<p>'.__($this->description).'</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';   
            echo '</div>';
        echo '</div>';

        echo '<div class="enfi-admin-page-content">';
            echo '<div class="container-fluid">';
                echo '<div class="row">';
                        do_action('ef-admin-navigation-main-page');
                echo '</div>';   
            echo '</div>';
        echo '</div>';
    }

    # set "defer" tag to javascript for more performance
    function defer_scripts($tag, $handle) {
        return str_replace( ' src', ' defer src', $tag );
    }

    # setup theme stuff
    function setup_theme() {

        # textdomain
        load_theme_textdomain( 'enfi', get_template_directory() . '/languages' );
        
        # theme supports
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
        add_theme_support( 'custom-logo', array('header-text' => array( 'site-title', 'site-description' ),'flex-width' => true) );
        add_theme_support( 'align-wide' );
    
        # nav menus
        register_nav_menus( array(
            'header' => __( 'Hauptmenü', 'enfi' ),
            'footer'  => __( 'FooterMenü', 'enfi' ),
        ) );

        # remove emojis and rss stuff
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        #add_filter('tiny_mce_plugins', 'remove_tinymce_emoji');
        add_filter( 'emoji_svg_url', '__return_false' );
        remove_action('wp_head', 'wp_generator');
	    remove_post_type_support( 'page', 'custom-fields' );
    
    }

    # register widget areas
    function register_widgets() {
    
        # header left
        register_sidebar( array(
            'name'          => __('Header Obere Leiste Links', 'enfi'),
            'id'            => 'header-top-bar-left',
            'description'   => __('Hier können Widgets plaziert werden, die oberhalb des Header-Bereiches nebeneinander dynamisch angezeigt werden.', 'enfi'),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<span style="display:none;">',
            'after_title'   => '</span>',
        ));

        # header right
        register_sidebar( array(
            'name'          => __('Header Obere Leiste Rechts', 'enfi'),
            'id'            => 'header-top-bar-right',
            'description'   => __('Hier können Widgets plaziert werden, die oberhalb des Header-Bereiches nebeneinander dynamisch angezeigt werden.','enfi'),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<span style="display:none;">',
            'after_title'   => '</span>',
        ));

        # footer
        register_sidebar( array(
            'name'          => __('Fußbereich', 'enfi'),
            'id'            => 'footer',
            'description'   => __('Hier können Widgets plaziert werden, die oberhalb des Header-Bereiches nebeneinander dynamisch angezeigt werden.','enfi'),
            'before_widget' => '<div class="col-lg">',
            'after_widget'  => '</div>',
            'before_title'  => '<span style="display:none;">',
            'after_title'   => '</span>',
        ));

        # remove auto <p> tags in widgets
        remove_filter('widget_text_content', 'wpautop');
    }

    function global_header() {
        ef_html_comment('Metatags');
        echo "\t<meta charset=\"UTF-8\" />\n";
        if(is_single())
            echo "\t<meta name=\"url\" content=\"".get_the_permalink()."\">\n";
        else if(is_archive() || is_tax())
            echo "\t<meta name=\"url\" content=\"".get_post_type_archive_link(get_query_var( 'post_type' ))."\">\n";

        if(is_single())
            echo "\t<meta name=\"identifier-URL\" content=\"".get_the_permalink()."\">\n";
        else if(is_archive() || is_tax())
            echo "\t<meta name=\"identifier-URL\" content=\"".get_post_type_archive_link(get_query_var( 'post_type' ))."\">\n";
        
        echo "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
        echo "\t<meta name=\"language\" content=\"".get_locale()."\">\n";

        ef_html_comment('Apple metatags');
        echo "\t<meta name=\"format-detection\" content=\"telephone=yes\">\n";
        echo "\t<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">\n";
        echo "\t<meta name=\"apple-touch-fullscreen\" content=\"yes\">\n";
        echo "\t<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">\n";
        $icon_url = get_site_icon_url();

        if($icon_url != null) {

            echo "\t<link rel=\"apple-touch-icon\" href=\"".$icon_url."\" />\n";
            echo "\t<link rel=\"apple-touch-icon\" type=\"image/png\" href=\"".$icon_url."\" />\n";

            $icon_url_2 = get_site_icon_url(72);
            echo "\t<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"".$icon_url_2."\" />\n";

            $icon_url_3 = get_site_icon_url(114);
            echo "\t<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"".$icon_url_3."\" />\n";
            
        }

        ef_html_comment('Internet Exploter metatags');
        echo "\t<meta name=\"msapplication-starturl\" content=\"".get_home_url()."\">\n";
        echo "\t<meta name=\"msapplication-navbutton-color\" content=\"black\">\n";
        echo "\t<meta name=\"application-name\" content=\"".get_bloginfo('name')."\">\n";
        if($icon_url != null) {
            echo "\t<link rel=\"shortcut icon\" href=\"".$icon_url."\" />\n";
        }
    }

    public static function render_logo() {
        if ( has_custom_logo() ) {
            echo the_custom_logo();
        } else {
            echo '<div onclick="location.href=\''.site_url().'\';">'.$logo_out = ''.get_bloginfo('name').'</div>';
        }
    }

  
   

}

new Enfi_Framework(__('Enfi Framework', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.DebugLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est ', 'enfi'), 'upload_themes');


?>