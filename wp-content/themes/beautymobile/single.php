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

<section class="snsBox">
<ul>
<li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
<li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async></script></li>
<li><a href="http://line.naver.jp/R/msg/text/?LINE%E3%81%A7%E9%80%81%E3%82%8B%0D%0Ahttp%3A%2F%2Fline.naver.jp%2F"><img src="<?php echo get_template_directory_uri() ?>/img/contents/linebutton_v.png" width="36" height="60" alt="LINEで送る" /></a></li>
</ul>
</section>
<!--//.snsBox-->

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

<div class="adBox">
	<?php echo get_option("beautysite_banner_ads_contents") ?>
</div>

<section class="snsBox">
<ul>
<li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
<li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async></script></li>
<li><a href="http://line.naver.jp/R/msg/text/?LINE%E3%81%A7%E9%80%81%E3%82%8B%0D%0Ahttp%3A%2F%2Fline.naver.jp%2F"><img src="<?php echo get_template_directory_uri() ?>/img/contents/linebutton_v.png" width="36" height="60" alt="LINEで送る" /></a></li>
</ul>
</section>
<!--//.snsBox-->


<div class="returnLink">
	<a href="<?php echo $categorylink;?>"><?php echo $cat_name;?></a>
</div>
<?php
global $post;
$related_posts = MRP_get_related_posts( $post->ID, 1, 0 );
if( $related_posts ) {
?>
<section class="recommendBox">
<h1>関連するおすすめ記事</h1>
<ul>
<?php
foreach( $related_posts as $item  ) {
 ?>
<li><a href="<?php echo get_permalink( $item->ID )   ?>">
<div class="pic"><?php
echo get_the_post_thumbnail($item->ID ,'hotdaily-thumb');
?></div>
<div class="txt">
<?php
$category = get_the_category($item->ID);
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
<div class="tagMark <?php echo $color; ?>"><?php
		if (isset($category[0]))
			echo $category[0]->cat_name;
		?></div>
		<h2><?php echo $item->post_title; ?></h2>
</div>
<!--//.txt-->
</a></li>
<?php } ?>

</ul>
</section>
<!--//.recommendBox-->
<?php } ?>
</section>
<!--//.wrap-->


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

<div class="adBox">
Implement ads soon !
</div>
<!--//.adBox-->

<?php get_footer(); ?>