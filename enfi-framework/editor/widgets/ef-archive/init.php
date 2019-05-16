<?php

class EF_Widget_Archive extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ef_widget_archive',
			'description' => 'Display Archive ',
		);
		parent::__construct( 'ef_widget_archive', __('EF Archive', 'ef'), $widget_ops );
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
        $args_archive = array(
            'type'            => 'daily',
            'limit'           => '',
            'format'          => 'html', 
            'before'          => '',
            'after'           => '',
            'show_post_count' => true,
            'echo'            => 1,
            'order'           => 'DESC',
            'post_type'     => apply_filters( 'widget_title', $instance['post-type'] )
        );
		wp_get_archives( $args_archive ); 
		echo '</ul>';

        echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'enfi' );
        $post_type = ! empty( $instance['post-type'] ) ? $instance['post-type'] : esc_html__( 'post', 'enfi' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'enfi' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post-type' ) ); ?>"><?php esc_attr_e( 'Post Type:', 'enfi' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post-type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post-type' ) ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>">
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
        $instance['post-type'] = ( ! empty( $new_instance['post-type'] ) ) ? sanitize_text_field( $new_instance['post-type'] ) : '';

		return $instance;
	}
}

// register Foo_Widget widget
function ef_widget_register_archive() {
    register_widget( 'ef_widget_archive' );
}
add_action( 'widgets_init', 'ef_widget_register_archive' );

?>