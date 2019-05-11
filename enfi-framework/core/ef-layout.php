<?php

$layout_page = new EF_Settings_Page('layout', __('Layout Einstellungen', 'ef'), __('Layout', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'settings', 'fa-object-group', 5);

    $layout_page->addSection('header', __('Header', 'ef'));
        $layout_page->addField('header', 'header', __('Header Layout', 'ef'), null, 'selection', 'default', array('options' => ef_layout_get_templates_list('header'), 'defaultOptionValue' => 'default'));

    $layout_page->addSection('footer', __('Footer', 'ef'));
        $layout_page->addField('footer', 'footer', __('Footer Layout', 'ef'),null, 'selection', 'default', array('options' => ef_layout_get_templates_list('footer'), 'defaultOptionValue' => 'default'));

    $layout_page->addSection('post-type-layout-settings', __('Post Type Layout Settings', 'ef'));
        $layout_page->addField('post-type-layout-settings', 'post-type-layout-settings', __('Post Types', 'ef'), null, 'checkbox-group', null, array( 'post_types' => get_post_types()));

    $layout_page->setDefaultValues();

# template list 
function ef_layout_get_templates_list($_template_name) {

    # register and enqueue scripts and css for active template
    ef_layout_enqueue_css_js($_template_name);

    $_templates_path = get_template_directory() . "/templates/".$_template_name."/";
    $_templates_path_child = get_stylesheet_directory() . "/templates/".$_template_name."/";
    
    $_templates = array();
    
    # read templates of parrent theme
    foreach(glob($_templates_path."*", GLOB_ONLYDIR) as $file){
        array_push($_templates, array( 'text' =>  basename($file), 'value' => basename($file)));  
    }
    
    # if child theme, read templates of child theme
    if(is_child_theme()) {
        foreach(glob($_templates_path_child."*", GLOB_ONLYDIR) as $file){
            $value =  array( 'text' =>  basename($file), 'value' => basename($file));
            if(!in_array($value, $_templates, true)){
                array_push($_templates, $value);  
            }
        } 
    }

    return $_templates;
    
}

function ef_layout_enqueue_css_js($_template_name) {

    $template = ef_get_option('layout');
    $template = $template[$_template_name];

    if(!is_child_theme()) {
        if($template == '' || $template == null || !file_exists(get_template_directory().'/templates/'.$_template_name.'/'.$template.'/template.php'))
            $template = 'default';
    } else {
        if($template == '' || $template == null || !file_exists(get_stylesheet_directory().'/templates/'.$_template_name.'/'.$template.'/template.php'))
            $template = 'default';
    }

    if(!is_admin()) {
        
        add_action('wp_enqueue_scripts', function() use ($template, $_template_name) {
           

            if(is_child_theme()) {
                
                $path = get_stylesheet_directory().'/templates/'.$_template_name.'/'.$template.'';
                $path_uri = get_stylesheet_directory_uri().'/templates/'.$_template_name.'/'.$template.'';

                //check if directory exists in child theme for this template...
                if(is_dir($path)) {

                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file), array('bootstrapCSS'));
                        wp_enqueue_style(basename($file, ".css"));
                    }

                    foreach(glob($path.'/js/*.js') as $file){
                        wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                        wp_enqueue_script(basename($file, ".js"));
                    }

                # ... if not, check parrent theme for this template
                } else {

                    $path = get_template_directory().'/templates/'.$_template_name.'/'.$template.'';
                    $path_uri = get_template_directory_uri().'/templates/'.$_template_name.'/'.$template.'';

                    if(is_dir($path)) {

                        foreach(glob($path.'/css/*.css') as $file){
                            wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file), array('bootstrapCSS'));
                            wp_enqueue_style(basename($file, ".css"));
                        }
    
                        foreach(glob($path.'/js/*.js') as $file){
                            wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                            wp_enqueue_script(basename($file, ".js"));
                        }
                    }
                }

            } else {

                $path = get_template_directory().'/templates/'.$_template_name.'/'.$template.'';
                $path_uri = get_template_directory_uri().'/templates/'.$_template_name.'/'.$template.'';

                if(is_dir($path)) {

                    foreach(glob($path.'/css/*.css') as $file){
                        wp_register_style(basename($file, ".css"), $path_uri.'/css/'.basename($file), array('bootstrapCSS'));
                        wp_enqueue_style(basename($file, ".css"));
                    }

                    foreach(glob($path.'/js/*.js') as $file){
                        wp_register_script(basename($file, ".js"), $path_uri.'/js/'.basename($file), array( 'jquery', 'jqueryUI' ), '', true);
                        wp_enqueue_script(basename($file, ".js"));
                    }
                }
            }

            
        });

    } else {

        # load settings for templates
        if(!is_child_theme()) {
            if(file_exists(get_template_directory().'/templates/'.$_template_name.'/'.$template.'/settings.php'))
                require get_template_directory().'/templates/'.$_template_name.'/'.$template.'/settings.php';
        } else {
            if(file_exists(get_stylesheet_directory().'/templates/'.$_template_name.'/'.$template.'/settings.php'))
                require get_stylesheet_directory().'/templates/'.$_template_name.'/'.$template.'/settings.php';
        }

    }
    
}

function ef_layout_get_template($_template_name) {

    $template = ef_get_option('layout');
    $template = $template[$_template_name];
        
    if(!is_child_theme()) {
        if($template == '' || $template == null || !file_exists(get_template_directory().'/templates/'.$_template_name.'/'.$template.'/template.php'))
            $template = 'default';
    } else {
        if($template == '' || $template == null || !file_exists(get_stylesheet_directory().'/templates/'.$_template_name.'/'.$template.'/template.php'))
            $template = 'default';
    } 

    if($_template_name == 'header')
        get_header($template);

    # load mobile tempalte if exists and its mobile site
    if(wp_is_mobile() && file_exists(get_template_directory().'/templates/'.$_template_name.'/'.$template.'/template-mobile.php'))
        get_template_part('templates/'.$_template_name.'/'.$template.'/template-mobile');
    else
        get_template_part('templates/'.$_template_name.'/'.$template.'/template');

    if($_template_name == 'footer')
        get_footer($template);
    
}

function ef_layout_breadcrumbs($gutter = '\\') {

    $delimiter = '<span class="gutter">' . $gutter . '</span>';
    $home      = __('Home', 'ef');
    $before    = '<span class="current-page">';
    $after     = '</span>';

    if (!is_home() && !is_front_page() || is_paged()) {

        echo '<nav>';
        global $post;

        $homeLink = get_bloginfo('url');
        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

        if (is_category()) {
            global $wp_query;
            $cat_obj   = $wp_query->get_queried_object();
            $thisCat   = $cat_obj->term_id;
            $thisCat   = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $before . single_cat_title('', false) . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug      = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat    = get_the_category($parent->ID);
            $cat    = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page          = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id     = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . 'Ergebnisse für Ihre Suche nach "' . get_search_query() . '"' . $after;
        } elseif (is_tag()) {
            echo $before . 'Beiträge mit dem Schlagwort "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_404()) {
            echo $before . 'Fehler 404' . $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo ': ' . __('Seite') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }
        echo '</nav>';
    }
}

?>