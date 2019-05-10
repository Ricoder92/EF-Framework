<?php ef_layout_get_template('header'); ?>

<?php if ( have_posts() ) : ?>

    <?php get_template_part('templates/content/content-before'); ?>  

    <?php while ( have_posts() ) : the_post(); ?>
      

    <?php endwhile; ?>

    <?php get_template_part('templates/content/content-after'); ?>

    <?php wp_reset_postdata(); ?>

    <?php else : ?>
            <?php get_template_part('templates/content/news-no-entries'); ?>
<?php endif; ?>



<?php ef_layout_get_template('footer'); ?>