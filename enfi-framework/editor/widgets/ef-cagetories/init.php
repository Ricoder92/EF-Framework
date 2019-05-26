<?php

class EF_Widget_Categories extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ef_widget_categories',
			'description' => 'Display Archive ',
		);
		parent::__construct( 'ef_widget_categories', __('EF Categories', 'ef'), $widget_ops );
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

		echo $args['before_content'];

        $terms = get_terms( array(
            'taxonomy' => $instance['category'],
            'hide_empty' => true,
            'orderby' => 'count',
            'order' => 'DESC',
            'count' => true
        ) );

        echo '<ul class="widget-category category-'.$instance['category'].'">';
        foreach($terms as $tag) {
            echo '<li class="term"><a href="'.get_term_link($tag).'">'.$tag->name.' ('.$tag->count.')</a></li>';
        }
		echo "</ul>";
		
		echo $args['after_content'];
		
        echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'ef' );
        $post_type = ! empty( $instance['category'] ) ? $instance['category'] : esc_html__( 'post', 'enfi' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'title', 'ef' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_attr_e( 'Category:', 'ef' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>">
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
        $instance['category'] = ( ! empty( $new_instance['category'] ) ) ? sanitize_text_field( $new_instance['category'] ) : '';

		return $instance;
	}
}

// register Foo_Widget widget
function ef_widget_register_category() {
    register_widget( 'ef_widget_categories' );
}
add_action( 'widgets_init', 'ef_widget_register_category' );

?>