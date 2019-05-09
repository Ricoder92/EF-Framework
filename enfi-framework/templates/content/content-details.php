
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="content-details">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php the_author(); ?> <span class="gutter">\</span> <?php echo get_the_date(); ?>
                    </div>
                </div>
            </div>   
        </div>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>