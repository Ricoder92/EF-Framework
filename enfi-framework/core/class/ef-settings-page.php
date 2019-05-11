<?php

# Class for creating plugin page
class EF_Settings_Page {

    # construktur
    public function __construct($id, $name, $menuname, $description, $menu = 'settings', $icon = '', $prio = 0, $capability = 'manage_options') {

        $this->slug = $id;
        $this->name = $name;
        $this->menuName = $menuname;
        $this->description = $description;
        $this->icon = $icon;
        $this->menu = $menu;
        $this->prio = $prio;
        $this->capability = $capability;
        $this->fields = array();

        if(!is_child_theme()) 
            $this->value = get_option($this->slug, 'empty');
        else {
            $child_theme = get_stylesheet();
            $this->value = get_option($this->slug.'-'.$child_theme, 'empty');
        }

        # set menu name if empty
        if($this->menuName == '')
            $this->menuName = $this->name;

            # set menu name if empty
        if($this->menu == '')
            $this->menuName = 'settings';

        if($this->icon == '')
            $this->icon = 'fa-cog';

        # add admin menu page
        add_action( 'admin_menu', function() {

            add_submenu_page( 
                null,                   # Parent Page
                $this->name,                    # Title
                $this->menuName,                # MenuName
                $this->capability,              # Capability
                'ef-framework-'.$this->slug,  # Slug
                array(&$this, 'render')         # Callback
            );

        }, $this->prio );

        # register settings
        add_action('admin_init', function() {

            if(!is_child_theme()) 
                register_setting( $this->slug,  $this->slug );
            else {
                $child_theme = get_stylesheet();
                register_setting( $this->slug,  $this->slug.'-'.$child_theme );
            }

        });

        add_action('ef-admin-navigation-'.$this->menu, function() {
        
            echo '<li><a href="'.admin_url('/admin.php?page=ef-framework-'.$this->slug).'"><i class="icon fas '.$this->icon.' fa-1x"></i>'.$this->menuName.'</a></li>';

        }, $this->prio);

        add_action('ef-admin-navigation-main-page-'.$this->menu, function() {

            $url = admin_url("/admin.php?page=ef-framework-".$this->slug);
        
            echo '<div class="col-lg-3 col-md-6">';
                echo '<div onclick="location.href=\''.$url.'\';" class="ef-admin-navigation-main-page-card">';
                    echo '<div align="center"><i class="icon fas '.$this->icon.' fa-2x"></i><br/><h3> '.$this->menuName.'</h3></div>';
                    echo '<p>'.$this->description.'</p>';
                echo '</div>';
            echo '</div>';

                

        }, $this->prio);

        add_action('admin_bar_menu', function() {

            global $wp_admin_bar;
        
            $menu_id = 'ef-framework';
            $wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' =>  $this->menuName, 'id' =>  $this->slug, 'href' => '/wp-admin/admin.php?page=ef-framework-'.$this->slug));
        
        }, $this->prio);
      

    }

    # register page
    public function addSection($id, $title) {

        add_action('admin_init', function() use ($id, $title) {
            add_settings_section (
                $this->slug.$id, 
                $title, 
                null, 
                'ef-framework-'.$this->slug
            );
        });
       
    }

    public function addContent($function) {

        add_action('ef-framework-content-'.$this->slug, function() use ($function) {
            call_user_func($function);
        });
       
    }

    # create
    public function addField($section_id, $id, $name, $description, $type, $default_value = '', $args = '') {

        add_action('admin_init', function() use ($section_id, $id, $name, $description, $type, $default_value, $args) {

            $data['key'] = $id;
           

            if(!is_child_theme()) 
                $data['name'] = $this->slug.'['.$id.']';
            else {
                $child_theme = get_stylesheet();
                $data['name'] = $this->slug.'-'.$child_theme.'['.$id.']';
            }

            if(isset($this->value[$id]))
                $data['value'] = $this->value[$id];
            else    
                $data['value'] = null;

            $data['type'] = $type;
            $data['args'] = $args;
            $data['description'] = $description;

            add_settings_field(
                $id,
                $name,
                array(&$this, 'sanitize'), 
                'ef-framework-'.$this->slug,
                $this->slug.$section_id,
                $data
            );

        });

        array_push($this->fields, array($id => $default_value));
        
    }


