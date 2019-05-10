<?php get_header(); ?>

<?php wp_enqueue_style('ef-blog-blog'); ?>

<?php get_template_part('templates/content/content-before'); ?>  

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
        
        <h3><?php echo the_title(); ?></h3>
        <p><?php echo the_excerpt(); ?></p>

    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

<?php else : ?>
        <?php get_template_part('templates/content/content-no-entries'); ?>
<?php endif; ?>

<?php get_template_part('templates/content/content-after'); ?>

<?php get_footer(); ?>