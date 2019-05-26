<?php

class EF_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ef_widget_recent_posts',
			'description' => __('Display x recent Posts of post type y', 'ef'),
		);
		parent::__construct( 'ef_widget_recent_posts', __('EF Recent Posts', 'ef'), $widget_ops );
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
		
        echo '<ul>';
        
        $args_recent_post = array(
            'numberposts' => $instance['posts_per_page'],
            'offset' => 0,
            'category' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'include' => '',
            'exclude' => '',
            'meta_key' => '',
            'meta_value' =>'',
            'post_type' =>  $instance['post_type'],
            'post_status' => 'publish',
            'suppress_filters' => true
        );
        
        $recent_posts = wp_get_recent_posts( $args_recent_post, ARRAY_A );
        $date_format = get_option( 'date_format' );

        foreach($recent_posts as $post) {
            echo '<li><a href="'.get_the_permalink($post['ID']).'">'.$post['post_title'].'</a><br/><span class="date">'.get_the_date($post['post_date']).'</span></li>';
        }

		echo '</ul>';

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
        $post_type = ! empty( $instance['post_type'] ) ? $instance['post_type'] : esc_html__( 'post', 'ef' );
        $posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : esc_html__( '10', 'ef' );

		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'title', 'ef' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_attr_e( 'Post Type', 'ef' ); ?></label> 
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
function ef_widget_register_last_posts() {
    register_widget( 'ef_widget_recent_posts' );
}
add_action( 'widgets_init', 'ef_widget_register_last_posts' );

?>