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
$output .= '<div class="ef-admin-input-input-image">';
    $output .= '<div class="ef-admin-input-image-set '.$hidden2.'" style="background-image: url(\''.$image.'\')"><i class="fas fa-plus"></i></div>';
    $output .= '<a class="ef-admin-input-image-remove" '.$hidden.'>'.__('REMOVE_IMAGE', 'ef').'</a>';
    $output .= '<input type="hidden" for="'.$name.'-field" class="ef-admin-input-image-input" name="'.$name.'" value="'.$value.'" />';
$output .= '</div>';

?>