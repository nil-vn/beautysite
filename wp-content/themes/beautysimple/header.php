<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
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
