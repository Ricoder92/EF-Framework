<?php

function ef_slider_render($id) {

    wp_enqueue_style('swiper');
    wp_enqueue_style('swiper-ef');
    wp_enqueue_script('swiper');

    echo '<!-- https://idangero.us/swiper/ <3 -->';

    echo '<div class="ef-slider-container ef-slider-container-'.$id.'" style="height: 400px">';

        # slides
        echo '<div class="ef-slider-wrapper">';
        $args = array(
            'ID'        => $id,
            'post_type'=> 'slider',
        );              
        
            $posts_array = get_posts($args);
            foreach($posts_array as $post)
            {
                echo $post->post_content;
            } 
        echo '</div>';

        # pagination
        echo '<div class="ef-slider-pagination"></div>';

        # buttons
        echo '<div class="ef-slider-button-prev"></div>';
        echo '<div class="ef-slider-button-next"></div>';

        # scrollbar
        echo '<div class="ef-slider-scrollbar"></div>';

    echo '</div>';

    ?>
<script>
window.onload = function () {
 
    var slider_<?php echo $id; ?> = new Swiper ('.ef-slider-container-<?php echo $id; ?>', {

        <?php

        $data = array('direction','speed','grabCursor','freemode','loop','navigation','scrollbar','pagination');
        $meta_data = get_post_meta($id, 'ef-slider-meta', true);

        foreach($data as $meta) {
            ef_slider_get_print_meta($meta, $meta_data);
        }

        ?>

        /* generell */
        direction:                      'horizontal',
        speed:                          300,
        setWrapperSize:                 false,
        autoHeight:                     false,
        roundLengths:                   false,
        nested:                         false,

        /* slides grid */
        spaceBetween:                   0,
        slidesPerView:                  1,
        slidesPerColumn:                1,
        slidesPerColumnFill:            'column',
        slidesPerGroup:                 1,
        centeredSlides:                 false,
        slidesOffsetBefore:             0,
        slidesOffsetAfter:              0,
        normalizeSlideIndex:            true,
        centerInsufficientSlides:       false,

        /* freemode */
        grabCursor:                     false,
        freeMode:                       false,
        freeModeMomentum:               true,
        freeModeMomentumRatio:          1,
        freeModeMomentumVelocityRatio:  1,
        freeModeMomentumBounce:         true,
        freeModeMomentumBounceRatio:    1,
        freeModeMinimumVelocity:        0.02,
        freeModeSticky:                 false,

        /* autoplay */
        autoplay: {
            delay:                      5000,
        },

        /* effect */
        effect:                         'fade',
        
        fadeEffect: {
            crossFade:                  true
        },

        /* loop */
        loop:                           false,

        /* keybinds */
        mousewheel: {
            invert:                     true,
        },
        
        /* classes */
        containerModifierClass:         'ef-slider-container-',
        wrapperClass:                   'ef-slider-wrapper',
        slideClass:                     'ef-slide',
        slideActiveClass:               'ef-slide-active',
        slideDuplicateActiveClass:      'ef-slide-duplicate-active',
        slideVisibleClass:              'ef-slide-visible',
        slideDuplicateClass:            'ef-slide-duplicate',
        slideNextClass:                 'ef-slide-next',
        slideDuplicateNextClass:        'ef-slide-duplicate-next',
        slidePrevClass:                 'ef-slide-prev',
        slideDuplicatePrevClass:        'ef-slide-duplicate-prev',

        /* pagination */
        pagination: {
            el:                         '.ef-slider-pagination',
            type:                       'bullets',
            modifierClass:	            'ef-slider-pagination-',
            bulletClass:		        'ef-slider-pagination-bullet',
            bulletActiveClass:	        'ef-slider-pagination-bullet-active',
            currentClass:	            'ef-slider-pagination-current',
            totalClass:	                'ef-slider-pagination-total',
            hiddenClass:	            'ef-slider-pagination-hidden',
            progressbarFillClass:	    'ef-slider-pagination-progressbar-fill',
            clickableClass:	            'ef-slider-pagination-clickable',
            lockClass:	                'ef-slider-pagination-lock',
            clickable:                  true,
        },

        /* navigation */
        navigation: {
            nextEl:                     '.ef-slider-button-next',
            prevEl:                     '.ef-slider-button-prev',
            disabledClass:              'ef-slider-button-disabled',
            hiddenClass:                'ef-slider-button-hidden'
        },

        /* scrollbar */
        scrollbar: {
            el:                         '.ef-slider-scrollbar',
            lockClass:                  'ef-slider-scrollbar-lock',
            dragClass:                  'ef-slider-scrollbar-drag',
            draggable:                  true,
            snapOnRelease:              true,
        },

    })
};

</script>

<?php


}

function ef_slider_get_print_meta($meta, $meta_data) {


}

?>