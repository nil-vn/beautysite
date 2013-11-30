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
require_once('widgets/popular_ranking.php');
require_once('widgets/beauty_category.php');

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
function beautysite_setup() {
	/*
	 * Makes Comestic available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Comestic, use a find and
	 * replace to change 'beautysite' to the name of your theme in all
	 * template files.
	 */
	// load_theme_textdomain( 'beautysite', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	// add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', beautysite_fonts_url() ) );

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
	// add_theme_support( 'post-formats', array(
	// 	'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	// ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'beautysite' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 400, true );
	add_image_size('avatar-thumb', 300, 200, true); //custom size
	add_image_size('sidebar-thumb', 126, 82, true); //custom size
	add_image_size('related-thumb', 150, 100, true); //custom size
	add_image_size('hotdaily-thumb', 200, 135, true); //custom size
	add_image_size('author-thumb', 120, 120, true); //custom size

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'beautysite_setup' );

// fix for menu class
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if ( stripos($item->url, "health") !== false ) {
     	$classes = array('nav01');
     }

     if ( stripos($item->url, "cosme") !== false ) {
     	$classes = array('nav02');
     }

     if ( stripos($item->url, "trouble") !== false ) {
     	$classes = array('nav03');
     }

     if ( stripos($item->url, "component") !== false ) {
     	$classes = array('nav04');
     }

     return $classes;
}

// Truncate string for home page

