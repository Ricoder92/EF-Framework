<?php
$options = $data['options'];
$count = count($options);
$percent = 100 / $count;
if(!isset($data['vertical']))
    $output .= '<div class="btn-group btn-group-toggle" data-toggle="buttons">';
else 
    $output .= '<div class="btn-group btn-group-toggle" data-toggle="buttons">';
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

    $output .= '<label class="btn btn-secondary active">';
        $output .= '<input type="radio" value="'.$_value.'" name="'.$name.'" id="option1" autocomplete="off" '.$_value.'> '.$text.'';
    $output .= '</label>';
}

$output .= '</div>';

?>