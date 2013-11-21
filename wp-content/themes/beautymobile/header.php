<!DOCTYPE HTML>
<html lang="ja" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
<head>
<meta charset="utf-8">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta property='og:type' content='article' />
	<meta property='og:site_name' content='CosmeHouse' />
	<meta property='fb:app_id' content='1374639112783802' />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="cosmehouse.com@gmail.com" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<script>
	 
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new
	Date();a=s.createElement(o),
	 
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a
	,m)
	 
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-45834212-1', 'cosumehouse.com');
	  ga('send', 'pageview');

	</script>
</head>

<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=250318501786630";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<header class="globalHeader">
	<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.gif" alt="Cosmehouse" width="140" height="26"></a></h1>
	<div class="menuBtn"><a href="#"><span class="arrow"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_arrow_right.png" alt="メニューを開く" width="7" height="10"></span><span class="half">menu</span></a></div>
	</header>

	<nav class="globalNav">
	<ul>
	<li><a href="/category/health">美容と健康<span>＋</span></a>
	<ul>
	<?php 
		 $this_cat = get_category_by_slug('health' ); // get the category of this category archive page
 		wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
		) ); // list child categories
	?>
	</ul>
	</li>
	<li class="cateYellow"><a href="/category/cosme">メイク・コスメ<span>＋</span></a>
	<ul>
	<?php 
		 $this_cat = get_category_by_slug('cosme' ); // get the category of this category archive page
 		wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
		) ); // list child categories
	?>
	</ul>
	</li>
	<li class="cateBlue"><a href="/category/trouble">お悩み・効果<span>＋</span></a>
	<ul>
	<?php 
		 $this_cat = get_category_by_slug('trouble' ); // get the category of this category archive page
 		wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
		) ); // list child categories
	?>
	</ul>
	</li>
	<li class="catePurple"><a href="/category/component">成分・特徴<span>＋</span></a>
	<ul>
	<?php 
		 $this_cat = get_category_by_slug('component' ); // get the category of this category archive page
 		wp_list_categories( array(
  	 	'child_of' => $this_cat->cat_ID,
  	 	'title_li' => '',
		'show_option_none'   => '',
		) ); // list child categories
	?>
	</ul>
	</li>
	</ul>
	</nav>