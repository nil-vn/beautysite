<article class="entryPiece">
<header class="entryHeader">
<h1><?php the_title( ); ?></h1>
<?php
global $post;
$related_posts = MRP_get_related_posts( $post->ID, 1, 0 );
if( $related_posts ) {
?>
<section class="recommendList">
<h1>関連のおすすめ記事</h1>
<div class="inner">
<ul>
<?php
		$GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up query:',$related_posts,__FILE__,__LINE__ );
foreach( $related_posts as $item  ) {
 ?>
<li><a href="<?php echo get_permalink( $item->ID )   ?>" style="height: 239px;"><span class="entryMark">new</span>
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
<div class="tagMark purple"><div><span>美容と健康</span></div></div>
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




<?php //todo: add section 2  ?>

<!--//.adEntryOut-->


<?php //todo: share like bar ?>
<!--//.snsBtns-->


<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
	<?php get_template_part( 'author-bio' ); ?>
<?php endif; ?>

<!--//.relatedInfo-->



<?php
	//todo: top 10 widgets
 ?>
<!--//.recommendList-->

</article>
<!--//.entryPiece-->