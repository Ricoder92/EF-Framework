<?php get_header(); ?>

<?php get_template_part('templates/content/content-before'); ?>  

<div class="row">
    <div class="col-lg-12">
        <div class="content-post-404">
            
            <?php 

            $id = ef_get_option('debug'); 
            $id = $id['404-page'];

            if(isset($id)) {
                $post = get_post($id); 
                $content = apply_filters('the_content', $post->post_content); 
                echo $content; 
            } else 
                echo '<h1>404</h1>';
                
            ?>

        </div>
    </div>
</div>


<?php get_template_part('templates/content/content-after'); ?>

<?php get_footer(); ?>