<?php
/**
 * The template for showing a New Article
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

?>

<section id="body-content" class="news">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

			<?php $featureImageObj = get_field('sidetracked_feature_image'); ?>

			<article>

				<!-- Date & Image -->
				<div class="block cf">
					<div class="span two posted-on">
						<?php sidetracked_posted_on(); ?>
					</div>
					<div class="span eight news-article-image">
						<img src="<?php echo $featureImageObj['sizes']['rectangle-medium']; ?>" alt="<?php the_title(); ?>" />
					</div>
					<div class="span two">&nbsp;</div>
				</div>

				<!-- Title, Excerpt & Read More -->
				<div class="block cf">
					<div class="span two">&nbsp;</div>
					<div class="span eight news-article-content">
						<h3><?php the_title(); ?></h3>
						<?php the_content(); ?>
					</div>
					<div class="span two">&nbsp;</div>
				</div>

			</article>

		<?php endwhile; ?>
		
	<?php else : ?>

		<p><?php _e('Apologies, but no news pages have been found. Perhaps searching will help find a related post.', 'sidetracked'); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	<!-- Comments -->
	<?php comments_template('', true); ?>

	<!-- Newsletter Signup -->
	<?php get_template_part('content', 'form-newsletter'); ?>

	<!-- YARRP -->
	<?php related_posts(); ?>

</section>

<?php get_footer(); ?>