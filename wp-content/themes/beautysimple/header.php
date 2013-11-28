<!DOCTYPE HTML>
<html lang="ja" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
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
	<?php if (wpmp_switcher_is_mobile_browser()): ?>
		<style type="text/css">
		body{
		    margin-top: 200px;
		    background: #fff url(<?php echo get_template_directory_uri(); ?>/img/common/bg_body.png) repeat-x center 160px;
		}
		</style>

		<p class="link_sp"><?php echo wpmp_switcher_link('mobile', 'スマートフォンサイトはこちら'); ?></p>
	<?php endif; ?>	
	<header class="globalHeader">
	<div class="headLine clearfix">
	<h1><?php bloginfo( 'description' ); ?></h1>
	<div class="searchFormArea">

	<?php get_search_form(); ?>

	</div>
	<!--//.searchFormArea-->
	</div>
	<!--//.headLine-->

	<div class="headerContents clearfix">
	<div class="siteLogo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.png" alt="Cosmehouse"></a></div>
	 <?php 
	 wp_nav_menu( array( 'theme_location' => 'primary', 	'container'       => 'nav','container_class' => 'globalNav','container_id'    => '', 'items_wrap' => '<ul>%3$s</ul>' , 'walker' => new beautysite_walker_nav_menu ) ); ?>

	<div class="viewAllBtn"><a href="/all_category">美容コラムを全て見る</a></div>
	</div>
	<!--//.headerContents-->
	</header>
