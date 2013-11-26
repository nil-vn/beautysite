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


<section class="wrap pageTypeSingle">

<?php /* The loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<header class="entryHeader">
<!--//.entryInfo-->
<h1><?php echo the_title();?></h1>
</header>
<?php if (!is_page('all_category') && !is_page('search')) : ?>
<article class="static">

<section class="snsBox">
<ul>
<li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
<li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
<li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async></script></li>
<li><a href="http://line.naver.jp/R/msg/text/?LINE%E3%81%A7%E9%80%81%E3%82%8B%0D%0Ahttp%3A%2F%2Fline.naver.jp%2F"><img src="<?php echo get_template_directory_uri() ?>/img/contents/linebutton_v.png" width="36" height="60" alt="LINEで送る" /></a></li>
</ul>
</section>
<!--//.snsBox-->
<div class="adBox">
<?php echo get_option("beautysite_gads_keys") ?>
</div>
<?php the_content(); ?>

</article>
<?php else: ?>
<?php the_content(); ?>

<?php endif; ?>
<!--//.entryPiece-->
<?php endwhile; ?>


<div class="adBox">
	<?php echo get_option("beautysite_banner_ads_contents") ?>
</div>

</section>
<!--//.wrap-->


<section class="snsBtns">
<h1>最新情報ゲットはこちら！</h1>
<ul>

<li>
<div class="icon"><a href="https://twitter.com/cosme_house"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_twitter.png" alt="twitter" width="61" height="61"></a></div>
<div class="account">
<h2>twitter公式アカウント</h2>
<div class="btn"><a href="https://twitter.com/cosme_house" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large">@twitterさんをフォロー</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
</div>
</li>

<li>
<div class="icon"><a href="https://www.facebook.com/cosmehousecom"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_facebook.png" alt="facebook" width="61" height="61"></a></div>
<div class="account">
<h2>facebook公式ページ</h2>
<div class="btn"><div class="fb-like" data-href="https://www.facebook.com/cosmehousecom" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
</div>
</li>

</ul>
</section>
<!--//.snsBtns-->

<div class="adBox">
   		<?php 
   		echo get_option("beautysite_fads_keys") ?>
</div>
<!--//.adBox-->

<?php get_footer(); ?>