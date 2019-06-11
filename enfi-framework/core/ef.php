<?php

################################################################################################################################################## 
### thats the "HERZSTÜCK" :)
##################################################################################################################################################

class EF_Framework {
 
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

        # remove wp embed
        add_action( 'init', array(&$this, 'ef_remove_wp_embed'), 9999 );

        # remove rss
        add_action('wp_head', array(&$this, 'ef_head'), -1);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');

        # global header stuff (except titletag)
        add_action( 'wp_head', array(&$this, 'global_header') ,-1);
      
        # require some ef stuff
        require_once get_template_directory().'/core/ef-functions.php';

        require_once get_template_directory().'/core/inc/class-ef-settings-page.php';
        require_once get_template_directory().'/core/inc/class-ef-meta-box.php';
        require_once get_template_directory().'/core/inc/class-ef-post-type.php';
        require_once get_template_directory().'/core/inc/class-ef-taxonomy.php';
        require_once get_template_directory().'/core/inc/class-ef-navigation.php';

        #require_once get_template_directory().'/core/ef-update.php';
        require_once get_template_directory().'/core/ef-styles-scripts.php';
        require_once get_template_directory().'/core/ef-layout.php';
        require_once get_template_directory().'/core/ef-debug.php';
        require_once get_template_directory().'/core/ef-loader.php';
        require_once get_template_directory().'/core/ef-google-api.php';
        require_once get_template_directory().'/core/ef-modules.php';
        require_once get_template_directory().'/core/ef-seo.php';
        require_once get_template_directory().'/core/ef-social-media.php';
        require_once get_template_directory().'/core/ef-blocks.php';
        require_once get_template_directory().'/core/ef-cookie-law.php';
        require_once get_template_directory().'/core/ef-cover.php';

    }

    # ef head
    function ef_head() {
        echo "\n\t<!--#################################################################\n";
        echo "\t\tpowered by EF Framework\n";
        echo "\t\tcreated by Enrico Fischer - Halle(Saale)\n";
        echo "\t\twww.ricoder.de | info@ricoder.de \n";
        echo "\t#################################################################--!>\n";
    }

    # admin bar link
    function admin_bar_link($admin_bar){
        $admin_bar->add_menu( array(
            'id'    => 'ef-framework',
            'title' => __('EF_FRAMEWORK', 'ef'),
            'href'  => site_url().'/wp-admin/themes.php?page=ef-framework',
            'meta'  => array(
                'title' => __('EF_FRAMEWORK', 'ef'),            
            ),
        ));
    }

    # function for admin menu
    function admin_menu() {
        add_menu_page(__('EF_FRAMEWORK', 'ef'),__('EF_FRAMEWORK', 'ef'),'manage_options','ef-framework',array($this,'admin_menu_render'),'','99');
    }

    # function for admin menu render
    function admin_menu_render() {

        wp_enqueue_style('bootstrap-grid');

        echo '<div class="ef-admin-page-head">';
            echo '<div class="container-fluid">';
                echo '<div class="row">';
                    echo '<div class="col-lg-12">';
                        echo '<div class="title-description">';
                            echo '<h1>'.__($this->title, 'ef').'</h1>';
                            echo '<p>'.__($this->description, 'ef').'</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';   
            echo '</div>';
        echo '</div>';

        echo '<div class="ef-admin-page-content">';
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
        load_theme_textdomain( 'ef', get_template_directory() . '/languages' );
        
        # theme supports
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
        add_theme_support( 'custom-logo', array('header-text' => array( 'site-title', 'site-description' ),'flex-width' => true) );
        add_theme_support( 'align-wide' );
    
        # nav menus
        register_nav_menus( array(
            'header' => __( 'MENU_HEADER', 'ef'),
            'footer'  => __( 'MENU_FOOTER', 'ef'),
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

    function ef_remove_wp_embed() {

        // Remove the REST API endpoint.
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );

        // Turn off oEmbed auto discovery.
        add_filter( 'embed_oembed_discover', '__return_false' );

        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        add_filter( 'tiny_mce_plugins', array(&$this, 'disable_embeds_tiny_mce_plugin'));

        // Remove all embeds rewrite rules.
        add_filter( 'rewrite_rules_array', array(&$this, 'disable_embeds_rewrites'));

        // Remove filter of the oEmbed result before any HTTP requests are made.
        remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );

    }

    # register widget areas
    function register_widgets() {
    
        # header left
        register_sidebar( array(
            'name'          => __('SIDEBAR_HEADER_TOP', 'ef'),
            'id'            => 'header-top-bar-left',
            'description'   => __('SIDEBAR_HEADER_TOP_DESCRIPTION', 'ef'),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<span style="display:none;">',
            'after_title'   => '</span>',
        ));

        # header right
        register_sidebar( array(
            'name'          => __('SIDEBAR_HEADER_RIGHT', 'ef'),
            'id'            => 'header-top-bar-right',
            'description'   => __('SIDEBAR_HEADER_RIGHT_DESCRIPTION','ef'),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<span style="display:none;">',
            'after_title'   => '</span>',
        ));

        # footer
        register_sidebar( array(
            'name'          => __('SIDEBAR_FOOTER', 'ef'),
            'id'            => 'footer',
            'description'   => __('SIDEBAR_FOOTER_DESCRIPTION','ef'),
            'before_widget' => '<div class="col-lg">',
            'after_widget'  => '</div>',
            'before_title'  => '<span style="display:none;">',
            'after_title'   => '</span>',
        ));

        # post 
        register_sidebar( array(
            'name'          => __('POST_SIDEBAR', 'ef'),
            'id'            => 'post-archive-sidebar',
            'description'   => __('POST_SIDEBAR_DESCRIPTION','ef'),
            'before_widget' => '<div class="widget-container">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="title"><h4>',
            'after_title'   => '</h4></div>',
            'before_content'  => '<div class="content">',
            'after_content'   => '</div>',
        ));

        # remove auto <p> tags in widgets
        remove_filter('widget_text_content', 'wpautop');
    }

    function global_header() {

        # meta tags
        ef_html_comment('Metatags');
        echo "\t<meta charset=\"UTF-8\" />\n";
        
        # set url
        if (is_category())
        $url = get_category_link(get_query_var('cat'));
        else if (is_tag())
        $url = get_tag_link(get_queried_object()->term_id);
        else if(is_single() || is_page())
        $url = get_the_permalink();
        else if(is_archive() && !is_tax())
        $url = get_post_type_archive_link(get_query_var( 'post_type' ));
        else if(is_tax()) {
            global $wp_query;
            $url = get_term_link($wp_query->get_queried_object());
        }
        else if(is_home())
            $url = get_post_type_archive_link('post');
        else if(is_front_page())
            $url = site_url();
        else if(is_404())
            $url = site_url();
         
        # print url
        echo "\t<meta name=\"URL\" content=\"".$url."\">\n";
        echo "\t<meta name=\"identifier-URL\" content=\"".$url."\">\n";
           
        # viewport
        echo "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";

        # language
        echo "\t<meta name=\"language\" content=\"".get_locale()."\">\n";

        # apple tags
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

        # internet explorer tags
        ef_html_comment('Internet Exploter metatags');
        echo "\t<meta name=\"msapplication-starturl\" content=\"".get_home_url()."\">\n";
        echo "\t<meta name=\"msapplication-navbutton-color\" content=\"black\">\n";
        echo "\t<meta name=\"application-name\" content=\"".get_bloginfo('name')."\">\n";
        if($icon_url != null) {
            echo "\t<link rel=\"shortcut icon\" href=\"".$icon_url."\" />\n";
        }
    }

    function disable_embeds_tiny_mce_plugin($plugins) {
        return array_diff($plugins, array('wpembed'));
    }
    
    function disable_embeds_rewrites($rules) {
        foreach($rules as $rule => $rewrite) {
            if(false !== strpos($rewrite, 'embed=true')) {
                unset($rules[$rule]);
            }
        }
        return $rules;
    }

}


################################################################################################################################################## 
### und ab die Post....
##################################################################################################################################################

new EF_Framework(__('EF_FRAMEWORK', 'ef'), __('EF_FRAMEWORK_DESCRIPTION', 'ef'), 'upload_themes');

?>