<?php

if(has_post_thumbnail()) {
    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail = wp_get_attachment_image($thumbnail_id, 'large', '', array( "class" => "thumbnail mr-3" ));
} else {
    $thumbnail = "hat keins";
}

?>

<div <?php post_class('archive-list-1-item'); ?>>

    <div class="d-flex flex-lg-nowrap flex-wrap">

        <div align="left" class="flex-fill">  

            <div class="thumbnail"><?php echo $thumbnail; ?></div>

        </div>

        <div align="left" class="flex-fill">

            <div class="title"><h5><?php the_title(); ?></h5></div>

            <div class="info"><?php the_author(); ?> | <?php echo get_the_date(); ?></div>

            <div class="content"><p><?php the_excerpt(); ?></p></div>

        </div>  

    </div>

</div>
