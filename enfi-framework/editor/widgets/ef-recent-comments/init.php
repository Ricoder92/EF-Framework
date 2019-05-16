<?php

class ef_widget_recent_comments extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ef_widget_recent_comments',
			'description' => __('Display x recent Posts of post type y', 'ef'),
		);
		parent::__construct( 'ef_widget_recent_comments', __('EF Recent Comments', 'ef'), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

        echo $args['before_widget'];
        echo $args['before_title']. apply_filters( 'widget_title', $instance['title'] ) .$args['after_title'];
		
        echo '<ul>';
        
        $args_comments = array(
            'author_email' => '',
            'author__in' => '',
            'author__not_in' => '',
            'include_unapproved' => '',
            'fields' => '',
            'ID' => '',
            'comment__in' => '',
            'comment__not_in' => '',
            'karma' => '',
            'number' => '',
            'offset' => '',
            'orderby' => '',
            'order' => 'DESC',
            'parent' => '',
            'post_author__in' => '',
            'post_author__not_in' => '',
            'post_ID' => '', // ignored (use post_id instead)
            'post_id' => 0,
            'post__in' => '',
            'post__not_in' => '',
            'post_author' => '',
            'post_name' => '',
            'post_parent' => '',
            'post_status' => '',
            'post_type' => $instance['post_type'],
            'status' => 'all',
            'type' => '',
            'type__in' => '',
            'type__not_in' => '',
            'user_id' => '',
            'search' => '',
            'count' => $instance['posts_per_page'],
            'meta_key' => '',
            'meta_value' => '',
            'meta_query' => '',
            'date_query' => null, // See WP_Date_Query
        );

        #$comments = get_comments( $args_comments );

        #print_r($comments);

        #foreach($comments as $comment) {
        #    #echo '<li><a href="'.get_the_permalink($post['ID']).'">'.$post['post_title'].'</a><br/><span class="date">'.get_the_date($post['post_date']).' - '.get_the_author_meta('display_name', $post["post_author"]).'</span></li>';
        #}

		echo '</ul>';

        echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'ef' );
        $post_type = ! empty( $instance['post_type'] ) ? $instance['post_type'] : esc_html__( 'post', 'ef' );
        $posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : esc_html__( '10', 'ef' );

		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ef' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_attr_e( 'Post Type:', 'ef' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>">
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php esc_attr_e( 'Posts', 'ef' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" type="text" value="<?php echo esc_attr( $posts_per_page ); ?>">
		</p>
        <?php 
        
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['post_type'] = ( ! empty( $new_instance['post_type'] ) ) ? sanitize_text_field( $new_instance['post_type'] ) : '';
        $instance['posts_per_page'] = ( ! empty( $new_instance['posts_per_page'] ) ) ? sanitize_text_field( $new_instance['posts_per_page'] ) : '';

		return $instance;
	}
}

// register Foo_Widget widget
function ef_widget_register_recent_comments() {
    register_widget( 'ef_widget_recent_comments' );
}
add_action( 'widgets_init', 'ef_widget_register_recent_comments' );

?>