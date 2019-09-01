<?php

################################################################################################################################################## 
### SOCIAL_MEDIA
##################################################################################################################################################

$social_media_page = new EF_Settings_Page('ef-social-media', __('SOCIAL_MEDIA', 'ef'), __('SOCIAL_MEDIA', 'ef'), __('SOCIA_MEDIA_DESCRIPTION', 'ef'), 'settings', 'fa-hashtag', 3);

# SOCIAL_MEDIA enable for post-types
$social_media_page->addSection('og-post-types', __('SOCIAL_MEDIA', 'ef'));
$social_media_page->addField('og-post-types', 'post-types', __('POST_TYPES', 'ef'), __('POST_TYPES_DESCRIPTION', 'ef'), 'checkbox-group', null, array( 'post_types' => get_post_types()));

# SOCIAL_MEDIA channels
$social_media_page->addSection('social-media-channels', __('SOCIAL_MEDIA_CHANELS', 'ef'));
$social_media_page->addField('social-media-channels', 'facebook', __('FACEBOOK_SITE_ID', 'ef'), null, 'text', null);
$social_media_page->addField('social-media-channels', 'youtube', __('YOUTUBE_CHANNEL_ID', 'ef'), null, 'text', null);
$social_media_page->addField('social-media-channels', 'twitter', __('TWITTER_ID', 'ef'), null, 'text');
$social_media_page->addField('social-media-channels', 'instagram', __('INSTAGRAM_ID', 'ef'), null, 'text', null);

# article type options
$typeOptions = array(
    array( 'text' =>  __('MOVIE', 'ef'), 'value' => 'movie'),
    array( 'text' =>  __('AUDIO', 'ef'), 'value' => 'audio'),
    array( 'text' =>  __('ARTICLE', 'ef'), 'value' => 'article'),
    array( 'text' =>  __('ACTOR', 'ef'), 'value' => 'actor'),
    array( 'text' =>  __('WEBSITE', 'ef'), 'value' => 'website'),
);

