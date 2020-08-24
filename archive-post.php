    
<?php get_header(); ?>

<?php get_template_part('templates/content', 'title'); ?> 

<?php get_template_part('templates/content', 'before'); ?> 

    <div class="row">

    <div class="col-lg-8">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="archive-list-item">
            
                <div class="title"><h3><?php echo the_title(); ?></h3></div>
                <div class="info"><?php the_author(); ?> | <?php echo get_the_date();?></div>
                <div class="text"><?php echo the_excerpt(); ?></div>
                <div class="tags">Tags: <?php echo ef_print_terms('ef-blog-tags'); ?></div>
                <div class="read-more"><a href="<?php the_permalink(); ?>"><?php _e('READ_MORE', 'ef');?></a></div>

            </div>
    
        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

        <?php else : ?>

            <?php get_template_part('templates/content', 'no-post'); ?> 

        <?php endif; ?>

        <?php get_template_part('templates/content', 'pagination'); ?> 

    </div>

    <div class="col-lg-4">
        <?php if ( is_active_sidebar( 'post' ) ) { ?>
            <?php dynamic_sidebar( 'post' ); ?>
        <?php } ?>
    </div>


    <?php get_template_part('templates/content', 'after'); ?> 

    <?php wp_reset_postdata(); ?>


<?php get_footer(); ?>