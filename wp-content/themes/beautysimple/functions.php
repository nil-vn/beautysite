<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
require_once('widgets/popular_ranking.php');


/* function for page view */

// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    // init value for log and date
    if(get_post_meta($postID, $count_key . 'log', true) == '')
    {
        add_post_meta($postID, $count_key . 'log', '0,0,0,0,0,0,0'); // for a week

    }

    if(get_post_meta($postID, $count_key . 'date', true) == '')
    {
        add_post_meta($postID, $count_key . 'date', date('Y-m-d')); // store a date for checking

    }

    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0 View';
    }
    return $count.' Views';
}

// function to count views for a week
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

 	// init value for log and date
 	$countlog = get_post_meta($postID, $count_key . 'log', true) ;
    if( $countlog == '')
    {
        add_post_meta($postID, $count_key . 'log', '0,0,0,0,0,0,0'); // for a week
        $countlog = '0,0,0,0,0,0,0';
    }
    $countdate = get_post_meta($postID, $count_key . 'date', true);
    if($countdate == '')
    {
        add_post_meta($postID, $count_key . 'date', date('Y-m-d')); // store a date for checking
        $countdate = date('Y-m-d');
    }

    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
    	// check date now
    	if (date('Y-m-d') == $countdate) {
    		$newLogArr = explode(',', $countlog );
    		$newLogArr[6] = $newLogArr[6] +1 ;
    		$count = 0;
    		for ($i=0; $i < 7; $i++) {
    			$count+= $newLogArr[$i];
    		}
    		update_post_meta($postID, $count_key . 'log', implode(',', $newLogArr)); // store a date for checking

    	} else
    	{
    		// if a new day, we will count again and only store 7 day
    		update_post_meta($postID, $count_key . 'date', date('Y-m-d')); // store a date for checking
    		$newLogArr = explode(',', $countlog );
    		$logResult = array();
    		$count = 0;
    		for ($i=1; $i < 7; $i++) {
    			$logResult[] = $newLogArr[$i];
    			$count+= $newLogArr[$i];
    		}

    		// store again
    		$count++;
    		$logResult[] =1;
    		update_post_meta($postID, $count_key . 'log', implode(',', $logResult)); // store a date for checking

		}



        update_post_meta($postID, $count_key, $count);
    }
}

// Add it to a column in WP-Admin - (Optional)
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}

/* function for helper for this theme */

function get_pickup($limit = 3)
{
		$args = array(
			'posts_per_page' => $limit,
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'post_status'  => 'publish',
			'meta_query' => array(
				// 'relation' => 'AND',
				array(
					'key' => 'pick_up',
					'value' => 1,
					'compare' => '='
				),
				// array(
				// 	'key' => 'attendees',
				// 	'value' => 100,
				// 	'type' => 'NUMERIC',
				// 	'compare' => '>'
				// )
			)
		);

		// get results
		return new WP_Query( $args );

}

function get_recommended($limit = 3)
{
		$args = array(
			'posts_per_page' => $limit,
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'post_status'  => 'publish',
			'meta_query' => array(
				// 'relation' => 'AND',
				array(
					'key' => 'recommended',
					'value' => 1,
					'compare' => '='
				),
				// array(
				// 	'key' => 'attendees',
				// 	'value' => 100,
				// 	'type' => 'NUMERIC',
				// 	'compare' => '>'
				// )
			)
		);

		// get results
		return new WP_Query( $args );

}

function get_rankink($category_id = '', $limit  = 3)
{
		$args = array(
		'posts_per_page' => $limit,
		'cat' => $category_id,
		'post_type' => 'post',
		'ignore_sticky_posts' => 1,
		'orderby'      => 'meta_value',  /* this will look at the meta_key you set below */
		'meta_key'     => 'post_views_count',
		'order'        => 'DESC',
		'post_type'    => 'post',
		'post_status'  => 'publish'
			);

		// get results
		return new WP_Query( $args );
}

function get_articles($category_id = '', $limit = 5)
{
	// args
	$args = array(
		'posts_per_page' => $limit,
		'cat' => $category_id,
		'post_type' => 'post',
		'ignore_sticky_posts' => 1,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
        'post_type'    => 'post',
        'post_status'  => 'publish'
	   	);

	// get results
	return new WP_Query( $args );
}


// Register sidebar for content
function beautysite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Post Content Widget Area', 'beautysite' ),
		'id'            => 'sidebar-0',
		'description'   => __( 'Appears in below content section of the site.', 'beautysite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'beautysite_widgets_init' );