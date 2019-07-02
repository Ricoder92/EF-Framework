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
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <h1><?php echo ef_maintenance_get_title(); ?></h1>
                <?php echo ef_maintenance_get_content(); ?>
            </div>
        </div>
    </div>
</div>


<?php wp_footer(); ?>
</body>

</html>