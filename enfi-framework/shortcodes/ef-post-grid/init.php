<?php

function ef_shortcode_post_grid( $atts ) {

    $a = shortcode_atts( array(
        'post_type' => 'post',
        'posts' => '6',
        'col' => '3'
    ), $atts );

    $args = array(
        'posts_per_page'   => $a['posts'],
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => $a['post_type'],
        'post_status'      => 'publish'
    );


    $the_query = new WP_Query( $args );

    #print_r($the_query);

    ob_start();

    echo '<div class="row">';

    if ( $the_query->have_posts() ) :
        # Start the Loop
        while ( $the_query->have_posts() ) : $the_query->the_post();
            echo '<div class="col-lg-'.$a['col'].'"><div class="ef-post-grid">';
                echo '<div class="item">';
                echo '<div class="image"><img src="'.get_the_post_thumbnail_url(get_the_id()).'"/></div>';
                echo '<div class="date">'.__('Posted on ', 'enfi').get_the_date().'</div>';
                echo '<h4>'.get_the_title().'</h4>';
                echo '<p>'.get_the_excerpt().'</p>';
                echo '<button>'.__('Read more', 'enfi').'</button>';
                echo '</div>';
            echo '</div></div>';
        endwhile;

        echo '</div>';
    endif;

    return ob_get_clean();

}

add_shortcode( 'ef-post-grid', 'ef_shortcode_post_grid' );

?>