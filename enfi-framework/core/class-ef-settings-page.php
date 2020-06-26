<?php

################################################################################################################################################## 
### Class for creating plugin page
##################################################################################################################################################

class EF_Settings_Page {

    # constructur
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

        if (isset($_POST[ef_get_settings_slug($this->slug)])) {
            $save = $_POST[ef_get_settings_slug($this->slug)];
            $this->value = $save;
            #echo '<pre>';
            #echo print_r($this->value);
            #echo '</pre>';
            update_option(ef_get_settings_slug($this->slug), $save);
            $this->message = '<div class="ef-dashboard-message-success">'.__('SAVE_SUCCESS', 'ef').'</div>';
        } else {
            $this->value = ef_get_option($this->slug, 'empty');
        }

        # set menu name if empty
        if($this->menuName == '')
            $this->menuName = $this->name;

        # set menu name if empty
        if($this->menu == '')
            $this->menuName = 'settings';

        # set icon
        if($this->icon == '')
            $this->icon = 'fa-cog';

        # add admin menu page
        add_action( 'admin_menu', function() {

            add_submenu_page( 
                null,                           # Parent Page
                $this->name,                    # Title
                $this->menuName,                # MenuName
                $this->capability,              # Capability
                $this->slug,                    # Slug
                array(&$this, 'render')         # Callback
            );

        }, $this->prio );

        # add settings page to side navigation
        add_action('ef-admin-navigation-'.$this->menu, function() {

            if($_GET['page'] == $this->slug)
                $css = 'active';
            else    
                $css = null;
    
            echo '<li><a href="'.admin_url('/admin.php?page='.$this->slug).'" class="'.$css.'"><i class="icon fas '.$this->icon.' fa-1x"></i> '.__($this->menuName, 'ef').'</a></li>';

        }, $this->prio);

        # add settings page to main navigation
        add_action('ef-admin-navigation-main-page-'.$this->menu, function() {

            $url = admin_url("/admin.php?page=".$this->slug);
        
           
                echo '<div onclick="location.href=\''.$url.'\';" class="ef-dashboard-card">';
                    echo '<div class="icon"><i class="icon fas '.$this->icon.' fa-3x"></i></div>';
                    echo '<div class="title"><h3> '.__($this->menuName, 'ef').'</h3></div>';
                    #echo '<div class="text"><p>'.__($this->description, 'ef').'</p></div>';
                echo '</div>';
  
        }, $this->prio);

        # add setitngs page to admin menu bar
        add_action('admin_bar_menu', function() {

            global $wp_admin_bar;
        
            $menu_id = 'ef-framework';
            $wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' =>  __($this->menuName, 'ef'), 'id' =>  $this->slug, 'href' => '/wp-admin/admin.php?page='.$this->slug));
        
        }, $this->prio);
      

    }

    # register page
    public function addSection($id, $title) {

        add_action('admin_init', function() use ($id, $title) {

            add_action('ef-admin-settings-section-'.$this->slug, function() use ($id, $title) {
                
                echo '<div class="section-field">';

                    echo '<div class="head ef-toggle-settings-section">'.__($title, 'ef').'</div>';

                    echo '<div class="content" id="section-'.$id.'">';
                        do_action('ef-admin-settings-sectionsfields-'.$id);
                    echo '</div>';
                      
                echo '</div>';
            });


        });
       
    }

    public function addContent($section_id, $function) {

        add_action($this->slug, function() use ($function) {
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
            $data['description'] = __($description, 'ef');

            add_action('ef-admin-settings-sectionsfields-'.$section_id, function() use ($data, $name){

                echo '<div class="field">';
                
                    echo '<div class="label">';
                        echo '<label for="'.$data['name'].'">'.__($name, 'ef').'</label>';
                    echo '</div>';

                    echo '<div class="input">';
                        $this->sanitize($data);
                    echo '</div>';
                    
                echo '</div>';
              
               
            });

           

        });

        array_push($this->fields, array($id => $default_value));
        
    }

    public function render() {

        echo '<form method="post">';

            echo '<div class="ef-dashboard-head">';    
                echo '<div class="title-description">';
                    echo '<h3>'.__($this->name, 'ef').'</h3>';
                    echo '<p>'.__($this->description, 'ef').'</p>';
                echo '</div>';
            echo '</div>';

           

            echo '<div class="ef-dashboard-content">';
                echo '<div class="ef-dashboard-settings-page">';
            
                    echo '<div class="navigation">';
                        do_action('ef-admin-navigation');
                        echo '<input type="submit" value="Save" class="ef-dashboard-settings-page-submit" name="ef-save-settings">';
                    echo '</div>';

                    echo '<div class="content">';

                        if(isset($this->message))
                            echo $this->message;

                        do_action('ef-admin-settings-section-'.$this->slug);
                    echo '</div>';
                echo '</div>';

            echo '</div>';

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
            $placeholder = __('INSERT_TEXT_HERE', 'ef');

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
        $include = array('page', 'post');
        $exclude = array('wpcf7_contact_form', 'tribe-ea-record');

        if(isset($args['exclude_post_types']))
            $include = array_diff($include, $args['exclude_post_types']);

        return array_diff($include+$post_types, $exclude);
    }
}

