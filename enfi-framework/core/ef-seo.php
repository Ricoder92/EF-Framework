<?php

################################################################################################################################################## 
### seo
##################################################################################################################################################

## get post meta
$meta_data = get_post_meta(get_the_id(), 'ef-seo-meta-data', true);

## if null, set to empty array
if(!is_array($meta_data))
    $meta_data = array();

$option = ef_get_option('seo');
 
$disable_meta_tags = array(
    array( 'key' => 'description' ,'text' =>  __('Description', 'ef'), 'value' => true),
    array( 'key' => 'keywords' ,'text' =>  __('Keywords', 'ef'), 'value' => true),
    array( 'key' => 'topic' ,'text' =>  __('Topic', 'ef'), 'value' => true),
    array( 'key' => 'web-author' ,'text' =>  __('Post Author Name', 'ef'), 'value' => true),
    array( 'key' => 'web-author-email' ,'text' =>  __('Post Author Email', 'ef'), 'value' => true),
    array( 'key' => 'web-designer' ,'text' =>  __('Designer', 'ef'), 'value' => true),
    array( 'key' => 'copyright' ,'text' =>  __('Copyright', 'ef'), 'value' => true)
);
 
$title_seperators = array(
    array( 'text' =>  '|', 'value' => '|'),
    array( 'text' =>  '-', 'value' => '-'),
    array( 'text' =>  '~', 'value' => '~'),
    array( 'text' =>  '+', 'value' => '+'),
    array( 'text' =>  '>', 'value' => '>'),
    array( 'text' =>  '<', 'value' => '<'),
    array( 'text' =>  ':', 'value' => ':'),
);

$title_sep = $option['global-title-seperator'];
$title_style = array(
    array( 'text' =>  get_bloginfo('name').' '.$title_sep.' '.__('{Post name}', 'ef'), 'value' => 'left'),
    array( 'text' =>  __('{Post name}', 'ef').' '.$title_sep.' '.get_bloginfo('name'), 'value' => 'right'),
);

## add module page
$seo_page = new EF_Settings_Page('ef-seo', __('Search Engine Optimization', 'ef'), __('Search Engine Optimization', 'ef'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'ef'), 'settings', 'fa-search-dollar', 2);

## settinfs for post type and other stuff
$seo_page->addSection('settings', __('Search Machine Optimization', 'ef'));
$seo_page->addField('settings', 'post-types', __('Post Types', 'ef'), null, 'checkbox-group', null, array( 'post_types' => get_post_types()));
$seo_page->addField('settings', 'no-index', __('No-Index', 'ef'), null, 'checkbox', null, array('checkboxText' => __('No-Index', 'ef')));

