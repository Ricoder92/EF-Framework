<?php get_header(); ?>
    
    <?php get_template_part('templates/content/content-before'); ?>  

    <div class="row">

    
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div align="center" class="col-12 col-sm-6 col-md-4 col-lg-3">
            <?php get_template_part('plugins/ef-blog/templates/list-items'); ?>  
        </div>
        <?php endwhile; ?>
    </div>

    <?php else : ?>

    <?php get_template_part('templates/content/content-no-entries'); ?>
        
<?php endif; ?>
    <?php get_template_part('templates/content/content-after'); ?>

    <?php wp_reset_postdata(); ?>

  
<?php wp_enqueue_style('team'); ?>

<?php get_footer(); ?>
