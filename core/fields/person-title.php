<?php

$output .= '<select for="'.$name.'-field" name="'.$name.'" class="ef-admin-input">';
$output .= '<option value="0"'.selected( $value, '0', false ).'>-- keine Auswahl --</option>';

$output .= '<option value="dr" '.selected( $value, 'dr', false ).'>'.__('Dr.', 'ef').'</option>';
$output .= '<option value="drprof" '.selected( $value, 'male', false ).'>'.__('Dr. Prof.', 'ef').'</option>';
$output .= '<option value="prof" '.selected( $value, 'male', false ).'>'.__('Prof.', 'ef').'</option>';

$output .= '</select>';

?>