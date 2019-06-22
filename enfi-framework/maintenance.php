<?php

################################################################################################################################################## 
### maintenance
##################################################################################################################################################

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <title><?php _e('MAINTENANCE_MODE_503', 'ef'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body>

<div class="maintenance-container">
    <h1><?php echo ef_maintenance_get_title(); ?></h1>
    <?php echo ef_maintenance_get_content(); ?>
</div>



<?php wp_footer(); ?>
</body>

</html>