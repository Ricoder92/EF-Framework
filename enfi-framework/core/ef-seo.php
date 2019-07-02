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
$seo_page = new EF_Settings_Page('ef-seo', __('SEARCH_ENGINE_OPTIMIZATION', 'ef'), __('SEARCH_ENGINE_OPTIMIZATION', 'ef'), __('SEARCH_ENGINE_OPTIMIZATION_DESCRIPTION', 'ef'), 'settings', 'fa-search-dollar', 2);

## settinfs for post type and other stuff
$seo_page->addSection('settings', __('SEARCH_ENGINE_OPTIMIZATION', 'ef'));
$seo_page->addField('settings', 'post-types', __('POST_TYPES', 'ef'), __('POST_TYPES_DESCRIPTION', 'ef'), 'checkbox-group', null, array( 'post_types' => get_post_types()));
$seo_page->addField('settings', 'no-index', __('NO_INDEX', 'ef'), __('NO_INDEX_DESCRIPTION', 'ef'), 'checkbox', null, array('checkboxText' => __('No-Index', 'ef')));

$seo_page->addSection('sitemap', __('SEARCH_ENGINE_OPTIMIZATION_SITEMAP', 'ef'));
$seo_page->addField('sitemap', 'post-types-sitemap', __('POST_TYPES', 'ef'), __('POST_TYPES_DESCRIPTION', 'ef'), 'checkbox-group', null, array( 'post_types' => get_post_types()));

$option = ef_get_option('ef-seo');

if(array_key_exists('post-types-sitemap', $option)) {

    foreach($option['post-types-sitemap'] as $post_type) {

        $_cpt = get_post_type_object($post_type);
        $_post_type_label = $_cpt->labels->name;

        $prio = array(
            array( 'text' =>  '0.1', 'value' => '0.1'),
            array( 'text' =>  '0.2', 'value' => '0.2'),
            array( 'text' =>  '0.3', 'value' => '0.3'),
            array( 'text' =>  '0.4', 'value' => '0.4'),
            array( 'text' =>  '0.5', 'value' => '0.5'),
            array( 'text' =>  '0.6', 'value' => '0.6'),
            array( 'text' =>  '0.7', 'value' => '0.7'),
            array( 'text' =>  '0.8', 'value' => '0.8'),
            array( 'text' =>  '0.9', 'value' => '0.9'),
            array( 'text' =>  '1.0', 'value' => '1.0'),
        );

        $seo_page->addField('sitemap', 'sitemap-prio-'.$post_type, __('SITEMAP_PRIO_FOR', 'ef').' '.__($_post_type_label), null, 'button-group', '|', array( 'options' => $prio ));
    }

    foreach($option['post-types-sitemap'] as $post_type) {

        $_cpt = get_post_type_object($post_type);
        $_post_type_label = $_cpt->labels->name;

        $frequence = array(
            array( 'text' =>  'daily', 'value' => 'daily'),
            array( 'text' =>  'weekly', 'value' => 'weekly'),
            array( 'text' =>  'monthly', 'value' => 'monthly'),
            array( 'text' =>  'yearly', 'value' => 'yearly'),
        );

        $seo_page->addField('sitemap', 'sitemap-changefrequence-'.$post_type, __('SITEMAP_FREQUENCE_FOR', 'ef').' '.__($_post_type_label), null, 'button-group', '|', array( 'options' => $frequence ));
    }

}

