<?php 



$comments_args = array(
    'class_form'        => 'comment-form',
    'class_submit'      => 'btn',
    'name_submit'       => 'comments-submit',
    'title_reply'       => '<h4 class="write-a-comment">'.__( 'Leave a Reply' ).'</h4>',
    'title_reply_to'    => '<h4>'.__( 'Leave a Reply to %s' ).'</h4>',
    'title_reply_before' => '',
    'title_reply_after' => '',
    'cancel_reply_before' => '<div class="cancel-a-reply">',
    'cancel_reply_after' => '</div>',
    'label_submit'=>'Kommentar abschicken',
    'comment_notes_after' => '',
    'cancel_reply_link' => 'Antworten abbrechen',
    'comment_field' => '<textarea rows="5" class="comments-textarea" id="comment" name="comment" aria-required="true"></textarea>',
	'logged_in_as' => ''
);


echo "<div class=\" comment\">";
    comment_form( $comments_args ); 
echo "</div>"; ?>



	<?php
		//Gather comments for a specific page/post 
		$comments = get_comments(array(
            'post_id' => get_the_id(),
			'status' => 'approve' //Change this to the type of comments to be displayed
		));

	 $args = array(
	'walker'            => new bruno_walker_comment,
	'max_depth'         => '',
	'style'             => 'div',
	'callback'          => null,
	'end-callback'      => null,
	'type'              => 'all',
	'reply_text'        => 'Auf diesen Kommentar antworten',
	'page'              => '',
	'per_page'          => '',
	'avatar_size'       => 60,
	'reverse_top_level' => null,
	'reverse_children'  => '',
	'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
	'short_ping'        => false,   // @since 3.6
    'echo'              => true     // boolean, default is true
); 
?>

<?php wp_list_comments( $args, $comments ); 



?> 

<?php
class bruno_walker_comment extends Walker_Comment {
	public $tree_type = 'comment';
	public $db_fields = array ('parent' => 'comment_parent', 'id' => 'comment_ID');
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		switch ( $args['style'] ) {
            case 'div':
                $output .= '<div style="margin-left:60px" class="children">' . "\n";
				break;
			case 'ol':
				$output .= '<ol class="children">' . "\n";
				break;
			case 'ul':
			default:
				$output .= '<ul class="children">' . "\n";
				break;
		}
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		switch ( $args['style'] ) {
            case 'div':
                $output .= "</div>";
				break;
			case 'ol':
				$output .= "</ol><!-- .children -->\n";
				break;
			case 'ul':
			default:
				$output .= "</ul><!-- .children -->\n";
				break;
		}
	}
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( !$element )
			return;
		$id_field = $this->db_fields['id'];
		$id = $element->$id_field;
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		/*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
		if ( $max_depth <= $depth + 1 && isset( $children_elements[$id]) ) {
			foreach ( $children_elements[ $id ] as $child )
				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
			unset( $children_elements[ $id ] );
		}
	}
	public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		if ( !empty( $args['callback'] ) ) {
			ob_start();
			call_user_func( $args['callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}
		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		} elseif ( 'html5' === $args['format'] ) {
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		} else {
			ob_start();
			$this->comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
	}
	public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( !empty( $args['end-callback'] ) ) {
			ob_start();
			call_user_func( $args['end-callback'], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}
		if ( 'div' == $args['style'] )
			$output .= "</div><!-- #comment-## -->\n";
		else
			$output .= "</li><!-- #comment-## -->\n";
	}
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
<?php
	}
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link( $comment ) ); ?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
			<?php
				/* translators: 1: comment date, 2: comment time */
				printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
			?>
		</div>

		<?php comment_text( $comment, array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		<?php
		comment_reply_link( array_merge( $args, array(
			'add_below' => $add_below,
			'depth'     => $depth,
			'max_depth' => $args['max_depth'],
			'before'    => '<div class="reply">',
			'after'     => '</div>'
		) ) );
		?>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> class="comment" id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<div id="div-comment-<?php comment_ID(); ?>" class=" comment-body">
                <div class="media">
                    <div class="d-none d-md-block mr-4 avatar"><div class="image" style="background-image: url('<?php if ( 0 != $args['avatar_size'] ) echo get_avatar_url( $comment, $args['avatar_size'] );?>');"></div></div>
                   
				    <div class="media-body">
						<div class="d-flex justify-content-between mb-2 comment-info-container">
							<div><?php printf( __( '%s' ), sprintf( '<span class="comment-author">Kommentar von %s</span>', get_comment_author_link( $comment ) ) ); ?></div>
							<div align="right"><span class="comment-infos"><?php printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ),  get_comment_time() ); ?></span><?php edit_comment_link( __( '<i class="fa fa-pencil" aria-hidden="true"></i>' ), '&nbsp;&nbsp;', '' ); ?></div>
						</div>
						<hr />
					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
			
                
				<div class="d-flex justify-content-end">

				<?php
				comment_reply_link( array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before' => '<div class="comment-replay">',
					'after' => '</div>',
					'reply_text ' => 'Antworten'
				) ) );
				?>

				</div>

    </div>
	</div>

			</div><!-- .comment-body -->
<?php
}}
?>