## global meta tags
$seo_page->addSection('seo-tags', __('Search Machine Optimization', 'ef'));
$seo_page->addField('seo-tags', 'global-title-seperator', __('Title Seperator', 'ef'), null, 'button-group', '|', array( 'options' => $title_seperators ));
$seo_page->addField('seo-tags', 'global-title-style', __('Title Seperator', 'ef'), null, 'button-group', 'left', array( 'options' => $title_style ));
$seo_page->addField('seo-tags', 'global-keywords', __('Keywords', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-description', __('Description', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-topic', __('Topic', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-author', __('Post Author Name', 'ef'), null, 'text', 'Enrico Fischer');
$seo_page->addField('seo-tags', 'global-designer', __('Designer', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-copyright', __('Copyright', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-disable-seo-meta', __('Disable SEO Meta Tags', 'ef'), null, 'checkbox-group', null, array( 'options' => $disable_meta_tags));

## set defaults
$seo_page->setDefaultValues();

## type options for "type" meta tag
$typeOptions = array(
    array( 'key' => 'movie', 'text' =>  __('Movie', 'ef'), 'value' => 'movie'),
    array( 'key' => 'audio','text' =>  __('Audio', 'ef'), 'value' => 'Audio'),
    array( 'key' => 'article','text' =>  __('Article', 'ef'), 'value' => 'article'),
);

## get option data
$option_data = ef_get_option('ef-seo');

## enable for post types
if(array_key_exists('post-types', $option_data)) {
    
    ## get post types
    $post_types = $option_data['post-types'];   
 
    ## create meta box for post types
    $meta = new EF_Metabox('ef-seo-meta-data', __('SEO', 'ef'), $post_types);
    $meta->addField('seo-disable', __('Disable', 'ef'), 'Aktivieren, um die Suchmaschinenoptimierung für diese Seite/Beitrag auszuschalten.', 'checkbox', array('checkboxText' => __('Disable SEO for this post', 'ef')));
    $meta->addField('seo-no-index', __('No-Index', 'ef'), 'Aktivieren, um Suchmaschinen davon abzuhalten, diesen Beitrag/Seite zu indexieren.', 'checkbox', array('checkboxText' => __('Stop search engines from crawling this post', 'ef')));
    $meta->addField('seo-title', __('Post title', 'ef'), __('Overwrite post title', 'ef'), 'text');
    $meta->addField('seo-description', __('Post description', 'ef'), __('Post description'), 'text');
    $meta->addField('seo-keywords', __('Keywords', 'ef'), 'Keywörter für diesen Beitrag angeben', 'text');
    $meta->addField('seo-topic', __('Topic', 'ef'), __('Topic', 'ef'), 'text');
    $meta->addField('seo-author', __('Web Author Name', 'ef'), __('Web Author', 'ef'), 'text');
    $meta->addField('seo-designer', __('Webdesigner', 'ef'), __('Webdesigner', 'ef'), 'text');
    $meta->addField('seo-copyright', __('Copyright', 'ef'), __('Copyright', 'ef'), 'text');
    $meta->addField('seo-disable-seo-meta', __('Disable SEO Meta Tags', 'ef'), __('Copyright', 'ef'), 'checkbox-group', array( 'options' => $disable_meta_tags));
}

# is seo for post type active?
function check_post_type_enable() {

    $option = ef_get_option('ef-seo', array());
 
    $post_type = get_post_type();

    if(array_key_exists('post-types', $option) && is_array($option['post-types']))
        return in_array($post_type, $option['post-types']);

}

################################################################################################################################################## 
### check if for post type enable
##################################################################################################################################################

function check_post_enable() {

    $meta_data = get_post_meta(get_the_id(), 'ef-seo-meta-data', array());

    if(is_array($meta_data) && array_key_exists('seo-disable', $meta_data))
        return false;
    else        
        return true;

}

################################################################################################################################################## 
### check if meta tag globally disable
##################################################################################################################################################

function check_meta_tag_disable($global_disable_seo_meta, $key) {
    if(is_array($global_disable_seo_meta) && array_key_exists($key, $global_disable_seo_meta)) {
        return false;
    } else 
        return true;
}

################################################################################################################################################## 
### loop
##################################################################################################################################################

function seo_add_wp_head() {

    if(check_post_type_enable() && check_post_enable()) {
        
        ## get post meta
        $meta_data = get_post_meta(get_the_id(), 'ef-seo-meta-data', true);

        ## if null, set to empty array
        if(!is_array($meta_data))
            $meta_data = array();
        

         $option = ef_get_option('ef-seo');


        ## check disable seo meta tags
        if(array_key_exists('global-disable-seo-meta', $option))
            $global_disable_seo_meta = $option['global-disable-seo-meta'];
        else 
            $global_disable_seo_meta = array();

        if(array_key_exists('seo-disable-seo-meta', $meta_data))
            $meta_disable_seo_meta = $meta_data['seo-disable-seo-meta'];
        else 
            $meta_disable_seo_meta = array();

        $meta_tags = array('keywords', 'description', 'topic', 'author', 'designer', 'copyright');

        ef_html_comment('SEO');

        if(isset($meta_data['seo-no-index']))
           echo "\t<meta name=\"robots\" content=\"noindex,nofollow\">\n";

        foreach($meta_tags as $meta_tag) {

            if(isset($meta_data['seo-'.$meta_tag]))
                $meta = $meta_data['seo-'.$meta_tag];
            else    
                $meta = null;

            $options = $option['global-'.$meta_tag];

            if(!(is_array($meta_disable_seo_meta) && array_key_exists($meta_tag, $meta_disable_seo_meta)) ) {

                if(!(is_array($global_disable_seo_meta) && array_key_exists($meta_tag, $global_disable_seo_meta)) ) {

                    if($meta_tag == 'keywords') {

                        if($meta != '' && $options != '')
                            $meta .= ', '.$options;

                        if($meta)
                            echo "\t<meta name=\"keywords\" content=\"".$meta."\"/>\n";
                        else if($options)
                            echo "\t<meta name=\"keywords\" content=\"".$options."\"/>\n";

                    } else {

                        if($meta)
                            echo "\t<meta name=\"".$meta_tag."\" content=\"".$meta."\"/>\n";
                        else if($options)
                            echo "\t<meta name=\"".$meta_tag."\" content=\"".$options."\"/>\n";
                    }
                }
            }
        }
    }
}

add_action('wp_head', 'seo_add_wp_head', -1);


################################################################################################################################################## 
### set WP_TITLE
##################################################################################################################################################

function wpdocs_filter_wp_title( $title, $sep ) {
    global $paged, $page;
 
    if (is_category()) {
        $category = get_category(get_query_var('cat'));
        $cat_id = $category->cat_ID;
        return get_cat_name($cat_id).' '.$sep.' ';
    } else if (is_tag()) {
        global $wp_query;
        $term = $wp_query->get_queried_object();
        return $term->name.' '.$sep.' ';
    } else if(is_single() || is_page()) {
       return get_the_title().' '.$sep.' ';
   } else if(is_archive() && !is_tax()) {
        return post_type_archive_title('', true).' '.$sep.' ';
    } else if(is_tax()) {
        global $wp_query;
        $term = $wp_query->get_queried_object();
        return $term->name.' '.$sep.' ';
    } else if(is_home())
        return get_bloginfo('name');
    else if(is_front_page())
        return get_bloginfo('name');

    ## get post meta
    $meta_data = get_post_meta(get_the_id(), 'ef-seo-meta-data', true);

    ## if null, set to empty array
    if(!is_array($meta_data)) 
        $meta_data = array();

    if(array_key_exists('seo-title', $meta_data) && $meta_data['seo-title'] != '') {
        return $meta_data['seo-title'].' '.$sep.' ';
    } else {
        return get_the_title().' '.$sep.' ';
    }
 
}
#add_filter( 'wp_title', 'wpdocs_filter_wp_title', 10, 2 );


?>