<?php

    if(isset($value['value']))
        $height = $value['value'];
    else   
        $height = null;

    if(isset($value['unit']))
        $unit = $value['unit'];
    else 
        $unit = "";

    $output .= '<input type="text" class="enfi-admin-input" id="'.$name.'-field"  name="'.$name.'[value]"  placeholder="'.$placeholder.'" value="'.$height.'" />';
    $output .= '<select for="'.$name.'-field" name="'.$name.'[unit]" class="enfi-admin-input">';
        $output .= '<option value=""'.selected( '0', $unit, false ).'>-- keine Auswahl --</option>';
        $output .= '<option value="%" '.selected( '%', $unit, false ).'>%</option>';
        $output .= '<option value="px" '.selected( 'px', $unit, false ).'>px</option>';
        $output .= '<option value="rem" '.selected( 'rem', $unit, false ).'>rem</option>';
        $output .= '<option value="em" '.selected( 'em', $unit, false ).'>em</option>';
        $output .= '<option value="em" '.selected( 'vh', $unit, false ).'>em</option>';
    $output .= '</select>';
    
    
?>