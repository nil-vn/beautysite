<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>


<?php
$healthCat = get_category_by_slug('health' );
$cosmeCat = get_category_by_slug('cosme' );
$troubleCat = get_category_by_slug('trouble' );
$componentCat = get_category_by_slug('component' );
?>
<section class="wrap pageTypeCategory <?php if (is_category('cosme' ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )) { ?>
cateYellow<?php } else if (is_category('trouble' ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )) { ?>
cateBlue<?php } elseif (is_category('component' ) || cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )) { ?>
catePurple<?php } ?>">

<header class="categoryHeader">
<?php if (is_category('health' )  || cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') ) ) { ?>
<h1>美容と健康<a href="#">＋</a></h1>
<?php } elseif (is_category('cosme' )  || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )) { ?>
<h1>メイク・コスメ<a href="#">＋</a></h1>
<?php } elseif (is_category('trouble' ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )) { ?>
<h1>お悩み・効果<a href="#">＋</a></h1>
<?php } elseif (is_category('component' ) || cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )) { ?>
<h1>成分・特長<a href="#">＋</a></h1>
<?php } ?>
<nav class="subCateNav">
<ul>
<?php 
		 $this_cat = get_category_by_slug('health' ); // get the category of this category archive page
		 if (is_category('cosme' ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )) 
		 {
		 	$this_cat = get_category_by_slug('cosme' ); // get the category of this category archive page
		 } elseif (is_category('trouble' ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )) {
		 	$this_cat = get_category_by_slug('trouble' );
		 } elseif (is_category('component' ) || cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )) {
		 	$this_cat = get_category_by_slug('component' );
		 };
		 wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
		) ); // list child categories
	?>
</ul>
</nav>
<?php if (cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') ) || cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )): ?>
	<h2><?php echo get_query_var('category_name') ?></h2>
<?php endif ?>
</header>
<!--//.categoryHeader-->

<?php if ( have_posts() ) : ?>
	<section class="entryList">

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article class="entryPiece"><a href="detail_blue.html">
		<div class="pic"><?php the_post_thumbnail( 'mobile-category-thumb' ); ?></div>
		<div class="txt">
		<h1><?php if (date("Y/m/d") == get_the_date("Y/m/d" )) {
							echo '<span class="newMark">new</span>';
						}
						?><?php the_title( ); ?></h1>
		<div class="entryPieceTxtFooer">
		<p class="date">（<?php echo get_the_date("Y/m/d" ); ?>）</p>
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
		<div class="tagMark <?php echo $color ?>"><?php
				if (isset($category[0]))
					echo $category[0]->cat_name;
					 ?></div>
		</div>
		<!--//.entryPieceTxtFooer-->
		</div>
		</a></article>


	<?php endwhile; ?>
	<?php

	global $wp_query;
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
	?>
	<?php endif; ?>
	</section>
		<article class="snsBtns">
		<h1>最新情報ゲットはこちら！</h1>
		<ul>

		<li>
		<div class="icon"><a href="https://twitter.com/cosme_house"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_twitter.png" alt="twitter" width="61" height="61"></a></div>
		<div class="account">
		<h2>twitter公式アカウント</h2>
		<div class="btn"><a href="https://twitter.com/cosme_house" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large">@twitterさんをフォロー</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
		</div>
		</li>

		<li>
		<div class="icon"><a href="https://www.facebook.com/cosmehousecom"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_facebook.png" alt="facebook" width="61" height="61"></a></div>
		<div class="account">
		<h2>facebook公式ページ</h2>
		<div class="btn"><div class="fb-like" data-href="https://www.facebook.com/cosmehousecom" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
		</div>
		</li>

		</ul>
		</article>
		<!--//.snsBtns-->


		<div class="adBox">
   		<?php echo get_option("beautysite_banner_ads_contents") ?>
		</div>
		<!--//.adBox-->
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>


<!--//.contentsWrap-->
<?php get_footer(); ?>