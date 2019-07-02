<?php

################################################################################################################################################## 
### Cover WIP!!!!!!!!!!!!!!!!!!!!!!!!!!!
##################################################################################################################################################

$cover = new EF_Settings_Page('ef-cover', __('COVER', 'ef'), __('COVER', 'ef'), __('COVER_DESCRIPTION', 'ef'), 'layout', '', 7);

$cover->addSection('global_cover',__('COVER_SETTINGS_GLOBAL'));
$cover->addField('global_cover', 'global-height', __('COVER_GLOBAL_HEIGHT', 'ef'), __('COVER_GLOBAL_HEIGHT', 'ef'), 'text', 300);
$cover->addField('global_cover', 'global-text-color', __('COVER_GLOBAL_TEXT_COLOR', 'ef'), __('COVER_GLOBAL_TEXT_COLOR', 'ef'), 'color-picker', null);
$cover->addField('global_cover', 'global-text-align', __('COVER_GLOBAL_TEXT_ALIGN', 'ef'), __('COVER_GLOBAL_TEXT_ALIGN', 'ef'), 'text-align', null);
$cover->addField('global_cover', 'global-bg-color', __('COVER_GLOBAL_BACKGROUND_COLOR', 'ef'), __('COVER_GLOBAL_BACKGROUND_COLOR', 'ef'), 'color-picker', null);
$cover->addField('global_cover', 'global-bg-image', __('COVER_GLOBAL_BACKGROUND_IMAGE', 'ef'), __('COVER_GLOBAL_BACKGROUND_IMAGE', 'ef'), 'image', null);

$cover->addSection('settings', __('COVER_SETTINGS', 'ef'));
$cover->addField('settings', 'enable-post-types', __('POST_TYPES', 'ef'), null, 'checkbox-group', null, array( 'post_types' => get_post_types()));

$post_types = ef_get_option('ef-cover');

if(array_key_exists('enable-post-types', $post_types)) {

    foreach($post_types['enable-post-types'] as $post_type) {
        $_cpt = get_post_type_object($post_type);
    
        $cover->addSection($post_type, __($_cpt->labels->name));
        $cover->addField($post_type, $post_type.'-height', __('COVER_HEIGHT', 'ef'), __('COVER_HEIGHT', 'ef'), 'text', null);
        $cover->addField($post_type, $post_type.'-text-color', __('COVER_TEXT_COLOR', 'ef'), __('COVER_TEXT_COLOR', 'ef'), 'color-picker', null);
        $cover->addField($post_type, $post_type.'-text-align', __('COVER_TEXT_ALIGN', 'ef'), __('COVER_TEXT_ALIGN', 'ef'), 'text-align', null);
        $cover->addField($post_type, $post_type.'-bg-color', __('COVER_BACKGROUND_COLOR', 'ef'), __('COVER_BACKGROUND_COLOR', 'ef'), 'color-picker', null);
        $cover->addField($post_type, $post_type.'-bg-image', __('COVER_BACKGROUND_IMAGE', 'ef'), __('COVER_BACKGROUND_IMAGE', 'ef'), 'image', null);

        $cover_meta = new EF_Metabox('ef-cover', __('COVER_SETTINGS_META', 'ef'), $post_type);
        $cover_meta->addField('cover-meta-height', __('COVER_GLOBAL_HEIGHT', 'ef'), __('COVER_GLOBAL_HEIGHT', 'ef'), 'text', 300);
        $cover_meta->addField('cover-meta-text-color', __('COVER_GLOBAL_TEXT_COLOR', 'ef'), __('COVER_GLOBAL_TEXT_COLOR', 'ef'), 'color-picker', null);
        $cover_meta->addField('cover-meta-text-align', __('COVER_GLOBAL_TEXT_ALIGN', 'ef'), __('COVER_GLOBAL_TEXT_ALIGN', 'ef'), 'text-align', null);
        $cover_meta->addField('cover-meta-bg-color', __('COVER_GLOBAL_BACKGROUND_COLOR', 'ef'), __('COVER_GLOBAL_BACKGROUND_COLOR', 'ef'), 'color-picker', null);
        $cover_meta->addField('cover-meta-bg-image', __('COVER_GLOBAL_BACKGROUND_IMAGE', 'ef'), __('COVER_GLOBAL_BACKGROUND_IMAGE', 'ef'), 'image', null);
    }
}

