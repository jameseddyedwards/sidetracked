<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

//var_dump($featureImageObj);
?>

<h1>News</h1>

<section id="body-content" class="news">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php
			// Feature Image
			$featureImageObj = get_field('sidetracked_feature_image');
			?>

			<div class="news-article">

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
						<?php the_excerpt(); ?>
						<a class="read-more" href="<?php the_permalink(); ?>">read more &#187;</a>
					</div>
					<div class="span two">&nbsp;</div>
				</div>

			</div>

		<?php endwhile; ?>
	<?php else : ?>
	this is where we should be
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

</section>