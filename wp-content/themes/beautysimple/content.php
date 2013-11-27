<article class="entryPiece">
<header class="entryHeader">
<h1><?php the_title( ); ?></h1>
<?php
$healthCat = get_category_by_slug('health' );
$cosmeCat = get_category_by_slug('cosme' );
$troubleCat = get_category_by_slug('trouble' );
$componentCat = get_category_by_slug('component' );
global $post;
$related_posts = MRP_get_related_posts( $post->ID, 1, 0 );
if( $related_posts ) {
?>
<section class="recommendList">
<h1>関連のおすすめ記事</h1>
<div class="inner">
<ul>
<?php
foreach( $related_posts as $item  ) {
 ?>
<li><a href="<?php echo get_permalink( $item->ID )   ?>" style="height: 239px;">
		<?php if (date("Y/m/d") ==  date("Y/m/d", strtotime($item->post_date))) {
			echo '<span class="entryMark">new</span>';
		}
		?>
<div class="pic"><?php
echo get_the_post_thumbnail($item->ID ,'related-thumb');
?></div>
<h2><?php echo $item->post_title; ?></h2>
<p class="txt"><?php

	 // split content if too long
	 echo wp_html_excerpt($item->post_content,35,' ...')  ;

?></p>
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
<div class="tagMark <?php echo $color; ?>"><div><span><?php
		if (isset($category[0]))
			echo $category[0]->cat_name;
		?></span></div></div>
</a></li>
<?php } ?>
</ul>
</div>
</section>
<?php

} // end of recomendList

?>



<div class="snsBtns">
<ul>
<li><a href="http://line.naver.jp/R/msg/text/?LINE%E3%81%A7%E9%80%81%E3%82%8B%0D%0Ahttp%3A%2F%2Fline.naver.jp%2F"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/linebutton.png" width="88" height="20" alt="LINEで送る" /></a></li>
<li><div class="fb-like" data-href="<?php get_permalink()  ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
<li class="twtr"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
<li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="standard-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async></script></li>
</ul>
</div>
<!--//.snsBtns-->

</header>


<section class="entryBody">
<div class="pic"> <?php the_post_thumbnail( ); ?> </div>

<?php
	//todo:
	// ads section inside the post
 ?>

<!--//.adEntryIn-->

<?php the_content( ); ?>

</section>
<!--//.entryBody-->



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
<!-- <div class="pagination">
<div class="pageMove">
<span class="prevLink">前のページ</span>
<span class="currentLink">1</span>
<a href="#" class="pageLink">2</a>
<a href="#" class="pageLink">3</a>
<a href="#" class="nextLink">次のページ</a>
</div>
</div> -->
<!--//.pagination-->




<div class="adEntryOut">
<div class="inner">
    <?php echo get_option("beautysite_banner_ads_contents") ?>
</div>
</div>

<!--//.adEntryOut-->

<div class="snsBtns">
<ul>
<li><a href="http://line.naver.jp/R/msg/text/?LINE%E3%81%A7%E9%80%81%E3%82%8B%0D%0Ahttp%3A%2F%2Fline.naver.jp%2F"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/linebutton.png" width="88" height="20" alt="LINEで送る" /></a></li>
<li><div class="fb-like" data-href="<?php get_permalink( ); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
<li class="twtr"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
<li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="standard-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async></script></li>
</ul>
</div>
<!--//.snsBtns-->


<?php 
	if (get_field('show_author_infor' , get_the_id()) == 1):
 ?>
<aside class="relatedInfo">
<div class="pic">
<img src="<?php
echo get_author_image_url(get_the_author_meta('ID'));
  ?>" width=120 height=120 />
</div>
<div class="txt">
<h1>by <?php the_author_posts_link(); ?></h1>
<?php echo get_the_author_meta( 'description' )  ?>
</div>
</aside>
<?php endif; ?>

<!--//.relatedInfo-->


<?php
$top_daily = tptn_pop_posts( array(
		'is_widget' => FALSE,
		'daily' => TRUE,
		'echo' => FALSE,
		'strict_limit' => TRUE,
		'posts_only' => TRUE, 'limit' => 6)) ;

?>

<?php if (count($top_daily)) { ?>
<section class="recommendList02">
<h1>この記事を読んだ人は、こんな記事も読んでいます</h1>
<ul>
<?php foreach ($top_daily as $key => $dp) {
  // if ($key == 6) {
  // 	break;
  // }
  $item = get_post($dp->ID );
 ?>
<li><a href="<?php echo get_permalink( $item->ID )   ?>">
		<?php if (date("Y/m/d") ==  date("Y/m/d", strtotime($item->post_date))) {
			echo '<span class="entryMark">new</span>';
		}
		?>
<div class="pic"><?php echo get_the_post_thumbnail($item->ID , 'hotdaily-thumb' );?></div>
<h2><?php echo $item->post_title; ?></h2>
<p class="txt"><?php

	 // split content if too long
	 	 echo wp_html_excerpt($item->post_content,35,' ...') ;

?></p>
<footer>
<span class="date">(<?php echo date("Y/m/d", strtotime($item->post_date)) ?>)</span>
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
<div class="tagMark <?php echo $color; ?>"><div><span><?php
		if (isset($category[0]))
			echo $category[0]->cat_name;
		?></span></div></div>
</footer>
</a></li>
<?php } ?>
</ul>
</section>
<!--//.recommendList-->
<?php } ?>
</article>
<!--//.entryPiece-->

