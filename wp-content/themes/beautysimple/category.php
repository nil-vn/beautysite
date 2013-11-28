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
<?php
$healthCat = get_category_by_slug('health' );
$cosmeCat = get_category_by_slug('cosme' );
$troubleCat = get_category_by_slug('trouble' );
$componentCat = get_category_by_slug('component' );
?>
<header class="mainColHeader <?php if (is_category('cosme' ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )) { ?>
categoryYellow<?php } else if (is_category('trouble' ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )) { ?>
categoryBlue<?php } elseif (is_category('component' ) || cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )) { ?>
categoryPurple<?php } ?>">
<ol class="topicPath">
<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></li>
<?php

if (is_category('health' ) || cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') )) { ?>

<?php if (cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') )): ?>
<li><a href="/category/health"><?php echo $healthCat->name; ?></a></li>
<?php else: ?>
<li><?php echo $healthCat->name; ?></li>

<?php endif ?>

<?php } else if (is_category('cosme' ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )) { ?>
<?php if (cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )): ?>
<li><a href="/category/cosme"><?php echo $cosmeCat->name; ?></a></li>
<?php else: ?>
<li><?php echo $cosmeCat->name; ?></li>
<?php endif ?>
<?php } else if (is_category('trouble' ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )) { ?>
<?php if (cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )): ?>
<li><a href="/category/trouble"><?php echo $troubleCat->name; ?></a></li>
<?php else: ?>
<li><?php echo $troubleCat->name; ?></li>
<?php endif ?>
<?php } elseif (is_category('component' ) || cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )) { ?>
<?php if (cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )): ?>
<li><a href="/category/component"><?php echo $componentCat->name; ?></a></li>
<?php else: ?>
<li><?php echo $componentCat->name; ?></li>
<?php endif ?>
<?php } ?>
<?php if (cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') ) || cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )): ?>
	<li><?php single_cat_title() ?></li>
<?php endif ?>
</ol>
<div class="pageTtl">
<?php if (is_category('health' )) { ?>
<h1><?php echo $healthCat->name; ?></h1>
<?php } elseif (is_category('cosme' )) { ?>
<h1><?php echo $cosmeCat->name; ?></h1>
<?php } elseif (is_category('trouble' )) { ?>
<h1><?php echo $troubleCat->name; ?></h1>
<?php } elseif (is_category('component' )) { ?>
<h1><?php echo $componentCat->name; ?></h1>
<?php } else { ?>
<h1><?php single_cat_title() ?></h1>
<?php } ?>

<?php if (cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') )): ?>
	<div class="flowLink"><a href="/category/health">＞<?php echo $healthCat->name; ?></a></div>
<?php elseif(cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )): ?>
	<div class="flowLink"><a href="/category/cosme">＞<?php echo $cosmeCat->name; ?></a></div>
<?php elseif(cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )): ?>
	<div class="flowLink"><a href="/category/trouble">＞<?php echo $troubleCat->name; ?></a></div>
<?php elseif(cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )): ?>
	<div class="flowLink"><a href="/category/component">＞<?php echo $componentCat->name; ?></a></div>
<?php endif ?>


</div>
<div class="pageOverview">

<?php if (is_category('health' ) || cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') )) : ?>

 <?php echo category_description( $healthCat->cat_ID); ?>


<?php elseif (is_category('cosme' ) || cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )): ?>

 <?php echo category_description( $cosmeCat->cat_ID); ?>

<?php elseif (is_category('trouble' ) || cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )): ?>

	 <?php echo category_description( $troubleCat->cat_ID); ?>

<?php else: ?>

	 <?php echo category_description( $componentCat->cat_ID); ?>

<?php endif; ?>
</div>

<div class="tagLinks"><span>カテゴリ：</span>
<?php // list child categories
 	$this_cat = get_query_var('cat'); // get the category of this category archive page
 	$cat_id = $this_cat;
 	if (cat_is_ancestor_of( $healthCat->cat_ID, get_query_var('cat') )) {
 		$cat_id = $healthCat->cat_ID;
 	} elseif (cat_is_ancestor_of( $cosmeCat->cat_ID, get_query_var('cat') )) {
 		$cat_id = $cosmeCat->cat_ID;
 	} elseif (cat_is_ancestor_of( $troubleCat->cat_ID, get_query_var('cat') )) {
 		$cat_id = $troubleCat->cat_ID;
 	} elseif (cat_is_ancestor_of( $componentCat->cat_ID, get_query_var('cat') )) {
 		$cat_id = $componentCat->cat_ID;
 	}
	$result = get_categories( array('child_of' => $cat_id) ); // list child categories
  	 foreach ($result as $key => $cat) {
  	 	if ($cat->term_id == $this_cat) {
  	 	echo '<a class="active" href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
  	 	}
  	 	else
  	 	echo '<a  href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
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
		<?php the_content('',FALSE,'');?>
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
