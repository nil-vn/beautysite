<footer class="globalFooter">
<div class="toppageLink"><span><img src="<?php echo get_template_directory_uri(); ?>/img/common/icon_pagetop.png" alt="ページの上部へ戻る"></span></div>

<div class="footerContent01">
<div class="inner clearfix">
<nav class="contentsNav">
<dl>
<dt><a href="/category/health">ライフスタイル</a></dt>
<dd>
<?php 
	 $this_cat = get_category_by_slug('health' ); // get the category of this category archive page
  	 wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
	) ); // list child categories
?>
</dd>
</dl>
<dl>
<dt><a href="/category/cosme">メイク・コスメ</a></dt>
<dd>
<?php 
	 $this_cat = get_category_by_slug('cosme' ); // get the category of this category archive page
	 wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
	) ); // list child categories
?>
</dd>
</dl>
<dl>
<dt><a href="/category/trouble">お悩み・効果</a></dt>
<dd>
<?php 
	 $this_cat = get_category_by_slug('trouble' ); // get the category of this category archive page
 	wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
	) ); // list child categories
?>
</dd>
</dl>
<dl>
<dt><a href="/category/component">成分・特徴</a></dt>
<dd>
<?php 
	 $this_cat = get_category_by_slug('component' ); // get the category of this category archive page
 	wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
	) ); // list child categories
?>
</dd>
</dl>
</nav>

<section class="sns">
<h1>フォローで最新情報ゲット</h1>
<ul>
<li><a href="https://www.facebook.com/cosmehousecom"><img src="<?php echo get_template_directory_uri(); ?>/img/common/icon_facebook.png" alt="facebook"></a></li>
<li><a href="https://twitter.com/intent/follow?original_referer=&region=follow_link&screen_name=cosme_house&tw_p=followbutton&variant=2.0"><img src="<?php echo get_template_directory_uri(); ?>/img/common/icon_twitter.png" alt="twitter"></a></li>
</ul> 
<div class="fbArea">
<div class="fb-like-box" data-href="https://www.facebook.com/cosmehousecom" data-width="210px" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
</div>
</section>
</div>
<!--//.inner-->
</div>
<!--//.footerContent01-->

<div class="footerContent02">
<div class="inner clearfix">
<ul>
<li><a href="/terms">利用規約</a></li>
<li><a href="/privacy">プライバシーポリシー</a></li>
<li><a href="/sitemap">サイトマップ</a></li>
<li><a href="/company">運営会社</a></li>
</ul>
<p class="copyright">Copyright &copy; Cosume house All Rights Reserved.</p>
</div>
<!--//.inner-->
</div>
<!--//.footerContent02-->
</footer>


<?php wp_footer(); ?>

</body>
</html>
