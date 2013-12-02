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
<li><a href="<?php echo $categorylink ?>"><?php echo $healthCat->name; ?></a></li>
<?php } else if ( $color == "categoryYellow" ) { ?>
<li><a href="<?php echo $categorylink ?>"><?php echo $cosmeCat->name; ?></a></li>
<?php } else if ( $color == "categoryBlue" ) { ?>
<li><a href="<?php echo $categorylink ?>"><?php echo $troubleCat->name; ?></a></li>
<?php } elseif ( $color == "categoryPurple" ) { ?>
<li><a href="<?php echo $categorylink ?>"><?php echo $componentCat->name; ?></a></li>
<?php } ?>
<?php if (count($subCategoryLink)): ?>
  <li><a href="<?php echo $subCategoryLink['url'] ?>"><?php echo $subCategoryLink['name'] ?></a></li>
<?php endif ?>

<li><?php the_title( ); ?></li>
</ol>

<div class="pageTtl">
<h1><?php echo $subCategoryLink['name'] ?></h1>

<?php if ( $color == "" ): ?>
  <div class="flowLink"><a href="/category/health">＞<?php echo $healthCat->name; ?></a></div>
<?php elseif( $color == "categoryYellow" ): ?>
  <div class="flowLink"><a href="/category/cosme">＞<?php echo $cosmeCat->name; ?></a></div>
<?php elseif( $color == "categoryBlue"  ): ?>
  <div class="flowLink"><a href="/category/trouble">＞<?php echo $troubleCat->name; ?></a></div>
<?php elseif( $color == "categoryPurple" ): ?>
  <div class="flowLink"><a href="/category/component">＞<?php echo $componentCat->name; ?></a></div>
<?php endif ?>

</div>
</header>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php setPostViews(get_the_ID()); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>

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

<div class="sideBox">
<span class="toppageLink"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/pagetop_side.gif" alt="pagetop"></span>
<ul class="snsBtns">
<li><div class="fb-like" data-href="<?php get_permalink()  ?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
<li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
<li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></li>
<li><a href="http://line.naver.jp/R/msg/text/?LINE%E3%81%A7%E9%80%81%E3%82%8B%0D%0Ahttp%3A%2F%2Fline.naver.jp%2F"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/linebutton_v.png" width="36" height="60" alt="LINEで送る" /></a></li>
</ul>
</div>
<!--//.sideBox-->

</div>
<!--//.contents-->
</div>
<!--//.contentsWrapInner-->
</div>
<!--//.contentsWrap-->

<?php get_footer(); ?>