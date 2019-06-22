<?php

################################################################################################################################################## 
### 404 Page
##################################################################################################################################################

?>

<?php get_header(); ?>

<?php get_template_part('templates/content', 'before'); ?>  

<div class="row">
    <div class="col-lg-12">
        <div class="content-post-404">
            
            <?php echo ef_404_get_content(); ?>

        </div>
    </div>
</div>


<?php get_template_part('templates/content', 'after'); ?>

<?php get_footer(); ?>