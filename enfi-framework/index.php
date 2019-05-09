<?php get_header(); ?>

<?php get_template_part('templates/content/content-title-breadcrumbs'); ?>  

<?php get_template_part('templates/content/content-before'); ?>  

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('templates/content/content-simple'); ?>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

<?php else : ?>
        <?php get_template_part('templates/content/content-no-entries'); ?>
<?php endif; ?>

<?php get_template_part('templates/content/content-after'); ?>

<?php get_footer(); ?>