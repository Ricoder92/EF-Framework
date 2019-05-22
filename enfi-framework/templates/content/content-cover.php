<?php

$background_image_id = ef_cover_get_bg_image();
$background_color = ef_cover_get_bg_color();
$title = ef_cover_get_title();

if($background_image_id) {
    $image = 'background-image: url('.wp_get_attachment_url($background_image_id).');';
}

?>


<div class="content-cover" style="<?php echo $image; ?>">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <h1>
                <?php echo $title; ?>
                </h1>
            </div>
        </div>
    </div>
</div>