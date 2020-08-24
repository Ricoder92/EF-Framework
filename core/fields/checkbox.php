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

    $output .= '<input class="ef-admin-input-checkbox" type="checkbox" id="'.$name.'" value="1" name="'.$name.'" '.$checked.'>';
    $output .= '<label class="ef-admin-input-checkbox-label" for="'.$name.'"">'.$checkboxText.'</label>';


?>