$cover->setDefaultValues();

function ef_cover_get_title() {

    if( is_single() || is_page()) 
        return get_the_title();

    if(is_home()) {
        $_cpt = get_post_type_object('post');
        return $_cpt->labels->name;
    }

    if(is_archive()) {
        return post_type_archive_title();
    }

    if(is_tax()) {
        global $wp_query;
        $term = $wp_query->get_queried_object();
        return $term->name;
    }

}

function ef_cover_get_bg_image() {

    $settings = ef_get_option('ef-cover');
    $meta = get_post_meta(get_the_id(), 'ef-cover', true);

    $type_of_content = ef_get_type_of_post();
    
    if ($meta['cover-meta-bg-image'] != null)
        return $meta['cover-meta-bg-image'];
    else if ($settings[$type_of_content.'-bg-image'] != null)
        return $settings[$type_of_content.'-bg-image'];
    else if($settings['global-bg-image'] != null)
        return $settings['global-bg-image'];
    else if(get_post_thumbnail_id())
        return get_post_thumbnail_id();
    else 
        return null;
    
}

function ef_cover_get_bg_color() {

    $settings = ef_get_option('ef-cover');
    $meta = get_post_meta(get_the_id(), 'ef-cover', true);

    $type_of_content = ef_get_type_of_post();

    if ($meta['cover-meta-bg-color'] != null)
        return $meta['cover-meta-bg-color'];
    else if ($settings[$type_of_content.'-bg-color'] != null)
        return $settings[$type_of_content.'-bg-color'];
    else if($settings['global-bg-color'] != null)
        return $settings['global-bg-color'];
    else 
        return null;
}

function ef_cover_get_height() {

    $settings = ef_get_option('ef-cover');
    $meta = get_post_meta(get_the_id(), 'ef-cover', true);
    $type_of_content = ef_get_type_of_post();
    
    if ($meta['cover-meta-height'] != null)
        return $meta['cover-meta-height'];
    else if ($settings[$type_of_content.'-height'] != null)
        return $settings[$type_of_content.'-height'];
    else if($settings['global-height'] != null)
        return $settings['global-height'];
    else 
        return null;
}

function ef_cover_get_text_color() {

    $settings = ef_get_option('ef-cover');
    $meta = get_post_meta(get_the_id(), 'ef-cover', true);
    $type_of_content = ef_get_type_of_post();
    
    if ($meta['cover-meta-text-color'] != null)
        return $meta['cover-meta-text-color'];
    else if ($settings[$type_of_content.'-text-color'] != null)
        return $settings[$type_of_content.'-text-color'];
    else if($settings['global-text-color'] != null)
        return $settings['global-text-color'];
    else 
        return null;
}

function ef_cover_get_text_align() {

    $settings = ef_get_option('ef-cover');
    $meta = get_post_meta(get_the_id(), 'ef-cover', true);
    $type_of_content = ef_get_type_of_post();
    
    if ($meta['cover-meta-text-align'] != null)
        return $meta['cover-meta-text-align'];
    else if ($settings[$type_of_content.'-text-align'] != null)
        return $settings[$type_of_content.'-text-align'];
    else if($settings['global-text-align'] != null)
        return $settings['global-text-align'];
    else 
        return null;
}

function ef_cover_get_bg_style() {

    $option = ef_get_option('ef-cover');

    if(is_array($option['enable-post-types']) && array_key_exists(get_post_type(), $option['enable-post-types'])) {

        $styles = array();
        $return = '';

        // styles
        $image = ef_cover_get_bg_image();
        $color = ef_cover_get_bg_color();
        $height = ef_cover_get_height();
        $text_color = ef_cover_get_text_color();
        $text_align = ef_cover_get_text_align();

        if($image)
            array_push($styles, 'background-image: url(\''.wp_get_attachment_url($image).'\');');
        
        if($color)
            array_push($styles, 'background-color: '.$color.';');

        if($height)
            array_push($styles, 'height: '.$height.'px;');

        if($text_color)
            array_push($styles, 'color: '.$text_color.';');

        if($text_align)
            array_push($styles, 'text-align: '.$text_align.';');

        if(count($styles) > 0) {
            $return = 'style="';
            foreach($styles as $style) {
                $return .= $style;
            }
            $return .= '"';
        }

        return $return;

    }

}


?>