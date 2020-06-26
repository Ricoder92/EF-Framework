<?php

################################################################################################################################################## 
### page
##################################################################################################################################################

?>

<?php get_header(); ?>

<?php get_template_part('templates/content', 'title'); ?>  

<?php get_template_part('templates/content', 'before'); ?>  

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part('templates/content', 'loop'); ?>  

    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

<?php else : ?>

    <?php get_template_part('templates/content', 'no-post'); ?>  

<?php endif; ?>

<?php get_template_part('templates/content', 'after'); ?>  

<?php get_footer(); ?>