<?php

# load all widgets and register it
foreach(glob(get_template_directory() . "/shortcodes/*/init.php") as $file){
    require_once $file;
}

?>
