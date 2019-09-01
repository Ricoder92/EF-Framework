<?php

if($value == 1)
    $checked = checked($value, 1, false);
else
    $checked = '';

# check checkboxText
if(isset($data['checkboxText']))
    $checkboxText = $data['checkboxText'];
else   
    $checkboxText = '';

    $output .= '<div class="custom-control custom-checkbox">';
        $output .= '<input type="checkbox" class="custom-control-input" id="'.$name.'" name="'.$name.'">';
        $output .= '<label class="custom-control-label" for="'.$name.'">'.__($checkboxText, 'ef').'</label>';
    $output .= '</div>';

?>