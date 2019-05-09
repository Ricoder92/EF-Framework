<?php

if(isset($value['firstname']))
    $firstname = $value['firstname'];
else    
    $firstname = '';

if(isset($value['lastname']))    
    $lastname = $value['lastname'];
else    
    $lastname = '';

$output .= '<input type="text" class="enfi-admin-input" id="'.$name.'-field"  name="'.$name.'[firstname]"  placeholder="'.__('Vorname', 'enfi').'" value="'.$firstname.'" />';
$output .= '<br/><input type="text" class="enfi-admin-input" id="'.$name.'-field"  name="'.$name.'[lastname]"  placeholder="'.__('Nachname', 'enfi').'" value="'.$lastname.'" />';

?>