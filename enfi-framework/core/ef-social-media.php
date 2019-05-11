<?php

$social_media_page = new EF_Settings_Page('social-media', __('Social Media', 'enfi'), __('Social Media', 'enfi'), __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'enfi'), 'settings', 'fa-hashtag', 3);

    $social_media_page->addSection('social-media-channels', __('Social Media Channels', 'enfi'));
        $social_media_page->addField('social-media-channels', 'facebook', __('Facebook-site ID', 'enfi'), null, 'text', null);
        $social_media_page->addField('social-media-channels', 'youtube', __('Youtube Channel', 'enfi'), null, 'text', null);
        $social_media_page->addField('social-media-channels', 'twitter', __('Twitter', 'enfi'), null, 'text');
        $social_media_page->addField('social-media-channels', 'instagram', __('Instagram', 'enfi'), null, 'text', null);

    $social_media_page->addSection('og-post-types', __('Post Types', 'enfi'));
        $social_media_page->addField('og-post-types', 'post-types', __('Post Types', 'enfi'), null, 'checkbox-group', null, array( 'post_types' => get_post_types()));

    $social_media_page->addSection('og-tags', __('OpenGraph Meta Tags', 'enfi'));
        $social_media_page->addField('og-tags', 'title', __('Title', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'type', __('Type', 'enfi'), null, 'selection', null, array('options' => $typeOptions));
        $social_media_page->addField('og-tags', 'image', __('Image', 'enfi'), null, 'image', null);
        $social_media_page->addField('og-tags', 'site-name', __('Site Name', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'site-description', __('Site Description', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'email', __('E-Mail', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'phone', __('Phone Number', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'fax', __('Fax Number', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'latitude', __('Latitude', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'longitude', __('Longitude', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'street', __('Street', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'zip', __('ZIP Code', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'city', __('City', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'region', __('Region', 'enfi'), null, 'text', null);
        $social_media_page->addField('og-tags', 'country', __('Land', 'enfi'), null, 'text', null);

$typeOptions = array(
    array( 'text' =>  __('Movie', 'enfi'), 'value' => 'movie'),
    array( 'text' =>  __('Audio', 'enfi'), 'value' => 'audio'),
    array( 'text' =>  __('Article', 'enfi'), 'value' => 'article'),
    array( 'text' =>  __('Actor', 'enfi'), 'value' => 'actor'),
    array( 'text' =>  __('Website', 'enfi'), 'value' => 'website'),
);

$social_media_page->setDefaultValues();

# get option data
$option_data = get_option('social-media');

# enable for post types
if(array_key_exists('post-types', $option_data)) {

    # get post types
    $post_types = $option_data['post-types'];   

    # create meta box for post types
    $meta = new EF_Metabox('social-media-meta', __('Social Media', 'enfi'), $post_types);
    $meta->addField('og-disable', __('Disable', 'enfi'), 'Aktivieren, um die Suchmaschinenoptimierung für diese Seite/Beitrag auszuschalten.', 'checkbox', array('checkboxText' => __('Disable Social Media Meta Data for this post', 'enfi')));
    $meta->addField('og-title', __('Social media post title', 'enfi'), 'Seitentitel für Social Media Beiträge', 'text');
    $meta->addField('og-site-name', __('Social media site name', 'enfi'), 'Seitenbeschreibung für Social Media Beiträge', 'text');
    $meta->addField('og-description', __('Social media post description', 'enfi'), 'Seitenbeschreibung für Social Media Beiträge', 'text');
    $meta->addField('og-image', __('Social media thumbnail', 'enfi'), 'Vorschaubild für Social Media Beiträge', 'image');
    $meta->addField('og-type', __('Article type', 'enfi'), 'Vorschaubild für Social Media Beiträge', 'selection', array('options' => $typeOptions));
    $meta->addField('og-latitude', __('Latitude', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-longitude', __('Longitude', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-street', __('Street', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-zip', __('ZIP Code', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-city', __('City', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-region', __('Region', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-country', __('Country', 'enfi'), __('Globale Keywörter für alle Seiten und Beiträge', 'enfi'), 'text');
    $meta->addField('og-facebook-post',__('Facebook', 'enfi'), 'Name des eigenen Twitter Kanals', 'text');
    $meta->addField('og-twitter-post',__('Twitter', 'enfi'), 'Name des eigenen Twitter Kanals', 'text');
}

# add meta tags to wp_head
function sm_add_wp_head() {

    # check if module for this post type active
    if(sm_check_post_type_enable()) {

        # get post meta
        $meta_data = get_post_meta(get_the_id(), 'social-media-meta', true);

        # if null, set to empty array
        if(!is_array($meta_data))
            $meta_data = array();
        
        # get seo option (+child)
        if(is_child_theme()) {
            $child_theme = get_stylesheet();
            $option_data = get_option('social-media-'.$child_theme);
        } else {
            $option_data = get_option('social-media');
        }

        ef_html_comment('Social Media');

        echo "\t<meta property=\"og:locale\" content=\"".get_locale()."\"/>\n";

        # work in progress - alternate languages
        #$languages = get_available_languages();
        #print_r($languages);        
        #foreach($languages as $lang) {
        #    echo "\t<meta property=\"og:locale:alternate\" content=\"".$lang."\"/>\n";
        #}

        # post title
        if(isset($meta_data['og-title']))
            echo "\t<meta property=\"og:title\" content=\"".$meta_data['og-title']."\"/>\n";
        else {
            echo "\t<meta property=\"og:title\" content=\"".get_the_title()."\"/>\n";
        }

        # site name
        if(isset($meta_data['og-site-name']))
           echo "\t<meta property=\"og:site_name\" content=\"".$meta_data['og-site-name']."\"/>\n";
        else
        if($option_data['site-name'])
            echo "\t<meta property=\"og:site_name\" content=\"".$option_data['site-name']."\"/>\n";
        else {
            echo "\t<meta property=\"og:site_name\" content=\"".get_bloginfo('name')."\"/>\n";
        }

        # post description
        if(isset($meta_data['og-description']))
           echo "\t<meta property=\"og:description\" content=\"".$meta_data['og-description']."\"/>\n";
        else if($option_data['site-description'])
            echo "\t<meta property=\"og:description\" content=\"".$option_data['site-description']."\"/>\n";

        # post image
        if(isset($meta_data['og-image']))
            $image_id = $meta_data['og-image'];
        else if(get_the_post_thumbnail_url())
            $image_id = get_post_thumbnail_id();
        else if($option_data['image']) 
            $image_id = $option_data['image'];
        else 
            $image_id = null;

        if($image_id) {

            # image
            echo "\t<meta property=\"og:image\" content=\"".wp_get_attachment_url($image_id)."\"/>\n";

            # image ssl
            if(is_ssl())
                echo "\t<meta property=\"og:image:secure_url\" content=\"".wp_get_attachment_url($image_id)."\"/>\n";

            # image alt text
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
            if($alt_text != null)
                echo "\t<meta property=\"og:image:alt\" content=\"".$alt_text."\"/>\n";

            echo "\t<meta property=\"og:image:type\" content=\"".get_post_mime_type($image_id)."\"/>\n";

            # image width and height
            $image_metadata = wp_get_attachment_metadata($image_id);
            $image_width = $image_metadata['width'];
            $image_height = $image_metadata['height'];

            echo "\t<meta property=\"og:image:width\" content=\"".$image_width."\"/>\n";
            echo "\t<meta property=\"og:image:height\" content=\"".$image_height."\"/>\n";
        }

        # url
        echo "\t<meta property=\"og:url\" content=\"".get_the_permalink()."\"/>\n";
        
        # latitude
        if(isset($meta_data['og-latitude']))
            echo "\t<meta property=\"og:latitude\" content=\"".$meta_data['og-latitude']."\"/>\n";
        else if($option_data['latitude'])
            echo "\t<meta property=\"og:latitude\" content=\"".$option_data['latitude']."\"/>\n";
        
        # longitude
        if(isset($meta_data['og-longitude']))
            echo "\t<meta property=\"og:longitude\" content=\"".$meta_data['og-longitude']."\"/>\n";
        else if($option_data['longitude'])
            echo "\t<meta property=\"og:longitude\" content=\"".$option_data['longitude']."\"/>\n";
        
        # street
        if(isset($meta_data['og-street']))
            echo "\t<meta property=\"og:street-address\" content=\"".$meta_data['og-street']."\"/>\n";
        else if($option_data['street'])
            echo "\t<meta property=\"og:street-address\" content=\"".$option_data['street']."\"/>\n";
        
        # city
        if(isset($meta_data['og-city']))
            echo "\t<meta property=\"og:locality\" content=\"".$meta_data['og-city']."\"/>\n";
        else if($option_data['city'])
            echo "\t<meta property=\"og:locality\" content=\"".$option_data['city']."\"/>\n";
        
        # region
        if(isset($meta_data['og-region']))
            echo "\t<meta property=\"og:region\" content=\"".$meta_data['og-region']."\"/>\n";
        else if($option_data['region'])
            echo "\t<meta property=\"og:region\" content=\"".$option_data['region']."\"/>\n";
        
        # zip code
        if(isset($meta_data['og-zip']))
            echo "\t<meta property=\"og:postal-code\" content=\"".$meta_data['og-zip']."\"/>\n";
        else if($option_data['zip'])
            echo "\t<meta property=\"og:postal-code\" content=\"".$option_data['zip']."\"/>\n";
        
        #
        if(isset($meta_data['og-country']))
            echo "\t<meta property=\"og:country-name\" content=\"".$meta_data['og-country']."\"/>\n";
        else if($option_data['country'])
            echo "\t<meta property=\"og:country-name\" content=\"".$option_data['country']."\"/>\n";

    }

    echo "\n";
        
}
add_action('wp_head', 'sm_add_wp_head', -997);

# check if for post type enable
function sm_check_post_type_enable() {

    if(is_child_theme()) {
        $child_theme = get_stylesheet();
        $option_sm = get_option('social-media-'.$child_theme, array());
    } else {
        $option_sm = get_option('social-media', array());
    }

    $post_type = get_post_type();

    if(array_key_exists('post-types', $option_sm) && is_array($option_sm['post-types']))
        return in_array($post_type, $option_sm['post-types']);
}

?>