################################################################################################################################################## 
### example settings page
##################################################################################################################################################

#$settings_page = new EF_Settings_Page('settings2', __('SETTINGS_TEMPLATE', 'ef'), __('SETTINGS_TEMPLATE', 'ef'), __('SETTINGS_DESCRIPTION', 'ef'), 'settings', null, 1);

#$options = array(
#    array( 'text' =>  '30', 'value' => 30),
#    array( 'text' =>  '60', 'value' => 60),
#    array( 'text' =>  '90', 'value' => 90),
#    array( 'text' =>  '90', 'value' => 90),
#    array( 'text' =>  '90', 'value' => 90),
#    array( 'text' =>  '90', 'value' => 90),
#    array( 'text' =>  '90', 'value' => 90)
#);

#$settings_page->addSection(1, __('SETTINGS', 'ef'));
#$settings_page->addField(1, 'textbox', 'Text', null, 'text');
#$settings_page->addField(1, 'ttretextbox', 'Text', null, 'text');
#$settings_page->addField(1, 'texttrebox', 'Text', null, 'text');
#$settings_page->addField(1, 'tex432box', 'Text', null, 'text');
#$settings_page->addField(1, 'textb42ox', 'Text', null, 'text');
#$settings_page->addField(1, 'te66xtbox', 'Text', null, 'text');
#$settings_page->addField(1, 'selection', 'Selection', null, 'selection', '', array('options' => $options));
#$settings_page->addField(1, 'selection-post-types', 'Selection Group', null, 'selection', null, array('post_types' => get_post_types()));
#$settings_page->addField(1, 'checkbox', 'Checkbox', null, 'checkbox', null, array('checkboxText' => 'test'));
#$settings_page->addField(1, 'checkbox-group-options', 'Checkbox-Group Options', null, 'checkbox-group', null, array('options' => $options));
#$settings_page->addField(1, 'checkbox-group-post-types', 'Checkbox-Group Post-Types', null, 'checkbox-group', null, array( 'post_types' => get_post_types()));
#$settings_page->addField(1, 'checkbox-group-posts', 'Checkbox-Group Posts', null, 'checkbox-group', null, array( 'posts' => 'page'));
#$settings_page->addField(1, 'list', 'Liste', null, 'list', null);
#$settings_page->addField(1, 'color-picker', 'Color-Picker', null, 'color-picker',  null);
#$settings_page->addField(1, 'image', 'Image', null, 'image', null);
#$settings_page->addField(1, 'button-group', 'Button group', null, 'text-align', 'left');
#$settings_page->addField(1, 'button-group245156156', 'Button group', null, 'button-group', null, array( 'options' => $options ));
#$settings_page->addField(1, 'button-group245156gtre156', 'Button group', null, 'button-group', null, array( 'options' => $options, 'vertical' => true ));