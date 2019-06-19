<?php get_header(); ?>

<?php get_template_part('templates/content/content', 'cover'); ?> 

<?php get_template_part('templates/content/content', 'before'); ?> 

    <div class="row">

    <div class="col-lg-8">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="blog-item">
            
                <div class="title"><h3><?php echo the_title(); ?></h3></div>
                <div class="author-date"><span class="author"><?php the_author(); ?> | <span class="date"><?php echo get_the_date();?></div>
                <div class="content"><?php echo the_excerpt(); ?></div>
                <div class="tags">Tags: <?php echo ef_print_terms('ef-blog-tags'); ?></div>

            </div>
    
        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

        <?php else : ?>

        <?php get_template_part('templates/content/content', 'no-post'); ?> 
        <?php endif; ?>


        <?php get_template_part('templates/content/content', 'pagination'); ?> 

    </div>

    <div class="col-lg-4">
        <?php if ( is_active_sidebar( 'post-archive-sidebar' ) ) { ?>
            <?php dynamic_sidebar( 'post-archive-sidebar' ); ?>
        <?php } ?>
    </div>


    <?php get_template_part('templates/content/content', 'after'); ?> 

    <?php wp_reset_postdata(); ?>


<?php get_footer(); ?>