<?php

if(isset($value['firstname']))
    $firstname = $value['firstname'];
else    
    $firstname = '';

if(isset($value['lastname']))    
    $lastname = $value['lastname'];
else    
    $lastname = '';

$output .= '<input type="text" class="ef-admin-input" id="'.$name.'-field"  name="'.$name.'[firstname]"  placeholder="'.__('Firstname', 'ef').'" value="'.$firstname.'" />';
$output .= '<br/><input type="text" class="ef-admin-input" id="'.$name.'-field"  name="'.$name.'[lastname]"  placeholder="'.__('Lastname', 'ef').'" value="'.$lastname.'" />';

?>