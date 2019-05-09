<?php

wp_enqueue_media();

if($value != '') {
    $hidden = '';
    $hidden2 = 'isset';
} else {
    $hidden = 'style="display:none;"';
    $hidden2 = '';
}

$image = wp_get_attachment_url( $value );
$output .= '<div class="enfi-settings-input-image">';
    $output .= '<div class="enfi-settings-image-set '.$hidden2.'" style="background-image: url(\''.$image.'\')"><i class="fas fa-plus"></i></div>';
    $output .= '<a class="enfi-settings-image-remove" '.$hidden.'><i class="fas fa-times"></i> '.__('Remove Image', 'enfi').'</a>';
    $output .= '<input type="hidden" for="'.$name.'-field" class="enfi-settings-image-input" name="'.$name.'" value="'.$value.'" />';
$output .= '</div>';

?>