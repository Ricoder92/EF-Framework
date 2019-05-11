<?php

# html commentary
function ef_html_comment($text) {
    echo "\n\t<!-- ############ ".$text." ############ --!>\n";
}

function ef_get_option($string, $default = false) {

    if(is_child_theme()) {
        $child_theme = get_stylesheet();
        $option = get_option($string.'-'.$child_theme);
    } else {
        $option = get_option($string);
    }

    return $option;
}

function ef_render_logo() {
    if ( has_custom_logo() ) {
        echo the_custom_logo();
    } else {
        echo '<div onclick="location.href=\''.site_url().'\';">'.$logo_out = ''.get_bloginfo('name').'</div>';
    }
}

?>