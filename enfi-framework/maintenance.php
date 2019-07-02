<?php

################################################################################################################################################## 
### maintenance
##################################################################################################################################################

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php wp_head(); ?>

</head>

<body>

<div class="maintenance-container" style="height:100vh">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div align="center" class="col-lg-12">
                <h1><?php echo ef_maintenance_get_title(); ?></h1>
                <?php echo ef_maintenance_get_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>