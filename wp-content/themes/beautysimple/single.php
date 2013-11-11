<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
<?php setPostViews(get_the_ID()); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php twentythirteen_post_nav(); ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->

		<?php if ( is_active_sidebar( 'sidebar-0' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-0' ); ?>
		<?php endif; ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>



<?php get_footer(); ?>