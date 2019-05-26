<?php

class EF_Widget_Share_Post extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ef_widget_share_post',
			'description' => __('Share something!', 'ef'),
		);
		parent::__construct( 'ef_widget_share_post', __('EF Share Post', 'ef'), $widget_ops );
	}

	public function widget($args, $instance ) {

        echo $args['before_widget'];
        echo $args['before_title']. apply_filters( 'widget_title', $instance['title'] ) .$args['after_title'];
        
        $title = get_the_title();        
        
        if(is_single())
            $url = get_the_permalink();
        else if(is_archive())    
            $url = get_post_type_archive_link(get_query_var( 'post_type' ));

        $as_icon        = $instance['as_icon'];
        $facebook       = $instance['facebook'];
        $twitter        = $instance['twitter'];
        $email          = $instance['email'];
        $pinterest      = $instance['pinterest'];
        $google_plus    = $instance['google_plus'];
        $linkedin       = $instance['linkedin'];

        $facebook_share_url     = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
        $twitter_share_url      = 'https://twitter.com/intent/tweet?text='.$url;
        $email_share_url        = 'mailto:&subject='.$title.'&body='.$url;
        $pinterest_share_url    = 'https://pinterest.com/pin/create/button/?url='.$url;
        $google_plus_share_url  = 'https://plus.google.com/share?url='.$url;
        $linkedin_share_url     = 'https://www.linkedin.com/shareArticle?mini=true&url='.$url;

        echo '<div class="widget-share-post">';

        if(!$as_icon) {

            echo '<ul>';
            
            if($facebook)
                echo '<li><a target="_BLANK" href="'.$facebook_share_url.'">'.__('Facebook', 'ef').'</a></li>';

            if($twitter)
                echo '<li><a target="_BLANK" href="'.$twitter_share_url.'">'.__('Twitter', 'ef').'</a></li>';

            if($email)
                echo '<li><a target="_BLANK" href="'.$twitter_share_url.'">'.__('E-Mail', 'ef').'</a></li>';

            if($pinterest)
                echo '<li><a target="_BLANK" href="'.$pinterest_share_url.'">'.__('Pinterest', 'ef').'</a></li>';

            if($google_plus)
                echo '<li><a target="_BLANK" href="'.$google_plus_share_url.'">'.__('Google+', 'ef').'</a></li>';

            if($linkedin)
                echo '<li><a target="_BLANK" href="'.$linkedin_share_url.'">'.__('LinkedIn', 'ef').'</a></li>';

            echo '</ul>';

        }

        echo '</div>';

        echo $args['after_widget'];
	}

	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'enfi' );

        $as_icon = $instance['as_icon'];

        $facebook       = $instance['facebook']     ? 'true' : 'false';
        $twitter        = $instance['twitter']      ? 'true' : 'false';
        $email          = $instance['email']        ? 'true' : 'false';
        $pinterest      = $instance['pinterest']    ? 'true' : 'false';
        $google_plus    = $instance['google_plus']  ? 'true' : 'false';
        $linkedin       = $instance['linkedin']  ? 'true' : 'false';


        ?>

        <p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'title', 'ef' ); ?></label> 
		    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['as_icon'], 'on' ); ?> id="<?php echo $this->get_field_id( 'as_icon' ); ?>" name="<?php echo $this->get_field_name( 'as_icon' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'as_icon' ); ?>"><?php _e('Show as Icon', 'ef');?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['facebook'], 'on' ); ?> id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook', 'ef'); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['twitter'], 'on' ); ?> id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter', 'ef'); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['email'], 'on' ); ?> id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('E-Mail', 'ef'); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['pinterest'], 'on' ); ?> id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest', 'ef'); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['google_plus'], 'on' ); ?> id="<?php echo $this->get_field_id( 'google_plus' ); ?>" name="<?php echo $this->get_field_name( 'google_plus' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'google_plus' ); ?>"><?php _e('Google+', 'ef'); ?></label>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['linkedin'], 'on' ); ?> id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn', 'ef'); ?></label>
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
        $instance['as_icon'] = $new_instance['as_icon'];

        $instance['facebook'] = $new_instance['facebook'];
        $instance['twitter'] = $new_instance['twitter'];
        $instance['email'] = $new_instance['email'];
        $instance['instagram'] = $new_instance['instagram'];
        $instance['pinterest'] = $new_instance['pinterest'];
        $instance['google_plus'] = $new_instance['google_plus'];
        $instance['linkedin'] = $new_instance['linkedin'];

		return $instance;
    }
    

}

// register Foo_Widget widget
function ef_widget_register_share_post() {
    register_widget( 'ef_widget_share_post' );
}
add_action( 'widgets_init', 'ef_widget_register_share_post' );

?>