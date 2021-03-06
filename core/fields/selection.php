<?php

$options = parseOptions($data);

if(isset($data['defaultOptionText']))
    $defaultOptionText = $data['defaultOptionText'];
else 
    $defaultOptionText = __('--NO_OPTION--', 'ef');

if(isset($data['defaultOptionValue']))
    $defaultOptionValue = $data['defaultOptionValue'];
else 
    $defaultOptionValue = '';

$output .= '<select for="'.$name.'" name="'.$name.'" class="ef-form-control-selection">';
$output .= '<option value="'.$defaultOptionValue.'"'.selected( $value, $defaultOptionValue, false ).'>'.$defaultOptionText.'</option>';

foreach($options as $option) {

    if(isset($data['options'])) {
        $textItem = $option['text'];
        $valueItem = $option['value'];
    }

    else if(isset($data['taxonomy'])) {
        $textItem = $option->name;
        $valueItem = $option->term_id;
    }

    else if(isset($data['posts'])) {
        $textItem = $option->ID. ' - '.$option->post_title;
        $valueItem = $option->ID;
    }

    else if (isset($data['post_types'])) {
        $post_type_obj = get_post_type_object( $option );
        $textItem = $post_type_obj->labels->name;
        $valueItem = $option;
    }

    $output .= '<option value="'.$valueItem.'"'.selected( $value, $valueItem, false ).'>'.$textItem.'</option>';
}

$output .= '</select>';


?>