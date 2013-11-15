<article class="entryPiece">
<header class="entryHeader">
<h1><?php the_title( ); ?></h1>


<?php 
	//:todo
	// section relate article widget
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