    public function render() {

        wp_enqueue_style( 'bootstrap-grid' );

        echo '<form method="post" action="options.php">';
       
            echo '<div class="enfi-admin-page-head">';
                echo '<div class="container-fluid">';
                    echo '<div class="row">';
                        echo '<div class="col-lg-12">';

                            echo '<div class="title-description">';
                                echo '<h1>'.__($this->name).'</h1>';
                                echo '<p>'.__($this->description).'</p>';
                            echo '</div>';

                        echo '</div>';
                    echo '</div>';   
                echo '</div>';
            echo '</div>';

            echo '<div class="container-fluid"><div class="row">';

                echo '<div class="col-lg-2">';

                    do_action('ef-admin-navigation');

                echo '</div>';

                echo '<div class="col-lg-8">';
                        echo '<div class="enfi-admin-page-content enfi-admin-form-settings-page">';
                        settings_fields ($this->slug);
                        do_settings_sections ('ef-framework-'.$this->slug);
                        do_action('ef-framework-content-'.$this->slug);
                    echo '</div>';
                    
            echo '<div class="enfi-admin-page-footer">';
            submit_button();
         echo '</div>';
                echo '</div>';

            echo '</div></div>';

        echo '</form>';
    }

    public function sanitize($args) {

        $name          = $args['name'];
        $id            = $args['name'];
        $value         = $args['value'];
        $description   = $args['description'];
        $type          = $args['type'];
        $data          = $args['args'];

        # placeholder
        if(isset($data['placeholder']))
            $placeholder = $data['placeholder'];
        else    
            $placeholder = __('Insert text here...', 'ef');

        $sanitized_field_template = get_template_directory() . "/core/fields/".$type.".php";

        if(file_exists($sanitized_field_template)) {
            $output = '';
            require $sanitized_field_template;    

            if($description != null)
                $output .= '<p class="description">'.$description.'</p>';

            echo $output;   
        } 

    }

    public function setDefaultValues() {

        if(!is_array($this->value)) {
            $__fields = array();

            foreach($this->fields as $field) {
                foreach($field as $key => $value) {
                    $__fields[$key] = $value;
                }
            }

            add_option($this->slug, $__fields);
        }
    }

    public function debug() {
    }
}

function parseOptions($args) {

    if(isset($args['options'])) {
        return $args['options'];

    } else if(isset( $args['taxonomy'])) {
        $terms = get_terms( $args['taxonomy'], array('hide_empty' => false,) );
        return $terms;
        
    } else if (isset( $args['posts'])) {
        $posts = get_posts(['post_type' => $args['posts'],'post_status' => 'publish','numberposts' => -1]);
        return $posts;

    } else if(isset( $args['post_types'])) {
        $post_types = get_post_types([ '_builtin' => false]);
        $include = array('page');
        $exclude = array('wpcf7_contact_form', 'tribe-ea-record');

        if(isset($args['exclude_post_types']))
            $include = array_diff($include, $args['exclude_post_types']);

        return array_diff($include+$post_types, $exclude);
    }
}



$settings_page = new EF_Settings_Page('settings', __('Settings', 'ef'), __('Settings', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'settings', null, 1);

$options = array(
    array( 'text' =>  '30', 'value' => 30),
    array( 'text' =>  '60', 'value' => 60),
    array( 'text' =>  '90', 'value' => 90),
    array( 'text' =>  '90', 'value' => 90),
    array( 'text' =>  '90', 'value' => 90),
    array( 'text' =>  '90', 'value' => 90),
    array( 'text' =>  '90', 'value' => 90)
);


$settings_page->addSection(1, 'Settings');

$settings_page->addField(1, 'textbox', 'Text', null, 'text');
$settings_page->addField(1, 'ttretextbox', 'Text', null, 'text');
$settings_page->addField(1, 'texttrebox', 'Text', null, 'text');
$settings_page->addField(1, 'tex432box', 'Text', null, 'text');
$settings_page->addField(1, 'textb42ox', 'Text', null, 'text');
$settings_page->addField(1, 'te66xtbox', 'Text', null, 'text');

$settings_page->addField(1, 'selection', 'Selection', null, 'selection', '', array('options' => $options));

$settings_page->addField(1, 'selection-post-types', 'Selection Group', null, 'selection', null, array('post_types' => get_post_types()));

$settings_page->addField(1, 'checkbox', 'Checkbox', null, 'checkbox', null, array('checkboxText' => 'test'));

$settings_page->addField(1, 'checkbox-group-options', 'Checkbox-Group Options', null, 'checkbox-group', null, array('options' => $options));

$settings_page->addField(1, 'checkbox-group-post-types', 'Checkbox-Group Post-Types', null, 'checkbox-group', null, array( 'post_types' => get_post_types()));

$settings_page->addField(1, 'checkbox-group-posts', 'Checkbox-Group Posts', null, 'checkbox-group', null, array( 'posts' => 'page'));

$settings_page->addField(1, 'list', 'Liste', null, 'list', null);

$settings_page->addField(1, 'color-picker', 'Color-Picker', null, 'color-picker',  null);

$settings_page->addField(1, 'image', 'Image', null, 'image', null);

$settings_page->addField(1, 'button-group', 'Button group', null, 'text-align', 'left');

$settings_page->addField(1, 'button-group245156156', 'Button group', null, 'button-group', null, array( 'options' => $options ));

$settings_page->addField(1, 'button-group245156gtre156', 'Button group', null, 'button-group', null, array( 'options' => $options, 'vertical' => true ));