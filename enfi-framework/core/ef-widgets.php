<?php

# load all widgets and register it
foreach(glob(get_template_directory() . "/widgets/*/init.php") as $file){
    require_once $file;
}

?>