## global meta tags
$seo_page->addSection('seo-tags', __('SEARCH_ENGINE_OPTIMIZATION', 'ef'));
$seo_page->addField('seo-tags', 'global-title-seperator', __('TITLE_SEPERATOR', 'ef'), null, 'button-group', '|', array( 'options' => $title_seperators ));
$seo_page->addField('seo-tags', 'global-title-style', __('TITLE_STYLE', 'ef'), null, 'button-group', 'left', array( 'options' => $title_style ));
$seo_page->addField('seo-tags', 'global-keywords', __('KEYWORDS', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-description', __('DESCRIPTION', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-topic', __('TOPIC', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-author', __('POST_AUTHOR_NAME', 'ef'), null, 'text', 'Enrico Fischer');
$seo_page->addField('seo-tags', 'global-designer', __('DESIGNER', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-copyright', __('COPYRIGHT', 'ef'), null, 'text', null);
$seo_page->addField('seo-tags', 'global-disable-seo-meta', __('DISABLE_SEO_META_TAGS', 'ef'), null, 'checkbox-group', null, array( 'options' => $disable_meta_tags));

## set defaults
$seo_page->setDefaultValues();

## get option data
$option_data = ef_get_option('ef-seo');

## enable for post types
if(is_array($option_data) && array_key_exists('post-types', $option_data)) {
    
    ## get post types
    $post_types = $option_data['post-types'];   
 
    ## create meta box for post types
    $meta = new EF_Metabox('ef-seo-meta-data', __('SEO', 'ef'), $post_types);
    $meta->addField('seo-disable', __('DISABLE_SEO_META', 'ef'), __('DISABLE_SEO_META_DESCRIPTION', 'ef'), 'checkbox', array('checkboxText' => __('DISABLE_SEO_META_CHECKBOXTEXT', 'ef')));
    $meta->addField('seo-no-index', __('NO_INDEX', 'ef'), __('NO_INDEX_DESCRIPTION', 'ef'), 'checkbox', array('checkboxText' => __('Stop search engines from crawling this post', 'ef')));
    $meta->addField('seo-title', __('POST_TITLE', 'ef'), __('POST_TITLE_DESCRIPTION', 'ef'), 'text');
    $meta->addField('seo-description', __('POST_DESCRIPTION', 'ef'), __('POST_DESCRIPTION_DESCRIPTION'), 'text');
    $meta->addField('seo-keywords', __('KEYWORDS', 'ef'), __('KEYWORDS_DESCRIPTION', 'ef'), 'text');
    $meta->addField('seo-topic', __('TOPIC', 'ef'), __('TOPIC_DESCRIPTION', 'ef'), 'text');
    $meta->addField('seo-author', __('POST_AUTHOR_NAME', 'ef'), __('POST_AUTHOR_NAME_DESCRIPTION', 'ef'), 'text');
    $meta->addField('seo-designer', __('DESIGNER', 'ef'), __('DESIGNER_DESCRIPTION', 'ef'), 'text');
    $meta->addField('seo-copyright', __('COPYRIGHT', 'ef'), __('COPYRIGHT_DESCRIPTION', 'ef'), 'text');
    $meta->addField('seo-disable-seo-meta', __('DISABLE_SEO_META_TAGS', 'ef'), __('DISABLE_SEO_META_TAGS_DESCRIPTION', 'ef'), 'checkbox-group', array( 'options' => $disable_meta_tags));
}

# is seo for post type active?
function check_post_type_enable() {

    $option = ef_get_option('ef-seo', array());
 
    $post_type = get_post_type();

    if(is_array($option) && array_key_exists('post-types', $option) && is_array($option['post-types']))
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
### add seo meta tags to wp_head 
##################################################################################################################################################

add_action('wp_head', function() {

    # if seo meta tags enable for current post type and check if enable for current post
    if(check_post_type_enable() && check_post_enable()) {
        
        ## get post meta
        $meta_data = get_post_meta(get_the_id(), 'ef-seo-meta-data', true);

        ## if null, set to empty array
        if(!is_array($meta_data))
            $meta_data = array();
    
        # get ef global settings
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

            
        ef_html_comment('SEO');
          
        # set (no)follow
        if(isset($meta_data['seo-no-index']) || isset($option['no-index']))
            echo "<meta name=\"robots\" content=\"noindex,nofollow\">\n";
        else
            echo "<meta name=\"robots\" content=\"index,follow\">\n";
            
        # set array with meta name parameters
        $meta_tags = array('keywords', 'description', 'topic', 'author', 'designer', 'copyright');
        
        # for each meta 
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
                            echo "<meta name=\"keywords\" content=\"".$meta."\"/>\n";
                        else if($options)
                            echo "<meta name=\"keywords\" content=\"".$options."\"/>\n";

                    } else {

                        if($meta)
                            echo "<meta name=\"".$meta_tag."\" content=\"".$meta."\"/>\n";
                        else if($options)
                            echo "<meta name=\"".$meta_tag."\" content=\"".$options."\"/>\n";

                    }
                }
            }
        }
    }
}, -1);


################################################################################################################################################## 
### set WP_TITLE
##################################################################################################################################################



################################################################################################################################################## 
### add title tag
##################################################################################################################################################

add_action('wp_head', function() {
    
    ef_html_comment('Title');

    if(!ef_maintenance_mode_is_active()) {

     
        if(is_front_page() || is_home()) 
            $title = get_bloginfo('name');
        else 
            $title = wp_title('|', false, 'right').get_bloginfo('name'); 

        echo "<title>".$title."</title>\n";

    }   
    
},-99);

################################################################################################################################################## 
### canonical url
##################################################################################################################################################

#add_filter( 'get_canonical_url', 'filter_function_name_4269', 10, 2 );
function filter_function_name_4269( $canonical_url, $post ){
    ef_html_comment('Cannnial URL and Shortlink');
	$canonical_url = $canonical_url;

	return $canonical_url;
}

################################################################################################################################################## 
### create sitemap
##################################################################################################################################################

# set sitemap on new posts
if(is_array($option['post-types-sitemap'])) {

    foreach($option['post-types-sitemap'] as $post_type) {
       add_action( 'publish_'.$post_type, 'ef_seo_create_sitemap' );

   }

}

# create sitemap with new post
function ef_seo_create_sitemap() {

    $option = ef_get_option('ef-seo');

    if(array_key_exists('post-types-sitemap', $option)) {

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach($option['post-types-sitemap'] as $post_type) {
            
            $postsForSitemap = get_posts(array(
                'numberposts' => -1,
                'orderby' => 'modified',
                'post_type'  =>  $post_type,
                'order'    => 'DESC'
            ));

            if(array_key_exists('sitemap-prio-'.$post_type, $option))
                $priority = $option['sitemap-prio-'.$post_type];
            else    
                $priority = 0.8;

            if(array_key_exists('sitemap-changefrequence-'.$post_type, $option))
                $frequence = $option['sitemap-changefrequence-'.$post_type];
            else    
                $frequence = 'monthly';


            foreach( $postsForSitemap as $post ) {
                setup_postdata( $post );
                
                $postdate = explode( " ", $post->post_modified );
                
                $sitemap .= '<url>'.
                '<loc>' . get_permalink( $post->ID ) . '</loc>' .
                '<lastmod>' . $postdate[0] . '</lastmod>' .
                '<changefreq>'.$frequence.'</changefreq>' .
                '<priority>'.$priority.'</priority>' .
                '</url>';
            }
            
        }
            
        $sitemap .= '</urlset>';
        
    } else 

        $sitemap = null;
    
    $fp = fopen( ABSPATH . 'sitemap.xml', 'w' );
        
    fwrite( $fp, $sitemap );
    fclose( $fp );

    add_filter('robots_txt', 'wpse_248124_robots_txt', 10,  2);
}

################################################################################################################################################## 
### robots.txt
##################################################################################################################################################

function wpse_248124_robots_txt($output, $public) {
    $output = "# EF Framework robots.txt\n";
    $output .= "\nSitemap: ".site_url()."/sitemap.xml";
    return $output;
}
    
    ?>