<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

?>

<section class="error404">

	<h1><?php _e('Undiscovered', 'sidetracked'); ?></h1>

	<hr />

	<section class="block" id="body-content">

		<h4 class="center"><?php _e('The page you\'re looking for can\'t be found. You could try browsing or searching our <a href="' . site_url() . '/explore">Explore</a> area or some of the links below may help:', 'sidetracked'); ?></h4>
		<div class="row">
			<div class="span twelve">
				<img src="<?php echo get_bloginfo('template_directory'); ?>/images/img/feature-404.jpg" alt="Undiscovered" />
			</div>
		</div>

		<div class="row center link-list cf">
			<div class="span four">
				<h3 class="center">Editions</h3>
				<p><?php _e('Sidetracked is a monthly online journal. View the latest Edition now or explore articles from previous editions.', 'sidetracked'); ?></p>
			</div>
			<div class="span four">
				<h3 class="center">Inspiration</h3>
				<a href="<?php echo esc_url(home_url('/')); ?>explore">Explore Sidetracked Content</a>
				<a href="<?php echo esc_url(home_url('/')); ?>advice">Survive: Advice &amp; Guides</a>
				<a href="<?php echo esc_url(home_url('/')); ?>reviews">Survive: Gear Reviews</a>
				<a href="<?php echo esc_url(home_url('/')); ?>tv">Sidetracked TV</a>
				<a href="<?php echo esc_url(home_url('/')); ?>category/news">Adventure and Expedition News</a>
			</div>
			<div class="span four">
				<h3 class="center">Information</h3>
				<a href="<?php echo esc_url(home_url('/')); ?>about-sidetracked">About Us</a>
				<a href="<?php echo esc_url(home_url('/')); ?>contact">Get In Touch</a>
				<a href="<?php echo esc_url(home_url('/')); ?>contribution-guidelines/">Contribute</a>
				<a href="<?php echo esc_url(home_url('/')); ?>advertising">Advertise</a>
			</div>
		</div>

	</section>

</section>

<?php get_footer(); ?>