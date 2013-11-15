<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div class="contentsWrap pageTypeSingle">
<div class="contentsWrapInner">
<div class="contents">


<div class="layout2Col">

<div class="mainCol">
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
  		$color = "categoryYellow";
      $categorylink = "/category/cosme";
  	} elseif ($troubleCat->cat_ID == $cat->cat_ID  || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID )) {
  		$color = "categoryBlue";
      $categorylink = "/category/trouble";
  	} elseif ($componentCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
  		$color = "categoryPurple";
      $categorylink = "/category/component";
  	}
    // find sub category
    if (cat_is_ancestor_of( $healthCat->cat_ID, $cat->cat_ID ) || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID ) || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID ) || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
         $subCategoryLink = array('name' => $cat->name , 'url' => $categorylink . '/' . $cat->slug );
      }
  }

?>
<header class="mainColHeader <?php echo $color; ?>">

<ol class="topicPath">
<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></li>
<?php if ( $color == "" ) { ?>
<a href="<?php echo $categorylink ?>"><li>美容と健康</li></a>
<?php } else if ( $color == "categoryYellow" ) { ?>
<a href="<?php echo $categorylink ?>"><li>お悩み・効果</li></a>
<?php } else if ( $color == "categoryBlue" ) { ?>
<a href="<?php echo $categorylink ?>"><li>お悩み・効果</li></a>
<?php } elseif ( $color == "categoryPurple" ) { ?>
<a href="<?php echo $categorylink ?>"><li>成分・特長</li></a>
<?php } ?>
<?php if (count($subCategoryLink)): ?>
  <a href="<?php echo $subCategoryLink['url'] ?>"><li><?php echo $subCategoryLink['name'] ?></li></a>
<?php endif ?>

<li><?php the_title( ); ?></li>
</ol>

<div class="pageTtl">
<h1>ダイエット</h1>
<div class="flowLink"><a href="<?php echo $categorylink ?>">＞カテゴリトップへ</a></div>
</div>
</header>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php setPostViews(get_the_ID()); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		<?php //if ( is_active_sidebar( 'sidebar-0' ) ) : ?>
			<?php // dynamic_sidebar( 'sidebar-0' ); ?>
		<?php // endif; ?>



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