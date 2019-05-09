<?php

$output .= '<div class="enfi-admin-input-button-group">';

        if($value == 'left')
            $cssCurrent_left = ' class="current"';
        else   
            $cssCurrent_left = '';
        
        if($value == 'center')
            $cssCurrent_center = ' class="current"';
        else   
            $cssCurrent_center = '';

        if($value == 'right')
            $cssCurrent_right = ' class="current"';
        else   
            $cssCurrent_right = '';

        if($value == 'justify')
            $cssCurrent_right = ' class="current"';
        else   
            $cssCurrent_justify = '';
            
        $output .= '<a style="width:calc(25% - 1px);" data-value="left"'.$cssCurrent_left.'><i class="fas fa-align-left"></i></a>';
        $output .= '<a style="width:calc(25% - 1px);" data-value="center"'.$cssCurrent_center.'><i class="fas fa-align-center"></i></a>';
        $output .= '<a style="width:calc(25% - 1px);" data-value="right"'.$cssCurrent_right.'><i class="fas fa-align-right"></i></a>';
        $output .= '<a style="width:calc(25% - 1px);" data-value="right"'.$cssCurrent_justify.'><i class="fas fa-align-justify"></i></a>';

    $output .= ' <input type="hidden" value="'.$value.'" name="'.$name.'">';
$output .= '</div>';

?>