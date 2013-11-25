<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div class="contentsWrap pageTypeIndex">
<div class="contentsWrapInner">
<div class="contents">

		<?php
		// is home
		if (is_home()) { ?>
		<article class="topInfoArea">


		<?php

		// Query get all pick up post for home page
		// dunghd add code 8/11/2013

		// args

		// get results
		$the_query = get_pickup(3);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up query:',$the_query,__FILE__,__LINE__ );
		// The Loop
		?>
		<?php
		$counter = 0;
		if( $the_query->have_posts() ): ?>
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

				<?php $counter++; ?>
				<?php switch ($counter) {
					case 1:
						?>
						<section class="topInfo01 leftSide"><a href="<?php the_permalink(); ?>">
						<div class="txt">
						<h1><?php the_title(); ?></h1>
						<p> <?php echo wp_html_excerpt(get_the_content( ),35,' ...'); ?> (<?php echo get_the_date( 'm/d' ); ?>)</p>
						</div>
						<div class="pic">   <?php the_post_thumbnail(array(600,400)); ?></div>
						</a></section>
				<?php
						break;
						case 2:
						?>
						<div class="rightSide">
						<section class="topInfo02"><a href="<?php the_permalink(); ?>">
						<div class="txt">
						<h1><?php the_title(); ?></h1>
						<p> <?php echo wp_html_excerpt(get_the_content( ),35,' ...'); ?> (<?php echo get_the_date( 'm/d' ); ?>)</p>
						</div>
						<div class="pic"><?php the_post_thumbnail(array(300,200)); ?></div>
						</a></section>
				<?php
						break;
						case 3:
						?>
						<section class="topInfo03"><a href="<?php the_permalink(); ?>">
						<div class="txt">
						<h1><?php the_title(); ?></h1>
						<p> <?php echo wp_html_excerpt(get_the_content( ),35,' ...'); ?> (<?php echo get_the_date( 'm/d' ); ?>)</p>
						</div>
						<div class="pic"><?php the_post_thumbnail(array(300,200)); ?></div>
						</a></section>
						</div>
				<?php
					default:
						# code...
						break;
				}


			 endwhile; ?>
			</ul>
		<?php endif; ?>

		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
		</article>
		<!--//.topNewsArea-->





		<article class="rankingArea">
		<header>
		<h1>人気ランキング</h1>
		<ul>
		<li class="ranknav01 active"><a href="#overall">総合ランキング</a></li>
		<li class="ranknav02"><a href="#health">美容と健康</a></li>
		<li class="ranknav03"><a href="#cosme">メイク・コスメ</a></li>
		<li class="ranknav04"><a href="#trouble">お悩み・効果</a></li>
		<li class="ranknav05"><a href="#component">成分・特徴</a></li>
		</ul>
		</header>


		<?php
		$healthCat = get_category_by_slug('health' );
		$cosmeCat = get_category_by_slug('cosme' );
		$troubleCat = get_category_by_slug('trouble' );
		$componentCat = get_category_by_slug('component' );
		$category = array('', $healthCat->cat_ID , $cosmeCat->cat_ID, $troubleCat->cat_ID , $componentCat->cat_ID );

		foreach ($category as $key => $cat) :
		// get results
		if (empty($cat)) {
			$the_query = get_rankink();
		}
		else
		$the_query = get_rankink_byname($cat);
		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<div class="inner <?php if ($key) echo 'disnon';?>">
			<ul>
			<?php
			 $counter = 0;
			 while ( $the_query->have_posts() ) : $the_query->the_post();
					$counter++;
			?>
			<section><a href="<?php the_permalink(); ?>">
			<div class="rank"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_no<?php echo $counter ?>.png" alt="No.<?php echo $counter ?>"></div>
			<div class="pic"><?php the_post_thumbnail(array(300,200)); ?></div>
			<h1><?php the_title(); ?></h1>
			<p> <?php the_excerpt(); ?> </p>
			<footer>
			<span class="date">(<?php echo get_the_date( 'Y/m/d' ); ?>)</span>
			<?php $category = get_the_category(); 
			 $color = "";
			  foreach ($category as $key => $cat) {
			  	if ($cosmeCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID )) {
			  		$color = "yellow";
			  	} elseif ($troubleCat->cat_ID == $cat->cat_ID  || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID )) {
			  		$color = "blue";
			  	} elseif ($componentCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
			  		$color = "purple";
			  	}
			  }
			 ?>
			<div class="tagMark <?php echo $color ?>"><div><span><?php
			if (isset($category[0]))
				echo $category[0]->cat_name;

 			?></span></div></div>
			</footer>
			</a></section>

			<?php endwhile; ?>
			</ul>
			</div>
		<?php endif; ?>

		<?php wp_reset_query();  // Restore global post data stomped by the_post().

		endforeach;
		 ?>

		</article>
		<!--//.rankingArea-->



		<article class="eachCateNewsArea">
		<header>
		<h1>カテゴリ別新着記事</h1>
		</header>

		<div class="inner">

		<?php

				$category = array('health' => array('name' => '美容と健康' , 'class' => '' , 'link' => '/category/health' ,'color' => '' ) ,'cosme' => array('name' => '美容・コスメ' , 'class' => 'listYellow', 'link' => '/category/cosme' ,'color' => 'yellow'),'trouble' => array('name' => 'お悩み・効果' , 'class' => 'listBlue', 'link' => '/category/trouble','color' => 'blue') ,'component' => array('name' => '成分・特長' , 'class' => 'listPurple' , 'link' => '/category/component' ,'color' => 'purple' ));
				foreach ($category as $key => $cat) :

				// get results
				$the_query = get_articles_byname($key);
				// The Loop
				?>
				<?php if( $the_query->have_posts() ): ?>

					<div class="newsList <?php echo $cat['class'] ?>">
					<div class="cateTtl"><a href="<?php echo $cat['link'] ?>"><?php echo $cat['name'] ?></a></div>
					<ol>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post();
							// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('post:',$cat,__FILE__,__LINE__ );

					?>
						<li><a href="<?php echo get_permalink() ?>">
						<div class="newsTtl"><?php if (date("Y/m/d") == get_the_date("Y/m/d" )) {
							echo '<span class="entryMark">new</span>';
						}
						?><?php the_title(); ?></div>
						<footer>
						<span class="date">(<?php echo get_the_date( 'Y/m/d' ); ?>)</span>
						<div class="tagMark <?php echo $cat['color'] ?>"><div><span><?php
						$category = get_the_category();
						if (isset($category[0]))
							echo $category[0]->cat_name;
						?></span></div></div>
						</footer>
						</a></li>
					<?php endwhile; ?>
					</ol>
					</div>
				<?php endif; ?>

				<?php wp_reset_query();  // Restore global post data stomped by the_post().

				endforeach;
				 ?>


		</div>
		<!--//.inner-->
		</article>
		<!--//.eachCateNewsArea-->

		<article class="recommendArea">
		<header>
		<h1>旬のおすすめ記事</h1>
		</header>

		<div class="inner">

		<?php

		// get results
		$the_query = get_recommended(4);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('recommended query:',$the_query,__FILE__,__LINE__ );
		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<section>
				<a href="<?php echo get_permalink(); ?>"><?php if (date("Y/m/d") == get_the_date("Y/m/d" )) {
					echo '<span class="entryMark">new</span>';
				}
				?>
				<div class="pic"><?php the_post_thumbnail(array(245,163)); ?></div>
				<h1><?php the_title(); ?></h1>
				<p> <?php the_excerpt(); ?> </p>
				<footer>
				<span class="date">(<?php echo get_the_date( 'Y/m/d' ); ?>)</span>
				<?php $category = get_the_category(); 
				 $color = "";
				  foreach ($category as $key => $cat) {
				  	if ($cosmeCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $cosmeCat->cat_ID, $cat->cat_ID )) {
				  		$color = "yellow";
				  	} elseif ($troubleCat->cat_ID == $cat->cat_ID  || cat_is_ancestor_of( $troubleCat->cat_ID, $cat->cat_ID )) {
				  		$color = "blue";
				  	} elseif ($componentCat->cat_ID == $cat->cat_ID || cat_is_ancestor_of( $componentCat->cat_ID, $cat->cat_ID )) {
				  		$color = "purple";
				  	}
				  }
				 ?>
				<div class="tagMark <?php echo $color ?>"><div><span><?php
				if (isset($category[0]))
					echo $category[0]->cat_name;
				?></span></div></div>
				</footer>
				</a></section>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
		</div>
		<!--//.inner-->
		</article>
		<!--//.recommendArea-->


</div>
<!--//.contents-->
</div>
<!--//.contentsWrapInner-->
</div>
<!--//.contentsWrap-->

		<?php } else { ?>

		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		<?php } // end home ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>