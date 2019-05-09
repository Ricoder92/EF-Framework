<?php

if(isset($value['top']))    
    $top = $value['top'];
else    
    $top = '';

if(isset($value['right']))    
    $right = $value['right'];
else    
    $right = '';

if(isset($value['down']))
    $down = $value['down'];
else    
    $down = '';

if(isset($value['left']))    
    $left = $value['left'];
else    
    $left = '';

$output .= '<input type="text" class="enfi-admin-input-small" id="'.$name.'[top]-field"  name="'.$name.'[top]"  placeholder="'.__('Oben', 'enfi').'" value="'.$top.'" />';
$output .= '<input type="text" class="enfi-admin-input-small" id="'.$name.'[right]-field"  name="'.$name.'[right]"  placeholder="'.__('Rechts', 'enfi').'" value="'.$right.'" />';
$output .= '<input type="text" class="enfi-admin-input-small" id="'.$name.'[down]-field"  name="'.$name.'[down]"  placeholder="'.__('Unten', 'enfi').'" value="'.$down.'" />';
$output .= '<input type="text" class="enfi-admin-input-small" id="'.$name.'[left]-field"  name="'.$name.'[left]"  placeholder="'.__('Links', 'enfi').'" value="'.$left.'" />';