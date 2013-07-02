<?php
/**
 * The template for displaying a Category.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

//$paged = get_query_var('paged') ? get_query_var('paged') : 1;
query_posts(array('post_type' => 'news', /*'paged' => $paged,*/ 'posts_per_page' => 10));
/*
$big = 999999999; // need an unlikely integer

echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages
) );
echo $wp_query->max_num_pages;
*/
?>

<h1>News</h1>

<section id="body-content" class="news">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		
			<?php
			// Feature Image
			$featureImageObj = get_field('sidetracked_feature_image');
			?>

			<article class="news-article">

				<!-- Date & Image -->
				<div class="block cf">
					<div class="span two posted-on visible-desktop">
						<?php sidetracked_posted_on(); ?>
					</div>
					<div class="span eight news-article-image">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $featureImageObj['sizes']['rectangle-medium']; ?>" alt="<?php the_title(); ?>" />
						</a>
					</div>
					<div class="span two visible-desktop">&nbsp;</div>
				</div>

				<!-- Title, Excerpt & Read More -->
				<div class="block cf">
					<div class="span two visible-desktop">&nbsp;</div>
					<div class="span eight">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php the_excerpt(); ?></p>
						<a class="read-more" href="<?php the_permalink(); ?>">read more &#187;</a>
					</div>
					<div class="span two visible-desktop">&nbsp;</div>
				</div>

			</article>

		<?php endwhile; ?>

		<div class="block">
			<div class="span two visible-desktop">&nbsp;</div>
			<div class="span eight">
				<?php if (function_exists('wp_paginate')) { wp_paginate(); } ?>
			</div>
			<div class="span two visible-desktop">&nbsp;</div>
		</div>

	<?php else : ?>

		<div class="block">
			<div class="span two visible-desktop">&nbsp;</div>
			<div class="span eight">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
				<?php get_search_form(); ?>
			</div>
			<div class="span two visible-desktop">&nbsp;</div>
		</div>

	<?php endif; ?>

	<!-- Newsletter Signup -->
	<?php get_template_part('content', 'form-newsletter'); ?>


</section>

<?php get_footer(); ?>
