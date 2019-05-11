<?php

if(isset($value['street']))    
    $street = $value['street'];
else    
    $street = '';

if(isset($value['street_addition']))    
    $street_addition = $value['street_addition'];
else    
    $street_addition = '';

if(isset($value['city']))
    $city = $value['city'];
else    
    $city = '';

if(isset($value['zip']))    
    $zip = $value['zip'];
else    
    $zip = '';

$output .= '<input type="text" class="enfi-admin-input" id="'.$name.'[street]-field"  name="'.$name.'[street]"  placeholder="'.__('Straße', 'ef').'" value="'.$street.'" /><br/>';
$output .= '<input type="text" class="enfi-admin-input" id="'.$name.'[street_addition]-field"  name="'.$name.'[street_addition]"  placeholder="'.__('Adresszusatz', 'ef').'" value="'.$street_addition.'" /><br/>';
$output .= '<input type="text" class="enfi-admin-input" id="'.$name.'[zip]-field"  name="'.$name.'[zip]"  placeholder="'.__('PLZ', 'ef').'" value="'.$zip.'" /><br/>';
$output .= '<input type="text" class="enfi-admin-input" id="'.$name.'[city]-field"  name="'.$name.'[city]"  placeholder="'.__('Stadt', 'ef').'" value="'.$city.'" /><br/>';