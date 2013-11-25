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


		<?php
		// is home
		if (is_home()) { ?>
		<section class="wrap pageTypeIndex">


		<?php

		// Query get all pick up post for home page
		// dunghd add code 8/11/2013

		// args

		// get results
		$the_query = get_pickup(3);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up query:',$the_query,__FILE__,__LINE__ );
		// The Loop
		?>
		<section class="mainBox">

		<?php
		$counter = 0;
		if( $the_query->have_posts() ): ?>

			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<div class="piece"><a href="<?php the_permalink(); ?>">
			<div class="pic"><?php the_post_thumbnail('mobile-avatar-thumb'); ?></div>
			<h1><?php the_title(); ?>(<?php echo get_the_date( 'm/d' ); ?>)</h1>
			</a></div>

			<?php endwhile; ?>
		<?php endif; ?>

		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
		</section>
		<!--//.mainBox-->


		<nav class="categoryNav">
		<ul>
		<li><a href="/category/health"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_catenav_pink.png" alt="美容・健康" width="70" height="72"><span>美容</span><span>健康</span></a></li>
		<li><a href="/category/cosme"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_catenav_yw.png" alt="メイク・コスメ" width="70" height="72"><span>メイク</span><span>コスメ</span></a></li>
		<li><a href="/category/trouble"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_catenav_bl.png" alt="お悩み・効果" width="70" height="72"><span>お悩み</span><span>効果</span></a></li>
		<li><a href="/category/component"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_catenav_pr.png" alt="成分・特徴" width="70" height="72"><span>成分</span><span>特徴</span></a></li>
		</ul>
		</nav>



		<article class="ranking">
		<h1>人気ランキング</h1>
		<ul class="tab">
		<li class="tab01"><a href="#panel01">all</a></li>
		<li class="tab02"><a href="#panel02">美容<br />健康</a></li>
		<li class="tab03"><a href="#panel03">メイク<br />コスメ</a></li>
		<li class="tab04"><a href="#panel04">お悩み<br />効果</a></li>
		<li class="tab05"><a href="#panel05">成分<br />特徴</a></li>
		</ul>


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
			<ol class="panel <?php if ($key) echo 'disnon'; ?>" id="panel0<?php echo $key + 1 ?>">
			<?php
			 $counter = 0;
			 while ( $the_query->have_posts() ) : $the_query->the_post();
					$counter++;
			?>


			<li><a href="<?php the_permalink() ?>">
			<div class="rank"><img src="<?php echo get_template_directory_uri(); ?>/img/contents/icon_rank0<?php echo $counter ?>.gif" alt="no.<?php echo $counter ?>" width="60" height="17"></div>
			<section class="entry">
			<div class="pic"><?php the_post_thumbnail('mobile-sidebar-thumb'); ?></div>
			<div class="txt">
			<h2><?php the_title(); ?></h2>
			<div class="info">
			<p class="date"><?php echo get_the_date( 'Y/m/d' ); ?></p>
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
			<div class="tagMark <?php echo $color ?>">
				<?php
				if (isset($category[0]))
					echo $category[0]->cat_name;
					 ?>
			</div>
			</div>
			</div>
			</section>
			</a></li>

			<?php endwhile; ?>
			</ol>
		<?php endif; ?>

		<?php wp_reset_query();  // Restore global post data stomped by the_post().

		endforeach;
		 ?>

		</article>
		<!--//.rankingArea-->



		<article class="news">
		<h1>カテゴリ別新着記事</h1>

		<?php

				$category = array('health' => array('name' => '美容と健康' , 'class' => '' , 'link' => '/category/health' ,'color' => '' ) ,'cosme' => array('name' => '美容・コスメ' , 'class' => 'cateYellow', 'link' => '/category/cosme' ,'color' => 'yellow'),'trouble' => array('name' => 'お悩み・効果' , 'class' => 'cateBlue', 'link' => '/category/trouble','color' => 'blue') ,'component' => array('name' => '成分・特長' , 'class' => 'catePurple' , 'link' => '/category/component' ,'color' => 'purple' ));
				foreach ($category as $key => $cat) :

				// get results
				$the_query = get_articles_byname($key);
				// The Loop
				?>
				<?php if( $the_query->have_posts() ): ?>
					<dl>
					<dt class="<?php echo $cat['class'] ?>"><a href="#"><?php echo $cat['name'] ?><span>＋</span></a></dt>
					<dd>
					<ul>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post();
							// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('post:',$cat,__FILE__,__LINE__ );

					?>
						<li><a href="<?php echo get_permalink() ?>"><?php if (date("Y/m/d") == get_the_date("Y/m/d" )) {
							echo '<span class="newMark">new</span>';
						}
						?><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
					</dd>
				<?php endif; ?>

				<?php wp_reset_query();  // Restore global post data stomped by the_post().

				endforeach;
				 ?>

		<!--//.inner-->
		</article>
		<!--//.eachCateNewsArea-->

		<article class="recommend">
		<h1>旬のおすすめ記事</h1>
		<ul>
		<?php

		// get results
		$the_query = get_recommended(5);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('recommended query:',$the_query,__FILE__,__LINE__ );
		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<li><a href="<?php echo get_permalink(); ?>"><?php if (date("Y/m/d") == get_the_date("Y/m/d" )) {
					echo '<span class="newMark">new</span>';
				}
				?><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
		</ul>
		<!--//.inner-->
		</article>
		<!--//.recommendArea-->

		</section>
		<!--//.wrap-->


		<article class="snsBtns">
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
		</article>
		<!--//.snsBtns-->


		<div class="adBox">
   		<?php 
   		echo get_option("beautysite_fads_keys") ?>
		</div>
		<!--//.adBox-->

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