<?php

$output .= '<select for="'.$name.'-field" name="'.$name.'" class="ef-admin-input">';
$output .= '<option value="0"'.selected( $value, '0', false ).'>-- keine Auswahl --</option>';

    $output .= '<option value="female"'.selected( $value, 'female', false ).'>'.__('Female', 'ef').'</option>';
    $output .= '<option value="male"'.selected( $value, 'male', false ).'>'.__('Male', 'ef').'</option>';


$output .= '</select>';

?>