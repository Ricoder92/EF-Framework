    
<?php get_header(); ?>

<?php get_template_part('templates/content/content', 'title'); ?> 

<?php get_template_part('templates/content/content', 'before'); ?> 

    <div class="row">

    <div class="col-lg-8">

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php
        
        $tags = ef_print_terms('post_tag');
        $cats = ef_print_terms('category');
        ?>

            <div class="blog-item">
            
                <div class="author-date">
                    <span class="author"><?php the_author(); ?></span>
                    <span class="date"><?php echo get_the_date();?>
                </div>
                <div class="title"><h3><?php echo the_title(); ?></h3></div>
                <div class="content"><?php echo the_excerpt(); ?></div>

            

                <?php 

if($tags)
    echo '<div class="tags">Tags: '.$tags.'</div>';
?>
  
<div class="d-flex align-items-center">

<div align="left" class="flex-fill">  
    <a href="<?php the_permalink(); ?>" class="read-more"><?php _e('read more', 'ef');?></a>
</div>

<div align="right" class="flex-fill">
    <div class="author-date">487 Kommentare</div>
</div>  

</div>


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