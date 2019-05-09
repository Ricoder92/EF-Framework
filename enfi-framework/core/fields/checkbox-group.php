<?php


$options = parseOptions($data);

$i = 0;

$output.= '<div class="enfi-admin-input-checkbox-group">';

foreach($options as $option) {

    if(isset($data['options'])) {

        if(isset($option['key']))
            $keyitem = $option['key'];
        else
            $keyitem = $i;

        $textItem = $option['text'];
        $valueItem = $option['value'];

        if(isset($option['description']))
            $descriptionItem = $option['description'];
    }

    if(isset($data['taxonomy'])) {
        
        $keyitem = $option->term_id;
        $textItem = $option->name;
        $valueItem = $option->term_id;
    }

    if(isset($data['posts'])) {
        $keyitem = $option->id;
        $textItem = $option->post_title.' ('.$option->ID.')';
        $valueItem = $option->id;
    }

    if(isset($data['post_types'])) {
        $keyitem = $option;
        $post_type_obj = get_post_type_object( $option );
        $textItem = $post_type_obj->labels->name;
        $valueItem = $option;
    }

    if(isset($value[$keyitem]))
        $checked = checked($value[$keyitem], $valueItem, false);
    else
        $checked = '';

    $output.= '<div class="item">';
        
        $output .= '<input type="checkbox" id="'.$name.'['.$keyitem.']" value="'.$valueItem.'" name="'.$name.'['.$keyitem.']" '.$checked.'><label for="'.$name.'['.$keyitem.']"">'.$textItem.'</label>';
        
        if(isset($descriptionItem))
            $output .=  "- ".$descriptionItem;

        $output .= '<br/>';
    
    $output.= '</div>';
    
    $i++;
}

$output.= '</div>';


?>