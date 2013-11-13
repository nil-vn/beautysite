<?php
/**
 * Adds Foo_Widget widget.
 */
class Beauty_Category_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'beauty_category', // Base ID
			__('Beauty category', 'beautysite'), // Name
			array( 'description' => __( 'Display list of category in sidebar', 'beautysite' ), ) // Args
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
		?>
		<section class="tagLinksArea">
		<h1 class="sideTtl"><?php echo $title ?></h1>
		<div class="tagLinks">
		<h2><span>美容と健康</span></h2>
		<div class="inner">
		<?php 
			 $this_cat = get_category_by_slug('health' ); // get the category of this category archive page
		  	 $result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		  	 foreach ($result as $key => $cat) {
		  	 	echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
		  	 }
		?>
		</div>
		</div>

		<div class="tagLinks yellow">
		<h2><span>メイク・コスメ</span></h2>
		<div class="inner">
		<?php 
			 $this_cat = get_category_by_slug('cosme' ); // get the category of this category archive page
			$result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		  	 foreach ($result as $key => $cat) {
		  	 	echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
		  	 }		?>
		</div>
		</div>

		<div class="tagLinks blue">
		<h2><span>お悩み・効果</span></h2>
		<div class="inner">
		<?php 
			 $this_cat = get_category_by_slug('trouble' ); // get the category of this category archive page
			$result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		  	 foreach ($result as $key => $cat) {
		  	 	echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
		  	 }		?>
		</div>
		</div>

		<div class="tagLinks purple">
		<h2><span>成分・特徴</span></h2>
		<div class="inner">
		<?php 
			 $this_cat = get_category_by_slug('component' ); // get the category of this category archive page
			 $result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		  	 foreach ($result as $key => $cat) {
		  	 	echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
		  	 }		?>
		</div>
		</div>

		<!--//.tagLinks-->
		</section>
		<?php 

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

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

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_beauty_category_widget() {
    register_widget( 'Beauty_Category_Widget' );
}
add_action( 'widgets_init', 'register_beauty_category_widget' );

