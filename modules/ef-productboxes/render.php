<?php

function ef_productboxes_render() {

    wp_enqueue_style('swiper');
    wp_enqueue_script('swiper');

    echo '<div class="row">';

        echo '<div class="col-lg-12">';
            echo '<div class="ef-swiper-container">';

                # slides
                echo '<div class="ef-swiper-wrapper">';

                $args = array(
                    'post_type'=> 'ef-productbox',
                    'orderby' => 'menu_order',
	                'order'=> 'DESC',
                );              
        
                $posts_array = get_posts($args);


                foreach($posts_array as $post)
                {
                    echo '<div class="ef-swiper-slide">';
                        echo '<div class="productbox">';
                            echo '<div class="title"><h3>'.$post->post_title.'</h3></div>';
                            echo '<div class="content">'.$post->post_content.'</div>';
                        echo '</div>';
                    echo '</div>';
                } 
                echo '</div>';

                # pagination
                echo '<div class="ef-swiper-pagination"></div>';



            echo '</div>';
        echo '</div>';

    echo '</div>';

  

    

    ?>
<script>
window.onload = function () {
 
    var slider = new Swiper ('.ef-swiper-container', {

        /* generell */
        direction:                      'horizontal',
        speed:                          300,
        setWrapperSize:                 false,
        autoHeight:                     false,
        roundLengths:                   false,
        nested:                         false,

        /* slides grid */
        spaceBetween:                   10,
        slidesPerColumn:                1,
        slidesPerColumnFill:            'column',
        slidesPerGroup:                 1,
        centeredSlides:                 false,
        slidesOffsetBefore:             0,
        slidesOffsetAfter:              0,
        normalizeSlideIndex:            true,
        centerInsufficientSlides:       false,

        /* freemode */
        grabCursor:                     true,
        freeMode:                       true,
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
        effect:                         'slide',
        
        /* loop */
        loop:                           true,

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

        breakpointsInverse: true,
        breakpoints: {

            320: {
            slidesPerView: 1,
            },
            480: {
            slidesPerView: 1,
            },
            640: {
            slidesPerView: 3,
            }
  }

        /* scrollbar */

    })
};

</script>

<?php


}


?>