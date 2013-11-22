<?php
/**
 * The template for displaying all single posts
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
$category = get_the_category();
$categorylink = "/category/health";
$subCategoryLink = array();
 $color = "";
  foreach ($category as $key => $cat) {
  	if ($cosmeCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID )) {
  		$color = "cateYellow";
      $categorylink = "/category/cosme";
	  
  	} elseif ($troubleCat->cat_ID == $cat->cat_ID  || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID )) {
  		$color = "cateBlue";
      $categorylink = "/category/trouble";
  	} elseif ($componentCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
  		$color = "catePurple";
      $categorylink = "/category/component";
  	}
    // find sub category
    if (cat_is_ancestor_of( $healthCat->cat_ID, $cat->cat_ID ) || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID ) || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID ) || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
         $subCategoryLink = array('name' => $cat->name , 'url' => $categorylink . '/' . $cat->slug );
      }
  }

  	if($color==""){
	$cat_name = "美容と健康";
	}
	elseif($color=="categoryYellow"){
	$cat_name = "メイク・コスメ";}
	elseif($color=="categoryBlue"){
	$cat_name = "お悩み・効果";}
	else
	$cat_name = "成分・特長";
	  
?>

<section class="wrap pageTypeSingle <?php echo $color; ?>">

<div class="returnLink">
	<a href="<?php echo $categorylink;?>"><?php echo $cat_name;?></a>
</div>
<?php if(have_posts()): while(have_posts()): the_post();?>
<header class="entryHeader">
	<div class="entryInfo">
		<p class="date"><?php echo the_date('Y/m/d');?></p>
		<div class="tagMark"><?php
		if (isset($category[0]))
			echo $category[0]->cat_name;
		?></div>
	</div>
	<!--//.entryInfo-->
	<h1><?php echo the_title();?></h1>
</header>
<section class="entryBody">
	<div class="pic"> <?php the_post_thumbnail( ); ?> </div>

	<?php echo the_content();?>
</section>
<?php
 content_pagination(
	array(
		'before' => '<div class="pagination"><div class="pageMove">',
		'after' => '</div></div>',
		'previouspagelink' => '前のページ',
		'nextpagelink' => '次のページ',
		'next_or_number'=>'number',
		)
);
?>
<!--End Entry body -->
<?php endwhile;endif;?>
</section>

<div class="adBox">
	<?php echo get_option("beautysite_banner_ads_contents") ?>
</div>

<div class="returnLink">
	<a href="<?php echo $categorylink;?>"><?php echo $cat_name;?></a>
</div>
<section class="snsBtns">
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
</section>
<!--//.snsBtns-->

<?php get_footer(); ?>