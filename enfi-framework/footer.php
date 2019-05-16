<?php

################################################################################################################################################## 
### footer
##################################################################################################################################################

ef_register_enqueue_css('footer', 'assets/css/header/footer.css');
ef_register_enqueue_js('footer', 'assets/js/header/footer.js');

?>

<?php if ( is_active_sidebar( 'footer' ) ) { ?>

<div class="footer-default-top">
    <div class="container h-100">
        <div class="row align-items-center h-100">

            <?php dynamic_sidebar( 'footer' ); ?>

        </div>
    </div>
</div>

<?php } ?>


<div class="footer-default-bottom">
    <div class="container h-100">
        <div class="row align-items-center h-100">

            <div class="col-lg-12">
                <?php bloginfo(); ?> <?php _e('© Copyright', 'ef'); ?> <?php echo date('Y'); ?>. <?php _e('All Rights Reserved', 'ef'); ?>
            </div>

        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>

</html>