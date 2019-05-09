<?php
    $post_type_obj = get_post_type_object( get_post_type() );
    $title = $post_type_obj->labels->name;
?>

<div class="archive-title">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-lg-6"><h1><?php echo $title; ?></h1></div>
            <div class="col-lg-6"><div class="breadcrumbs"><?php ef_layout_breadcrumbs(); ?></div></div>
        </div>
    </div>
</div>