# SOCIAL_MEDIA global tags
$social_media_page->addSection('og-tags', __('OPENGRAPH_META_TAGS', 'ef'));
$social_media_page->addField('og-tags', 'title', __('TITLE', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'type', __('TYPE', 'ef'), null, 'selection', null, array('options' => $typeOptions));
$social_media_page->addField('og-tags', 'image', __('IMAGE', 'ef'), null, 'image', null);
$social_media_page->addField('og-tags', 'site-name', __('SITE_NAME', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'site-description', __('SITE_DESCRIPTION', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'email', __('E-MAIL', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'phone', __('PHONE_NUMBER', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'fax', __('FAX_NUMBER', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'latitude', __('LATITUDE', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'longitude', __('LONGITUDE', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'street', __('STREET', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'zip', __('ZIP_CODE', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'city', __('CITY', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'region', __('REGION', 'ef'), null, 'text', null);
$social_media_page->addField('og-tags', 'country', __('LAND', 'ef'), null, 'text', null);

# set defaults
$social_media_page->setDefaultValues();

# get option data
$option = ef_get_option('ef-social-media');

# enable for post types
if(is_array($option) && array_key_exists('post-types', $option)) {

    # get post types
    $post_types = $option['post-types'];   

    # create meta box for post types
    $meta = new EF_Metabox('ef-social-media-meta', __('SOCIAL_MEDIA', 'ef'), $post_types);
    $meta->addField('og-disable', __('SOCIAL_MEDIA_DISABLE_META', 'ef'), __('DISABLE_SOCIAL_DISABLE_META_DESCRIPTION', 'ef'), 'checkbox', array('checkboxText' => __('SOCIAL_MEDIA_DISABLE_META_CHECKBOXTEXT', 'ef')));
    $meta->addField('og-title', __('SOCIAL_MEDIA_POST_TITLE', 'ef'), __('SOCIAL_MEDIA_META_POST_TITLE_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-site-name', __('SOCIAL_MEDIA_SITE_NAME', 'ef'), __('SOCIAL_MEDIA_META_SITE_NAME_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-description', __('SOCIAL_MEDIA_POST_DESCRIPTION', 'ef'), 'Seitenbeschreibung für SOCIAL_MEDIA Beiträge', 'text');
    $meta->addField('og-image', __('SOCIAL_MEDIA_THUMBNAIL', 'ef'), __('SOCIAL_MEDIA_THUMBNAIL_DESCRIPTION'), 'image');
    $meta->addField('og-type', __('SOCIAL_MEDIA_ARTICLE_TYPE', 'ef'), __('SOCIAL_MEDIA_ARTICLE_TYPE_DESCRIPTION'), 'selection', array('options' => $typeOptions));
    $meta->addField('og-latitude', __('LATITUDE', 'ef'), __('LATITUDE_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-longitude', __('LONGITUDE', 'ef'), __('LONGITUDE_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-street', __('STREET', 'ef'), __('STREET_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-zip', __('ZIP_CODE', 'ef'), __('ZIP_CODE_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-city', __('CITY', 'ef'), __('CITY_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-region', __('REGION', 'ef'), __('REGION_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-country', __('COUNTRY', 'ef'), __('COUNTRY_DESCRIPTION', 'ef'), 'text');
    $meta->addField('og-facebook-post',__('FACEBOOK_ID', 'ef'), 'FACEBOOK_ID_DESCRIPTION', 'text');
    $meta->addField('og-twitter-post',__('TWITTER_ID', 'ef'), 'TWITTER_ID_DESCRIPTION', 'text');
}

# add meta tags to wp_head
function sm_add_wp_head() {

    # check if module for this post type active
    if(sm_check_post_type_enable()) {

        # get post meta
        $meta_data = get_post_meta(get_the_id(), 'ef-social-media-meta', true);

        # if null, set to empty array
        if(!is_array($meta_data))
            $meta_data = array();
        
        $option = ef_get_option('ef-social-media');
        $option_seo = ef_get_option('ef-seo');

        ef_html_comment('OpenGraph tags');

        echo "<meta property=\"og:locale\" content=\"".get_locale()."\" />\n";

        # work in progress - alternate languages
        #$languages = get_available_languages();
        #print_r($languages);        
        #foreach($languages as $lang) {
        #    echo "<meta property=\"og:locale:alternate\" content=\"".$lang."\" />\n";
        #}

        # post title
        if(isset($meta_data['og-title']) && $meta_data['og-title'] != '')
            echo "<meta property=\"og:title\" content=\"".$meta_data['og-title']."\" />\n";
        else if (is_category()) {
            $category = get_category(get_query_var('cat'));
            $cat_id = $category->cat_ID;
            echo "<meta property=\"og:title\" content=\"".get_cat_name($cat_id)."\"  />\n";
        }
        else if (is_tag()) {
            global $wp_query;
            $term = $wp_query->get_queried_object();
            echo "<meta property=\"og:title\" content=\"".$term->name."\" />\n";
        }
        else if(is_single() || is_page())
            echo "<meta property=\"og:title\" content=\"".get_the_title()."\" />\n";
        else if(is_archive() && !is_tax())
            echo "<meta property=\"og:title\" content=\"".post_type_archive_title( '', false )."\" />\n";
        else if(is_tax()) 
            echo "<meta property=\"og:title\" content=\"".post_type_archive_title( '', false )."\" />\n";
        else if(is_home())
            echo "<meta property=\"og:title\" content=\"".get_bloginfo('name')."\" />\n";
        else if(is_front_page())
            echo "<meta property=\"og:title\" content=\"".get_bloginfo('name')."\" />\n";

        # site name
        if(isset($meta_data['og-site-name']) && $meta_data['og-site-name'] != '')
           echo "<meta property=\"og:site_name\" content=\"".$meta_data['og-site-name']."\" />\n";
        else
        if($option['site-name'])
            echo "<meta property=\"og:site_name\" content=\"".$option['site-name']."\" />\n";
        else {
            echo "<meta property=\"og:site_name\" content=\"".get_bloginfo('name')."\" />\n";
        }

        # post description
        if(isset($meta_data['og-description']) && $meta_data['og-description'] != '')
           echo "<meta property=\"og:description\" content=\"".$meta_data['og-description']."\" />\n";
        else if($option['site-description'])
            echo "<meta property=\"og:description\" content=\"".$option['site-description']."\" />\n";
        else if($option_seo['global-description'])
            echo "<meta property=\"og:description\" content=\"".$option_seo['global-description']."\" />\n";

        # post image
        if(isset($meta_data['og-image']) && $meta_data['og-image'] != '')
            $image_id = $meta_data['og-image'];
        else if(get_the_post_thumbnail_url())
            $image_id = get_post_thumbnail_id();
        else if($option['image']) 
            $image_id = $option['image'];
        else 
            $image_id = null;

        if($image_id) {

            # image
            echo "<meta property=\"og:image\" content=\"".wp_get_attachment_url($image_id)."\" />\n";

            # image ssl
            if(is_ssl())
                echo "<meta property=\"og:image:secure_url\" content=\"".wp_get_attachment_url($image_id)."\" />\n";

            # image alt text
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
            if($alt_text != null)
                echo "<meta property=\"og:image:alt\" content=\"".$alt_text."\" />\n";

            echo "<meta property=\"og:image:type\" content=\"".get_post_mime_type($image_id)."\" />\n";

            # image width and height
            $image_metadata = wp_get_attachment_metadata($image_id);
            $image_width = $image_metadata['width'];
            $image_height = $image_metadata['height'];

            echo "<meta property=\"og:image:width\" content=\"".$image_width."\" />\n";
            echo "<meta property=\"og:image:height\" content=\"".$image_height."\" />\n";
        }

        # url
        if (is_category()) 
            echo "<meta property=\"og:url\" content=\"".get_category_link(get_query_var('cat'))."\" />\n";
        else if (is_tag()) 
            echo "<meta property=\"og:url\" content=\"".get_tag_link(get_queried_object()->term_id)."\" />\n";
        else if(is_single() || is_page())
            echo "<meta property=\"og:url\" content=\"".get_the_permalink()."\" />\n";
        else if(is_archive() && !is_tax())
            echo "<meta property=\"og:url\" content=\"".get_post_type_archive_link(get_query_var( 'post_type' ))."\" />\n";
        else if(is_tax()) 
            echo "<meta property=\"og:url\" content=\"".get_term_link($wp_query->get_queried_object())."\" />\n";
        else if(is_home())
            echo "<meta property=\"og:url\" content=\"".get_post_type_archive_link('post')."\" />\n";
        else if(is_frontpage())
            echo "<meta property=\"og:url\" content=\"".site_url()."\" />\n";

        # latitude
        if(isset($meta_data['og-latitude']) && $meta_data['og-latitude'] != '')
            echo "<meta property=\"og:latitude\" content=\"".$meta_data['og-latitude']."\" />\n";
        else if($option['latitude'])
            echo "<meta property=\"og:latitude\" content=\"".$option['latitude']."\" />\n";
        
        # longitude
        if(isset($meta_data['og-longitude']) && $meta_data['og-longitude'] != '')
            echo "<meta property=\"og:longitude\" content=\"".$meta_data['og-longitude']."\" />\n";
        else if($option['longitude'])
            echo "<meta property=\"og:longitude\" content=\"".$option['longitude']."\" />\n";
        
        # street
        if(isset($meta_data['og-street']) && $meta_data['og-street'] != '')
            echo "<meta property=\"og:street-address\" content=\"".$meta_data['og-street']."\" />\n";
        else if($option['street'])
            echo "<meta property=\"og:street-address\" content=\"".$option['street']."\" />\n";
        
        # city
        if(isset($meta_data['og-city']) && $meta_data['og-city'] != '')
            echo "<meta property=\"og:locality\" content=\"".$meta_data['og-city']."\" />\n";
        else if($option['city'])
            echo "<meta property=\"og:locality\" content=\"".$option['city']."\" />\n";
        
        # region
        if(isset($meta_data['og-region']) && $meta_data['og-region'] != '')
            echo "<meta property=\"og:region\" content=\"".$meta_data['og-region']."\" />\n";
        else if($option['region'])
            echo "<meta property=\"og:region\" content=\"".$option['region']."\" />\n";
        
        # zip code
        if(isset($meta_data['og-zip']) && $meta_data['og-zip'] != '')
            echo "<meta property=\"og:postal-code\" content=\"".$meta_data['og-zip']."\" />\n";
        else if($option['zip'])
            echo "<meta property=\"og:postal-code\" content=\"".$option['zip']."\" />\n";
        
        #
        if(isset($meta_data['og-country']) && $meta_data['og-country'] != '')
            echo "<meta property=\"og:country-name\" content=\"".$meta_data['og-country']."\" />\n";
        else if($option['country'])
            echo "<meta property=\"og:country-name\" content=\"".$option['country']."\" />\n";

    }

    echo "\n";
        
}
add_action('wp_head', 'sm_add_wp_head', -1);

# check if post type enable
function sm_check_post_type_enable() {

    $option = ef_get_option('ef-social-media', array());
    $post_type = get_post_type();

    if(is_array($option) && array_key_exists('post-types', $option) && is_array($option['post-types']))
        return in_array($post_type, $option['post-types']);
}

?>