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



<div class="contentsWrap pageTypeCategory">
<div class="contentsWrapInner">
<div class="contents">


<div class="layout2Col">

<div class="mainCol">

<header class="mainColHeader">
<ol class="topicPath">
<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></li>
<?php if (is_category('health' )) { ?>
<li>美容と健康</li>
<?php } else if (is_category('cosme' )) { ?>
<li>お悩み・効果</li>
<?php } else if (is_category('trouble' )) { ?>
<li>お悩み・効果</li>
<?php } elseif (is_category('component' )) { ?>
<li>成分・特長</li>
<?php } ?>
</ol>
<div class="pageTtl">
<?php if (is_category('health' )) { ?>
<h1>美容と健康</h1>
<?php } elseif (is_category('cosme' )) { ?>
<h1>お悩み・効果</h1>
<?php } elseif (is_category('trouble' )) { ?>
<h1>お悩み・効果</h1>
<?php } elseif (is_category('component' )) { ?>
<h1>成分・特長</h1>
<?php } ?></div>

<div class="pageOverview">
 <?php echo category_description( ); ?> 

</div>

<div class="tagLinks"><span>カテゴリ：</span>
<?php // list child categories
 	$this_cat = get_query_var('cat'); // get the category of this category archive page
	$result = get_categories( array('child_of' => $this_cat) ); // list child categories
  	 foreach ($result as $key => $cat) {
  	 	echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
  	 }?>

</div>

</header>



<?php if ( have_posts() ) : ?>
	<section class="entryList">

	<?php /* The loop */ ?>
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
		<div class="pic"> <?php the_post_thumbnail( array(300,200) ); ?> </div>
		<div class="txt">
		<?php the_excerpt() ?>
		<div class="viewMore"><span>続きを見る</span></div>
		</div>
		</div>
		<!--//.entryOverview-->
		</a></article>

	<?php endwhile; ?>
	</section>
	<?php

	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages >= 2 ):
		if(function_exists('wp_paginate')) {
		    wp_paginate();
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

<!-- 	<div class="pagination">
	<div class="pageMove">
	<a href="#" class="prevLink">前のページ</a>
	<span class="currentLink">1</span>
	<a href="#" class="pageLink">2</a>
	<a href="#" class="pageLink">3</a>
	<a href="#" class="pageLink">4</a>
	<a href="#" class="pageLink">5</a>
	<a href="#" class="pageLink">6</a>
	<a href="#" class="pageLink">7</a>
	<a href="#" class="pageLink">8</a>
	<a href="#" class="pageLink">9</a>
	<span class="chain">…</span>
	<a href="#" class="pageLink">99</a>
	<a href="#" class="nextLink">次のページ</a>
	</div>
	<p class="status">200件中 1 - 10 を表示</p>
	</div> -->
	<!--//.pagination-->
	<?php endif; ?>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

</div>
<!--//.mainCol-->
<!--////////////////////////////////////////////////////////////////////////////////
↑↑↑main

↓↓↓side
///////////////////////////////////////////////////////////////////////////////////-->



<div class="subCol">



<?php get_sidebar(); ?>

</div>
<!--//.subCol-->

</div>
<!--//.layout2Col-->


</div>
<!--//.contents-->
</div>
<!--//.contentsWrapInner-->
</div>
<!--//.contentsWrap-->
<?php get_footer(); ?>