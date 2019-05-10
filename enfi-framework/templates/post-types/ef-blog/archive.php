<?php get_header(); ?>
<?php wp_enqueue_style('ef-blog-blog'); ?>
<div class="content-wrapper">
    <div class="container">

            <div class="row">
        
                <div class="col-lg-8">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="blog-item">
                        
                            <div class="title"><h3><?php echo the_title(); ?></h3></div>
                            <div class="content"><p><?php echo the_excerpt(); ?></p></div>

                        </div>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                <?php else : ?>
                        <?php get_template_part('templates/content/content-no-entries'); ?>
                <?php endif; ?>
                </div>

                <div class="col-lg-4">
                
                </div>
            </div>

    </div>
</div>

<?php get_footer(); ?>