function custom_excerpt_length( $length ) {
	if (is_home()) {
		return 10;
	}
	else return 32;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

class beautysite_walker_nav_menu extends Walker_Nav_Menu {

// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $category_ids = array();
    if (is_singular()) {
    	$category = get_the_category();
    	foreach ($category as $key => $cat) {
    		$category_ids[] = $cat->cat_ID;
    	}
    }
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // build html
    $output .=  '<li class="' . $class_names . '">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    // check active category
	if (is_category( $item->title ) || cat_is_ancestor_of( $item->object_id, get_query_var('cat') )) {
     $attributes .= ' class="active"';
    }

    if (count($category_ids)) {
    	if ($item->object_id == $category_ids[0] || cat_is_ancestor_of( $item->object_id,  $category_ids[0]  )) {
	     $attributes .= ' class="active"';
	    }
    }

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
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
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		echo '<meta name="twitter:image"  content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


// setup setting for theme
function setup_theme_admin_menus() {
    add_submenu_page('themes.php',
    'setting-beauty', 'Settings', 'manage_options',
    'setting-beauty-elements', 'theme_all_page_settings');

}

function theme_all_page_settings() {

	// init js
	wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

	// Check that the user is allowed to update options
	if (!current_user_can('manage_options')) {
	    wp_die('You do not have sufficient permissions to access this page.');
	}

	$gcs_keys = get_option("beautysite_gcs_keys");
	$gads_keys = get_option("beautysite_gads_keys");
	$fads_keys = get_option("beautysite_fads_keys");
	$banner_ads_contents = get_option("beautysite_banner_ads_contents");
	if (isset($_POST["update_settings"])) {
		$gcs_keys = esc_attr($_POST["gcs_keys"]);
		update_option("beautysite_gcs_keys", $gcs_keys);

		$gads_keys =  stripslashes_deep($_POST["gads_keys"]) ;
		update_option("beautysite_gads_keys", $gads_keys);

		$fads_keys =  stripslashes_deep($_POST["fads_keys"]) ;
		update_option("beautysite_fads_keys", $fads_keys);

		$banner_ads_contents = stripslashes_deep($_POST["banner_ads_contents"]);
		update_option("beautysite_banner_ads_contents", $banner_ads_contents);

		?>
		    <div id="message" class="updated">Settings saved</div>
		<?php
	}

?>
    <div class="wrap">
    <?php screen_icon('themes'); ?> <h2>Setting page</h2>

    <form method="post" action="">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="gcs_keys">
                        Google custom search key:
                    </label>
                </th>
                <td>
                    <input type="text" name="gcs_keys" size="40" value="<?php echo $gcs_keys ?>" />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="gads_keys">
                        Google adsent embed code:
                    </label>
                </th>
                <td>
                	<textarea class="widefat" name="gads_keys" cols="80" rows="4"><?php echo $gads_keys ?></textarea>
                </td>
            </tr>  
            <tr valign="top">
                <th scope="row">
                    <label for="fads_keys">
                        Footer Ads embed code:
                    </label>
                </th>
                <td>
                	<textarea class="widefat" name="fads_keys" cols="80" rows="4"><?php echo $fads_keys ?></textarea>
                </td>
            </tr>
            <tr valign="top">
            	<th scope="row">
                    <label for="gads_keys">
                        Ads sections in below content
                    </label>
                </th>
                <td>
            	     <textarea class="widefat" name="banner_ads_contents" cols="80" rows="4"><?php echo $banner_ads_contents ?></textarea>

	       		</td>
	       </tr>

        </table>
        <input type="hidden" name="update_settings" value="Y" />
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    </form>
    <script type="text/javascript">
    jQuery(function($) {
	    $('.upload-button').live('click', function(e) {
	        window.adcode_id      = $(e.target).attr('rel');
	        window.send_to_editor = image_upload_handler;

	        tb_show('', 'media-upload.php?type=image&amp;amp;amp;TB_iframe=true');

	        return false;
	    });

	    function image_upload_handler(html) {
	        imgurl = $('img',html).attr('src');
	        if(!imgurl) imgurl = $(html).attr('src');
	        $('#upload_img').val(imgurl);

	        tb_remove();
	    };
	});
    </script>
</div>

<?php
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

// This tells WordPress to call the function named "setup_theme_admin_menus"
// when it's time to create the menu pages.
add_action("admin_menu", "setup_theme_admin_menus");

// add short code for display google custom search
add_shortcode('ads-content', 'ads_content');
function ads_content()
{
	if (! is_single()) {
		return '';
	}
  	$content = '<div class="adEntryIn"><div class="inner">' .get_option("beautysite_gads_keys") . '</div></div>';
  	ob_start();
	eval("?>$content<?php ");
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode('category-sitemap', 'category_sitemap');
function category_sitemap()
{
ob_start();

?>
<ul class="first">
<li><a href="/">トップページ</a></li>
<li>
	<a href="/category/health">美容と健康</a>
	<ul class="second">
	<?php 
		 $this_cat = get_category_by_slug('health' ); // get the category of this category archive page
	  	 $result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		 foreach ($result as $key => $cat) {
		 	echo '<li><a  href="' . get_category_link( $cat->term_id ) . '">- ' . $cat->name . '</a></li>';
		 }
	?>
	</ul>
</li>
<li><a href="/category/cosme">メイク・コスメ</a>
	<ul class="second">
	<?php 
		 $this_cat = get_category_by_slug('cosme' ); // get the category of this category archive page
		 $result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		 foreach ($result as $key => $cat) {
		 	echo '<li><a  href="' . get_category_link( $cat->term_id ) . '">- ' . $cat->name . '</a></li>';
		 }
	?>
	</ul>
</li>

<li><a href="/category/trouble">お悩み・効果</a>
	<ul class="second">
	<?php 
		 $this_cat = get_category_by_slug('trouble' ); // get the category of this category archive page
	 	$result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		 foreach ($result as $key => $cat) {
		 	echo '<li><a  href="' . get_category_link( $cat->term_id ) . '">- ' . $cat->name . '</a></li>';
		 }
	?>
	</ul>
</li>

<li><a href="/category/component">成分・特徴</a>
	<ul class="second">
	<?php 
		 $this_cat = get_category_by_slug('component' ); // get the category of this category archive page
	 	$result = get_categories( array('child_of' => $this_cat->cat_ID) ); // list child categories
		 foreach ($result as $key => $cat) {
		 	echo '<li><a  href="' . get_category_link( $cat->term_id ) . '">- ' . $cat->name . '</a></li>';
		 }
	?>
	</ul>
</li>

</ul>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

// add short code for display google custom search
add_shortcode('search_result', 'search_result');
function search_result()
{
?>
<section class="entryList">
	<?php
		//var_dump($_GET['q']);
		$str = 's='.$_GET['q'];
		$query = new WP_Query($str);
		//var_dump($query->found_posts);
		if($query->have_posts()){
			while ($query->have_posts()) {
				$query->the_post();?>
				<article class="entryPiece">
					<a href="<?php the_permalink(); ?>">
					<header class="entryHeader">
						<div class="entryInfo">
							<span class="entryDate"><?php echo get_the_date("Y/m/d" ); ?></span>
						</div>
						<h1><?php the_title( ); ?></h1>
					</header>
					<div class="entryOverview">
						<div class="pic"> <?php the_post_thumbnail( array(300,200) ); ?></div>
						<div class="txt">
							<?php the_content('',FALSE,'');
							//the_excerpt_max_charlength(140);
							?>
							<div class="viewMore"><span>続きを見る</span></div>
						</div>
					</div>
		<!--//.entryOverview-->
					</a>
				</article>
			

		<?php 
			}
		}
		else{
			echo "Not found ...";
		}?>
</section>
<?php
}

// add short code for display all category
add_shortcode('all_category', 'all_category_page');

function all_category_page()
{
	$healthCat = get_category_by_slug('health' );
	$cosmeCat = get_category_by_slug('cosme' );
	$troubleCat = get_category_by_slug('trouble' );
	$componentCat = get_category_by_slug('component' );
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args= array(
		'paged' => $paged
	);
	global $wp_query;
	$tmp_query = $wp_query;
	query_posts($args);
	// fix for more tag in page
	global $more;
	$more = 0;

?>
	<?php if ( have_posts() ) : ?>
	<section class="entryList">

	<?php while ( have_posts() ) : the_post(); ?>
		<article class="entryPiece">
			<a href="<?php the_permalink(); ?>">
		<header class="entryHeader">
		<div class="entryInfo">
		<span class="entryDate"><?php echo get_the_date("Y/m/d" ); ?></span>
		<?php if (date("Y/m/d") == get_the_date("Y/m/d" )) {
			echo '<span class="entryMark">new</span>';
		}
		?>
		</div>
		<!--//.entryInfo-->
		<h1><?php the_title( ); ?></h1>
		</header>

		<div class="entryOverview">
		<div class="pic"> <?php the_post_thumbnail( 'avatar-thumb' ); ?> </div>
		<div class="txt">
		<?php
		$category = get_the_category();
		 $color = "";
		  foreach ($category as $key => $cat) {
		  	if ($cosmeCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID )) {
		  		$color = "yellow";
		  	} elseif ($troubleCat->cat_ID == $cat->cat_ID  || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID )) {
		  		$color = "blue";
		  	} elseif ($componentCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
		  		$color = "purple";
		  	}
		  }
		?>
		<div class="tagMark <?php echo $color ?>"><div><span><?php
		if (isset($category[0]))
			echo $category[0]->cat_name;
		?></span></div></div>
		<?php the_content('',FALSE,'');?>
		<div class="viewMore"><span>続きを見る</span></div>
		</div>
		</div>
		<!--//.entryOverview-->
		</a></article>

	<?php endwhile; ?>
	</section>
	<?php

 	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages >= 2 ):
		if(function_exists('wp_paginate')) {
		    echo '<div class="pagination">';
		     wp_paginate();
		     $current_page = isset( $wp_query->query['paged']) ?  $wp_query->query['paged'] :1;
		     $total_items = $wp_query->found_posts;
		     $items_per_page = $wp_query->query_vars['posts_per_page'];
		     $from = ($current_page-1)* $items_per_page +1;
		     $to = ($current_page == $wp_query->max_num_pages)? $total_items : $current_page * $items_per_page  ;
		     echo '<p class="status">'.$total_items.'件中 '. $from  .' - '.$to.' を表示</p>';
		    echo  '</div>';
		}
		elseif (function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
		}
		else
		{
		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
		}
	 endif;
	 endif;
	 $wp_query = $tmp_query;

}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautysite_scripts_styles() {
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
	wp_enqueue_script( 'beautysite-script1', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-11-25', ! is_home() );
	wp_enqueue_script( 'beautysite-script2', get_template_directory_uri() . '/js/jquery.tile.js', array( 'jquery' ), '2013-11-11', ! is_home() );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	// wp_enqueue_style( 'beautysite-fonts', beautysite_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	// wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'beautysite-style', get_stylesheet_uri(), array(), '2013-11-11' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'beautysite-common', get_template_directory_uri() . '/css/common.css', array( 'beautysite-style' ), '2013-11-25' );
	wp_enqueue_style( 'beautysite-contents', get_template_directory_uri() . '/css/contents.css', array( 'beautysite-style' ), '2013-11-25' );
	wp_enqueue_style( 'beautysite-index', get_template_directory_uri() . '/css/index.css', array( 'beautysite-style' ), '2013-11-15' );
	// wp_style_add_data( 'beautysite-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'beautysite_scripts_styles' );

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
function beautysite_wp_title( $title, $sep ) {
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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'beautysite' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'beautysite_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Comestic 1.0
 *
 * @return void
 */
function beautysite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'beautysite' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'beautysite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'beautysite' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'beautysite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'beautysite_widgets_init' );


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
function beautysite_customize_preview_js() {
	wp_enqueue_script( 'beautysite-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'beautysite_customize_preview_js' );





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
// add_filter('manage_posts_columns', 'posts_column_views');
// add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
// function posts_column_views($defaults){
//     $defaults['post_views'] = __('7 Days Views');
//     return $defaults;
// }
// function posts_custom_column_views($column_name, $id){
// 	if($column_name === 'post_views'){
//         echo getPostViews(get_the_ID());
//     }
// }

// Register the column as sortable
function author_column_register_sortable( $columns ) {
    $columns['author'] = 'author';

    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'author_column_register_sortable' );


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
/**
* Function create a tagMark for the post (color tag, category name).
* Return string $color, string $cat_name.
* Note: This function may be used inside of The Loop, to use post_id.
*/
function get_tagMark(){
$healthCat = get_category_by_slug('health' );
$cosmeCat = get_category_by_slug('cosme' );
$troubleCat = get_category_by_slug('trouble' );
$componentCat = get_category_by_slug('component' );

$category = get_the_category(); 
$color = "";
foreach ($category as $key => $cat) {
if ($cosmeCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID )) {
$color = "yellow";
} elseif ($troubleCat->cat_ID == $cat->cat_ID  || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID )) {
$color = "blue";
} elseif ($componentCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
$color = "purple";
}
}
if (isset($category[0])){
$cat_name = $category[0]->cat_name;}
echo "<div class='tagMark ".$color."'><div><span>".$cat_name."</span></div></div>";
}
function hello(){
	return "hello";}
