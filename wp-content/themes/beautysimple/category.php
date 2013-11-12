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
<li>美容と健康</li>
</ol>

<div class="pageTtl">
<h1>美容と健康</h1>
</div>

<div class="pageOverview">
<p>グラビアアイドルやモデルさんみたいにキュッと引き締まったヒップになりたい！</p>
<p>でも現実はセルライトがたくさんついてぶよぶよ、、そんなお悩みに、簡単にできるリンパマッサージのやり方をご紹介します！</p>
</div>

<div class="tagLinks"><span>カテゴリ：</span>
<a href="tag.html">ダイエット</a>
<a href="#">運動</a>
<a href="#">イベント</a>
<a href="#">食生活</a>
<a href="#">酵素</a>
<a href="#">サプリメント</a>
<a href="#">便秘解消</a>
<a href="#">冷え性</a>
<a href="#">花粉症</a>
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