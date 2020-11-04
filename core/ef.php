<?php

################################################################################################################################################## 
### thats the "HERZSTÜCK" :)
##################################################################################################################################################

class EF_Framework {
 
    public function __construct($title, $description, $capability = 'manage_options') {

        # set title and description for Enfi Framework
        $this->title = $title;
        $this->description = $description;

        add_editor_style();

        # dashboard Menu
        add_action( 'admin_menu', array(&$this, 'admin_menu') );

        # filter for defer tags
        if(!is_admin()) 
            add_filter('script_loader_tag', array(&$this, 'defer_scripts'), 10, 2);

        # theme setup stuff
        add_action( 'after_setup_theme', array(&$this, 'setup_theme') );

        # widgets hook
        add_action( 'widgets_init',  array(&$this, 'register_widgets' ));

        add_action('wp_head', array(&$this, 'ef_head'), -9999);
        add_action( 'wp_head', array(&$this, 'global_header') ,-1);
      
        # require some ef stuff
        require_once get_template_directory().'/core/ef-functions.php';

        require_once get_template_directory().'/core/class-ef-settings-page.php';
        require_once get_template_directory().'/core/class-ef-meta-box.php';
        require_once get_template_directory().'/core/class-ef-post-type.php';
        require_once get_template_directory().'/core/class-ef-taxonomy.php';
        require_once get_template_directory().'/core/class-ef-navigation.php';

        require_once get_template_directory().'/core/ef-generel.php';
        require_once get_template_directory().'/core/ef-styles-scripts.php';
        require_once get_template_directory().'/core/ef-layout.php';
        require_once get_template_directory().'/core/ef-debug.php';
        require_once get_template_directory().'/core/ef-google-api.php';
        require_once get_template_directory().'/core/ef-modules.php';
        require_once get_template_directory().'/core/ef-seo.php';
        require_once get_template_directory().'/core/ef-social-media.php';
        require_once get_template_directory().'/core/ef-blocks.php';
        require_once get_template_directory().'/core/ef-cookie-law.php';
        #require_once get_template_directory().'/core/ef-cover.php';
        require_once get_template_directory().'/core/ef-post-types.php';
        

        # load shortcodes
        foreach(glob(get_template_directory() . "/editor/shortcodes/*/init.php") as $file){
            require_once $file;
        }

        # load widgets
        foreach(glob(get_template_directory() . "/editor/widgets/*/init.php") as $file){
            require_once $file;
        }

        $options = ef_get_option('ef-settings');

        #disable some stuff
        if(isset($options['disable-posts']))
            require_once get_template_directory().'/core/ef-disable-posts.php';

        if(isset($options['disable-comments']))
            require_once get_template_directory().'/core/ef-disable-comments.php';

        if(isset($options['disable-emoji']))
            require_once get_template_directory().'/core/ef-disable-emoji.php';

        if(isset($options['disable-oembed']))
            require_once get_template_directory().'/core/ef-disable-oembed.php';

        if(isset($options['disable-rss']))
            require_once get_template_directory().'/core/ef-disable-rss.php';

        if(isset($options['disable-rsd']))
            remove_action('wp_head', 'rsd_link');
        
        if(isset($options['disable-wlwmanifest']))
            remove_action('wp_head', 'wlwmanifest_link');

        if(isset($options['disable-generator']))
            remove_action('wp_head', 'wp_generator');

        # adminbar link hook
        if(!isset($options['disable-admin-bar']))
            add_action('admin_bar_menu', array(&$this, 'admin_bar_link'), 100);
    
    }

    # ef head
    function ef_head() {
        echo "\n<!--#################################################################\n";
        echo "powered by EF Framework\n";
        echo "created by Enrico Fischer - Halle(Saale)\n";
        echo "www.ricoder.de | info@ricoder.de \n";
        echo "#################################################################--!>\n";
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

        echo '<div class="ef-dashboard-head">';
            echo '<h1>'.__($this->title, 'ef').'</h1>';
            echo '<p>'.__($this->description, 'ef').'</p>';
        echo '</div>';

        echo '<div class="ef-dashboard-content">';
            echo '<div class="ef-dashboard-list-cards">';
                do_action('ef-admin-navigation-main-page');
            echo '</div>';   
        echo '</div>';

    }

    # set "defer" tag to javascript for more performance
    function defer_scripts($tag, $handle) {
        return str_replace( ' src', ' src', $tag );
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
        echo "<meta charset=\"UTF-8\" />\n";
        
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
        else 
            $url = site_url();
         
        # print url
        echo "<meta name=\"URL\" content=\"".$url."\">\n";
        echo "<meta name=\"identifier-URL\" content=\"".$url."\">\n";
           
        # viewport
        echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";

        # language
        echo "<meta name=\"language\" content=\"".get_locale()."\">\n";

        # apple tags
        ef_html_comment('Apple metatags');
        echo "<meta name=\"format-detection\" content=\"telephone=yes\">\n";
        echo "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">\n";
        echo "<meta name=\"apple-touch-fullscreen\" content=\"yes\">\n";
        echo "<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\">\n";
        $icon_url = get_site_icon_url();

        if($icon_url != null) {

            echo "<link rel=\"apple-touch-icon\" href=\"".$icon_url."\" />\n";
            echo "<link rel=\"apple-touch-icon\" type=\"image/png\" href=\"".$icon_url."\" />\n";

            $icon_url_2 = get_site_icon_url(72);
            echo "<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"".$icon_url_2."\" />\n";

            $icon_url_3 = get_site_icon_url(114);
            echo "<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"".$icon_url_3."\" />\n";
            
        }

        # internet explorer tags
        ef_html_comment('Internet Exploter metatags');
        echo "<meta name=\"msapplication-starturl\" content=\"".get_home_url()."\">\n";
        echo "<meta name=\"msapplication-navbutton-color\" content=\"black\">\n";
        echo "<meta name=\"application-name\" content=\"".get_bloginfo('name')."\">\n";
        if($icon_url != null) {
            echo "<link rel=\"shortcut icon\" href=\"".$icon_url."\" />\n";
        }
    }


}


################################################################################################################################################## 
### und ab die Post....
##################################################################################################################################################

new EF_Framework(__('EF_FRAMEWORK', 'ef'), __('EF_FRAMEWORK_DESCRIPTION', 'ef'), 'upload_themes');

?>