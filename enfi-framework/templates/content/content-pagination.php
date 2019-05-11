<div class="row">
    <div class="col-lg-12">
        <div class="pagination">

        <?php

        global $wp_query;

        $big = 999999999; # need an unlikely integer

        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'show_all'           => false,
            'end_size'           => 1,
            'mid_size'           => 3,
            'prev_next'          => true,
            'prev_text'          => __('<i class="fas fa-chevron-left"></i>'),
            'next_text'          => __('<i class="fas fa-chevron-right"></i>'),
            'type'               => 'plain',
            'add_args'           => false,
            'add_fragment'       => '',
            'before_page_number' => '',
            'after_page_number'  => ''
        ) );

        ?>

        </div>
    </div>
</div>