<?php

################################################################################################################################################## 
### admin navigation stuff
##################################################################################################################################################

class EF_Admin_Navigation {

    # constructor
    public function __construct($id, $name, $icon = '',  $prio = 99) {

        #vars
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->prio = $prio;
      
        # set icon
        if($this->icon == '')
            $this->icon = 'fa-cog';

        # render navigation cards
        $this->render_navigation();
    }

    # navigation
    public function render_navigation() {

        $id = $this->id;
        $name = $this->name;
    
        # sidebar on settings page
        add_action('ef-admin-navigation', function() use ($id, $name) {

            echo '<div class="ef-framework-admin-navigation">';
            
                echo '<div class="head">'.__($name, 'ef').'</div>';
                
                echo '<ul class="navigation">';
                    do_action('ef-admin-navigation-'.$id);
                echo '</ul>';

            echo '</div>';
            
        });

        # mainpage ef framework
        add_action('ef-admin-navigation-main-page', function() use ($id, $name) {

            do_action('ef-admin-navigation-main-page-'.$id);

        });
    }
}

################################################################################################################################################## 
### navigation categories
##################################################################################################################################################

new EF_Admin_Navigation('settings', __('SETTINGS', 'ef'),   '', 0);
new EF_Admin_Navigation('layout', __('LAYOUT', 'ef'),     '', 1);
new EF_Admin_Navigation('post-types', __('POST_TYPES', 'ef'), '', 2);
new EF_Admin_Navigation('texonomies', __('TAXONOMIES', 'ef'),    '', 3);
new EF_Admin_Navigation('modules', __('MODULES', 'ef'),    '', 3);