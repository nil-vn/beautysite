<?php
/**
 * Comestic functions and definitions
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
 * @since Comestic 1.0
 */
// require_once('widgets/popular_ranking.php');
// require_once('widgets/beauty_category.php');

/**
 * Comestic setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Comestic supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_setup() {
	/*
	 * Makes Comestic available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Comestic, use a find and
	 * replace to change 'beautymobile' to the name of your theme in all
	 * template files.
	 */
	// load_theme_textdomain( 'beautymobile', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	// add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', beautymobile_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'beautymobile' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 200, true );
	add_image_size('mobile-avatar-thumb', 320, 213, true); //custom size
	add_image_size('mobile-sidebar-thumb', 110, 73, true); //custom size
	add_image_size('mobile-category-thumb', 90, 60, true); //custom size
	add_image_size('hotdaily-thumb', 200, 135, true); //custom size

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'beautymobile_setup' );

// fix for menu class

// Truncate string for home page

// setup setting for theme

// add short code for display google custom search

// add short code for display google custom search

// add short code for display all category

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Comestic.
	wp_enqueue_script( 'beautymobile-script1', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-11-11', ! is_home() );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	// wp_enqueue_style( 'beautymobile-fonts', beautymobile_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	// wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'beautymobile-style', get_stylesheet_uri(), array(), '2013-11-21' );

	wp_enqueue_style( 'beautymobile-reset', get_template_directory_uri() . '/css/reset.css', array( 'beautymobile-style' ), '2013-11-21' );
	wp_enqueue_style( 'beautymobile-styles', get_template_directory_uri() . '/css/style.css', array( 'beautymobile-style' ), '2013-11-21' );
	wp_enqueue_style( 'beautymobile-contents', get_template_directory_uri() . '/css/contents.css', array( 'beautymobile-style' ), '2013-11-21' );
	wp_enqueue_style( 'beautymobile-index', get_template_directory_uri() . '/css/index.css', array( 'beautymobile-style' ), '2013-11-21' );

	if (is_home()) {
	wp_enqueue_style( 'beautymobile-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array( 'beautymobile-style' ), '2013-11-21' );
	}

}
add_action( 'wp_enqueue_scripts', 'beautymobile_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Comestic 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function beautymobile_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'beautymobile' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'beautymobile_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'beautymobile' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'beautymobile' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'beautymobile' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'beautymobile' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'beautymobile_widgets_init' );

function beautymobile_customize_preview_js() {
	wp_enqueue_script( 'beautymobile-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'beautymobile_customize_preview_js' );

// add short code for display google custom search
add_shortcode('ads-content', 'ads_content');
function ads_content()
{
	return '';
}

// pagination for nextpage in content

function content_pagination($args = false)
{

	$defaults = array(
		'before'           => '<p>' . __( 'Pages:' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page' ),
		'previouspagelink' => __( 'Previous page' ),
		'pagelink'         => '%',
		'echo'             => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );
	global $page, $numpages, $multipage, $more;


	if ($numpages > 1) {
	$output = '';
	$output .= $before;
	
	if ($page > 1) {
		$output .= content_page_link($page - 1 ,'prevLink' ) . $previouspagelink . '</a>';
	}

	for ( $i = 1; $i <= $numpages; $i++ ) {
		$link = $link_before . str_replace( '%', $i, $pagelink ) . $link_after;
		if ( $i != $page || ! $more && 1 == $page )
			$link = content_page_link( $i , 'pageLink' ) . $link . '</a>';
		else
			$link = '<span class="currentLink">'.$i.'</span>';

		$link = apply_filters( 'wp_link_pages_link', $link, $i );
		$output .= $separator . $link;
	}

	if ($page < $numpages) {
		$output .= content_page_link($page + 1 ,'nextLink' ) . $nextpagelink . '</a>';
	}

	$output .= $after;



	$output = apply_filters( 'wp_link_pages', $output, $args );

	echo $output;
	}

}

// helper function add class for a link in pagination
function content_page_link( $i , $class='') {
	global $wp_rewrite;
	$post = get_post();

	if ( 1 == $i ) {
		$url = get_permalink();
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
			$url = add_query_arg( 'page', $i, get_permalink() );
		elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
			$url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
		else
			$url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
	}

	return '<a class="' . $class . '" href="' . esc_url( $url ) . '">';
}

// add meta data tag for fb and twitter
function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
    echo '<meta property="og:title" content="' . get_the_title() . '"/>';
    echo '<meta name="twitter:title" content="' . get_the_title() . '"/>';
    echo '<meta property="og:url" content="' . get_permalink() . '"/>';
    echo '<meta property="og:description" content="'. wp_html_excerpt($post->post_content,200,' ...').'" />';
    echo '<meta name="twitter:descriptionn" content="'. wp_html_excerpt($post->post_content,200,' ...') .'" />';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://cosmehouse.com/wp-content/themes/beautysimple/img/common/logo.png"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
		echo '<meta name="twitter:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		echo '<meta name="twitter:image"  content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


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



        update_post_meta($postID, $count_key,  intval( $count));
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

function get_rankink_byname($name = '', $limit  = 3)
{

		$result = get_categories( array('child_of' => $name) ); // list child categories
		$arrCat = array( $name);
		foreach ($result as $key => $cat) {
			$arrCat[] = $cat->cat_ID;
			if (! in_array($cat->category_parent, $arrCat)) {
				$arrCat[] = $cat->category_parent;
			}
		}

		return get_rankink( $arrCat ,$limit);
}

function get_rankink($category_ids = array(), $limit  = 3)
{
		$args = array(
		'posts_per_page' => $limit,
		'category__in' => $category_ids,
		'post_type' => 'post',
		'ignore_sticky_posts' => 1,
		'orderby'      => 'meta_value_num',  /* this will look at the meta_key you set below */
		'meta_key'     => 'post_views_count',
		'order'        => 'DESC',
		'post_type'    => 'post',
		'post_status'  => 'publish'
			);

		// get results
		return new WP_Query( $args );
}


function get_articles_byname($name = '', $limit = 5)
{
	// args
	$args = array(
		'posts_per_page' => $limit,
		'category_name' => $name,
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
