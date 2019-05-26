<?php

    $options = array(
        array( 'text' => 'Einblenden', 'value' => 'fade'),
        array( 'text' => 'Einblenden von oben', 'value' => 'fade-up'),
        array( 'text' => 'Einblenden von unten', 'value' => 'fade-down'),
        array( 'text' => 'Einblenden nach links', 'value' => 'fade-left'),
        array( 'text' => 'Einblenden nach rechts', 'value' => 'fade-right'),
        array( 'text' => 'Einblenden nach oben nach rechts', 'value' => 'fade-up-right'),
        array( 'text' => 'Einblenden nach oben nach links', 'value' => 'fade-up-left'),
        array( 'text' => 'Einblenden nach unten nach rechts', 'value' => 'fade-down-right'),
        array( 'text' => 'Einblenden nach unten nach rechts', 'value' => 'fade-down-left'),
        array( 'text' => 'Drehen', 'value' => 'flip-up'),
        array( 'text' => 'Drehen nach unten', 'value' => 'flip-down'),
        array( 'text' => 'Drehen von links', 'value' => 'flip-left'),
        array( 'text' => 'Drehen von rechts', 'value' => 'flip-right'),
        array( 'text' => 'Sliden von oben', 'value' => 'slide-up'),
        array( 'text' => 'Sliden von unten', 'value' => 'slide-down'),
        array( 'text' => 'Sliden nach links', 'value' => 'slide-left'),
        array( 'text' => 'Sliden nach rechts', 'value' => 'slide-right'),
        array( 'text' => 'Reinzoomen', 'value' => 'zoom-in'),
        array( 'text' => 'Reinzoomen von oben', 'value' => 'zoom-in-up'),
        array( 'text' => 'Reinzoomen von unten', 'value' => 'zoom-in-down'),
        array( 'text' => 'Reinzoomen von links', 'value' => 'zoom-in-left'),
        array( 'text' => 'Reinzoomen von rechts', 'value' => 'zoom-in-right'),
        array( 'text' => 'Rauszoomen', 'value' => 'zoom-out'),
        array( 'text' => 'Rauszoomen von oben', 'value' => 'zoom-out-up'),
        array( 'text' => 'Rauszoomen von unten', 'value' => 'zoom-out-down'),
        array( 'text' => 'Rauszoomen von links', 'value' => 'zoom-out-left'),
        array( 'text' => 'Rauszoomen von rechts', 'value' => 'zoom-out-right')
    );

if(isset($value['effect']))
    $value = $value['effect'];
else    
    $value = "";

$output .= '<select for="'.$name.'[effect]" name="'.$name.'[effect]" class="enfi-admin-input">';
$output .= '<option value="0"'.selected( $value, "0", false ).'>-- keine Auswahl --</option>';



foreach($options as $option) {
    $output .= '<option value="'.$option['value'].'"'.selected( $value, $option['value'], false ).'>'.$option['text'].'</option>';
}

    $output .= '</select>';

if(isset($value['duration']))
    $value_duration = $value['duration'];
else    
    $value_duration = "";

if(isset($value['delay']))
    $value_delay = $value['delay'];
else    
    $value_delay = "";

    $output .= '<br/><input type="text" class="enfi-admin-input" id="'.$name.'-field"  name="'.$name.'[duration]"  placeholder="'.__('Effect duration', 'ef').'" value="'.$value_duration.'" />';
    $output .= '<br/><input type="text" class="enfi-admin-input" id="'.$name.'-field"  name="'.$name.'[delay]"  placeholder="'.__('Effect delay', 'ef').'" value="'.$value_delay.'" />';
?>