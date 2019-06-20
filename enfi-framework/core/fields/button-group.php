<?php


$options = $data['options'];


$count = count($options);
$percent = 100 / $count;

if(!isset($data['vertical']))
    $output .= '<div class="ef-admin-input-button-group">';
else 
    $output .= '<div class="ef-admin-input-button-group-vertical">';

foreach($options as $option) {

    $text = $option['text'];
    $_value = $option['value'];

    if(!isset($data['vertical'])) {
        if($value == $_value)
            $cssCurrent = 'style="width:calc('.$percent.'% - 1px);" class="current"';
        else   
            $cssCurrent = 'style="width:calc('.$percent.'% - 1px);"';
    } else {
        if($value == $_value)
            $cssCurrent = 'class="current"';
        else   
            $cssCurrent = '';
    }


    $output .= '<a data-value="'.$_value.'"'.$cssCurrent.'>'.$text.'</a>';

}

$output .= '<input type="hidden" value="'.$value.'" name="'.$name.'">';
$output .= '</div>';

?>