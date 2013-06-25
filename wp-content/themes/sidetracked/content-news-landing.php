<?php
/**
 * The template for displaying a list of News Articles
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
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
					<div class="span two posted-on">
						<?php sidetracked_posted_on(); ?>
					</div>
					<div class="span eight news-article-image">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $featureImageObj['sizes']['rectangle-medium']; ?>" alt="<?php the_title(); ?>" />
						</a>
					</div>
					<div class="span two">&nbsp;</div>
				</div>

				<!-- Title, Excerpt & Read More -->
				<div class="block cf">
					<div class="span two">&nbsp;</div>
					<div class="span eight">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php the_excerpt(); ?></p>
						<a class="read-more" href="<?php the_permalink(); ?>">read more &#187;</a>
					</div>
					<div class="span two">&nbsp;</div>
				</div>

			</article>

		<?php endwhile; ?>

		<div class="block">
			<div class="span two">&nbsp;</div>
			<div class="span eight">
				<?php if (function_exists('wp_paginate')) {
					wp_paginate();
				} ?>
			</div>
			<div class="span two">&nbsp;</div>
		</div>

		<?php //wp_reset_query(); ?>

	<?php else : ?>
	this is where we should be
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	<!-- Newsletter Signup -->
	<?php get_template_part('content', 'form-newsletter'); ?>

</section>