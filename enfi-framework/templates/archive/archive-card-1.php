<?php

if(has_post_thumbnail()) {
    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail = wp_get_attachment_image($thumbnail_id, 'large', '', array( "class" => "thumbnail mr-3" ));
} else {
    $thumbnail = "hat keins";
}

?>

<div <?php post_class('archive-card-1-item'); ?> id="post-<?php get_the_id(); ?>" onclick="location.href='<?php the_permalink() ?>';">
    <div class="thumbnail"><?php echo $thumbnail; ?></div>
    <div class="title"><h5><?php the_title(); ?></h5></div>
    <div class="content"><p><?php the_excerpt(); ?></p></div>
    <div class="info">
        <div class="d-flex">
            <div align="left" class="flex-fill"><?php echo get_the_date(); ?></div>
            <div align="right" class="flex-fill"><?php the_author(); ?></div>
        </div>  
    </div>
</div>

