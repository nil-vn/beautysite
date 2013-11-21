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
	set_post_thumbnail_size( 600, 400, true );
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

if ( ! function_exists( 'beautymobile_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'beautymobile' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'beautymobile' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'beautymobile' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'beautymobile_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Comestic 1.0
*
* @return void
*/
function beautymobile_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'beautymobile' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'beautymobile' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'beautymobile' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'beautymobile_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own beautymobile_entry_meta() to override in a child theme.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'beautymobile' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		beautymobile_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'beautymobile' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'beautymobile' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'beautymobile' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'beautymobile_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own beautymobile_entry_date() to override in a child theme.
 *
 * @since Comestic 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function beautymobile_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'beautymobile' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'beautymobile' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'beautymobile_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Comestic 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'beautymobile_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Comestic 1.0
 *
 * @return string The Link format URL.
 */
function beautymobile_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Comestic 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function beautymobile_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'beautymobile_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'beautymobile_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Comestic 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function beautymobile_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'beautymobile_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautymobile_customize_preview_js() {
	wp_enqueue_script( 'beautymobile-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'beautymobile_customize_preview_js' );





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