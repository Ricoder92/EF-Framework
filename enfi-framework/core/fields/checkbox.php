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

$output .= '<input id="'.$name.'" type="checkbox" value="1" name="'.$name.'" '.$checked.'><label for="'.$name.'">'.__($checkboxText, 'ef').'</label>';
?>

