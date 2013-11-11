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

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php 
		// is home
		if (is_home()) { ?>
		

		<h1>Pick up section</h1>
		<?php

		// Query get all pick up post for home page
		// dunghd add code 8/11/2013

		// args
	
		// get results
		$the_query = get_pickup(3);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up query:',$the_query,__FILE__,__LINE__ );
		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>

				<?php echo 'pick up:' . get_field('pick_up') ?>

			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		 
		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


		<h1>Popular ranking</h1>

		<?php

		// Query get all popular for all category
		// dunghd add code 8/11/2013
		$args = array(
			'type'                     => 'post',
			'parent'                   => 0,
			// 'orderby'                  => 'name',
			// 'order'                    => 'ASC',
			// 'hide_empty'               => 1,
			// 'hierarchical'             => 1,
			// 'exclude'                  => '',
			// 'include'                  => '',
			'number'                   => 5,
			'taxonomy'                 => 'category',
			'pad_counts'               => false 

		); 


		$category = get_categories($args);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('category:',$category,__FILE__,__LINE__ );

		foreach ($category as $key => $cat) :
		// get results
		$the_query = get_rankink($cat->cat_ID);
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up category:',$cat,__FILE__,__LINE__ );
		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<h3><?php echo $cat->cat_name ?></h3>
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
					// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('post:',$cat,__FILE__,__LINE__ );
					// $count_key = 'post_views_count';
				    // $count = get_post_meta(get_the_ID(), $count_key . 'log', true);
				    // echo $count;
			?>

				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>


			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		 
		<?php wp_reset_query();  // Restore global post data stomped by the_post().

		endforeach;
		 ?>


		<h1> New articles by category </h1>

		<?php

				// Query get all popular for all category
				// dunghd add code 8/11/2013
				$args = array(
					'type'                     => 'post',
					'parent'                   => 0,
					// 'orderby'                  => 'name',
					// 'order'                    => 'ASC',
					// 'hide_empty'               => 1,
					// 'hierarchical'             => 1,
					// 'exclude'                  => '',
					// 'include'                  => '',
					'number'                   => 4,
					'taxonomy'                 => 'category',
					'pad_counts'               => false 

				); 


				$category = get_categories($args);
				// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('category:',$category,__FILE__,__LINE__ );

				foreach ($category as $key => $cat) :

				// get results
				$the_query = get_articles($cat->cat_ID);
				// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up category:',$cat,__FILE__,__LINE__ );
				// The Loop
				?>
				<?php if( $the_query->have_posts() ): ?>
					<h3><?php echo $cat->cat_name ?></h3>
					<ul>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
							// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('post:',$cat,__FILE__,__LINE__ );

					?>

						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>


					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				 
				<?php wp_reset_query();  // Restore global post data stomped by the_post().

				endforeach;
				 ?>


		<h1> Recommended articled </h1>

		<?php

		// get results
		$the_query = get_recommended();
		// $GLOBALS['DebugMyPlugin']->panels['main']->addPR('pick up query:',$the_query,__FILE__,__LINE__ );
		// The Loop
		?>
		<?php if( $the_query->have_posts() ): ?>
			<ul>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>

				<?php echo 'recommended:' . get_field('recommended') ?>

			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		 
		<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


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