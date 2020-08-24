<?php

function ef_slider_render($id) {

    wp_enqueue_style('swiper');
    wp_enqueue_style('swiper-ef');
    wp_enqueue_script('swiper');

    echo '<!-- https://idangero.us/swiper/ <3 -->';

    echo '<div class="ef-swiper-container ef-swiper-container-'.$id.'" style="height: 400px">';

        # slides
        echo '<div class="ef-swiper-wrapper">';
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
        echo '<div class="ef-swiper-pagination"></div>';

        # buttons
        echo '<div class="ef-swiper-button-prev"></div>';
        echo '<div class="ef-swiper-button-next"></div>';

        # scrollbar
        echo '<div class="ef-swiper-scrollbar"></div>';

    echo '</div>';

    ?>
<script>
window.onload = function () {
 
    var slider_<?php echo $id; ?> = new Swiper ('.ef-swiper-container-<?php echo $id; ?>', {

        <?php

        $data = array('direction','speed','grabCursor','freemode','loop','navigation','scrollbar','pagination');
        $meta_data = get_post_meta($id, 'ef-swiper-meta', true);

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
        containerModifierClass:         'ef-swiper-container-',
        wrapperClass:                   'ef-swiper-wrapper',
        slideClass:                     'ef-swiper-slide',
        slideActiveClass:               'ef-swiper-slide-active',
        slideDuplicateActiveClass:      'ef-swiper-slide-duplicate-active',
        slideVisibleClass:              'ef-swiper-slide-visible',
        slideDuplicateClass:            'ef-swiper-slide-duplicate',
        slideNextClass:                 'ef-swiper-slide-next',
        slideDuplicateNextClass:        'ef-swiper-slide-duplicate-next',
        slidePrevClass:                 'ef-swiper-slide-prev',
        slideDuplicatePrevClass:        'ef-swiper-slide-duplicate-prev',

        /* pagination */
        pagination: {
            el:                         '.ef-swiper-pagination',
            type:                       'bullets',
            modifierClass:	            'ef-swiper-pagination-',
            bulletClass:		        'ef-swiper-pagination-bullet',
            bulletActiveClass:	        'ef-swiper-pagination-bullet-active',
            currentClass:	            'ef-swiper-pagination-current',
            totalClass:	                'ef-swiper-pagination-total',
            hiddenClass:	            'ef-swiper-pagination-hidden',
            progressbarFillClass:	    'ef-swiper-pagination-progressbar-fill',
            clickableClass:	            'ef-swiper-pagination-clickable',
            lockClass:	                'ef-swiper-pagination-lock',
            clickable:                  true,
        },

        /* navigation */
        navigation: {
            nextEl:                     '.ef-swiper-button-next',
            prevEl:                     '.ef-swiper-button-prev',
            disabledClass:              'ef-swiper-button-disabled',
            hiddenClass:                'ef-swiper-button-hidden'
        },

        /* scrollbar */
        scrollbar: {
            el:                         '.ef-swiper-scrollbar',
            lockClass:                  'ef-swiper-scrollbar-lock',
            dragClass:                  'ef-swiper-scrollbar-drag',
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