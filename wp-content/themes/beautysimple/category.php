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
  the_category(' ' , $this_cat ); // list child categories
?>

</div>

</header>

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