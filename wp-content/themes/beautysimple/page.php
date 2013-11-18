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

<div class="mainCol all">

<header class="mainColHeader">
<ol class="topicPath">
<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">TOP</a></li>
<li><?php the_title(); ?></li>

</ol>
<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="pageTtl">
<h1><?php the_title(); ?></h1>
</div>
</header>
<?php if (!is_page('all_category') || !is_page('search')) : ?>
<article class="static">
<?php the_content(); ?>

</article>
<?php else: ?>
<?php the_content(); ?>

<?php endif; ?>
<!--//.entryPiece-->
<?php endwhile; ?>
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