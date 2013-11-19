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
	 $post_content = $item->post_content;
	 $output = '';
	 $has_teaser = false;

	 if ( preg_match( '/<!--more(.*?)?-->/', $post_content, $matches ) ) {
		$post_content = explode( $matches[0], $post_content, 2 );
		if ( ! empty( $matches[1] ) && ! empty( $more_link_text ) )
			$more_link_text = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );

		$has_teaser = true;
	} else {
		$post_content = array( $post_content );
	}

	$teaser = $post_content[0];

	$output .= $teaser;

	$output = force_balance_tags( $output );


	 echo $output;
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


<?php
	//:todo
	// snb share like bar
?>
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


<?php //todo: share like bar ?>
<!--//.snsBtns-->

<p>Written by: 
<?php the_author_posts_link(); ?></p>

<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
	<?php get_template_part( 'author-bio' ); ?>
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
	 $post_content = $item->post_content;
	 $output = '';
	 $has_teaser = false;

	 if ( preg_match( '/<!--more(.*?)?-->/', $post_content, $matches ) ) {
		$post_content = explode( $matches[0], $post_content, 2 );
		if ( ! empty( $matches[1] ) && ! empty( $more_link_text ) )
			$more_link_text = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );

		$has_teaser = true;
	} else {
		$post_content = array( $post_content );
	}

	$teaser = $post_content[0];

	$output .= $teaser;

	$output = force_balance_tags( $output );


	 echo $output;
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

