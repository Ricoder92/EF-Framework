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

?>