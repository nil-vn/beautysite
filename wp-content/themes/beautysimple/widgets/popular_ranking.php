<?php
/**
 * Adds Foo_Widget widget.
 */
class Popular_Ranking_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'popular_ranking', // Base ID
			__('Category ranking', 'beautysite'), // Name
			array( 'description' => __( 'Display number of article in sidebar', 'beautysite' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		
		if ( ! empty( $instance['all'] ) && $instance['all'] )
		{
					$the_query = get_rankink('',$instance['limit']);
		}
		else
		{
					$category = get_the_category();
					
					// fix for display in page
					if (!count($category)) {
						return;
					}
					$cat = $category[0];

					$the_query = get_rankink($cat->cat_ID,$instance['limit']);
		}

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];


		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post();
			?>

				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>


			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		 
		<?php wp_reset_query();  // Restore global post data stomped by the_post().

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'limit' ] ) ) {
			$limit = $instance[ 'limit' ];
		}
		else {
			$limit = 5;
		}

		if ( isset( $instance[ 'all' ] ) ) {
			$all = $instance[ 'all' ];
		}
		else {
			$all = 0;
		}

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'All category:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'all' ); ?>" name="<?php echo $this->get_field_name( 'all' ); ?>" type="checkbox" value="1" <?php checked(1,$all); ?>
 />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
		$instance['all'] = ( ! empty( $new_instance['all'] ) ) ? strip_tags( $new_instance['all'] ) : 0;

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_popular_ranking_widget() {
    register_widget( 'Popular_Ranking_Widget' );
}
add_action( 'widgets_init', 'register_popular_ranking_widget' );

