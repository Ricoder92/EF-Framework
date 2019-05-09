<?php


$posts = get_posts([
    'post_type' => 'wpcf7_contact_form',
    'post_status' => 'publish',
    'numberposts' => -1
    # 'order'    => 'ASC'
  ]);

$options = $data['options'];
$output .= '<select for="'.$name.'-field" name="'.$name.'" class="enfi-admin-input">';
$output .= '<option value="0"'.selected( $value, '0', false ).'>-- keine Auswahl --</option>';
foreach($posts  as $post) {

    $text = $post->post_title;
    $value = $post->ID;

    $output .= '<option value="'.$value.'"'.selected( $value, $value, false ).'>'.$text.'</option>';

}

$output .= '</select>';

?>