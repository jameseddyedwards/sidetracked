<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

?>

<footer class="block">

	<!-- Footer Navigation -->
	<nav class="navigation" role="secondary navigation">
		<?php /* Our footer navigation menu. */ ?>
		<?php wp_nav_menu(array(
			'theme_location'	=> 'navigation-footer',
			'items_wrap'      	=> '<ul><li><a href="' . get_field('current_edition', 'option') . '">Current Edition</a></li>%3$s</ul>',
			'container'			=> false
		)); ?>
	</nav>

	<!-- Newsletter Signup Form -->
	<form class="newsletter" action="http://groups.google.com/group/sidetracked/boxsubscribe">
		<fieldset>
			<input name="email" type="text" placeholder="sign up for enews updates">
			<input name="sub" type="submit" value="GO">
		</fieldset>
	</form>
	
	<br class="clear" />

	<!-- Social Links -->
	<nav class="social" role="social navigation">
		<ul>
			<li class="rss"><a href="<?php bloginfo('rdf_url'); ?>">RSS</a></li>
			<li class="twitter"><a href="<?php the_field('twitter_url', 'option'); ?>">Follow us on Twitter</a></li>
			<li class="facebook"><a href="<?php the_field('facebook_url', 'option'); ?>">Connect with us on Facebook</a></li>
			<li class="pinterest"><a href="<?php the_field('pinterest_url', 'option'); ?>">Join us on Pinterest</a></li>
		</ul>
	</nav>

	<!-- Credits -->
	<div class="credits">
		<?php do_action('sidetracked_credits'); ?>
		<span class="copyright" title="<?php esc_attr_e('Proudly powered by WordPress', 'sidetracked'); ?>">
			<?php printf(__( '&copy; Copyright Sidetracked Ltd 2010-2013. All rights reserved.', 'sidetracked'), 'WordPress'); ?>
		</span>
	</div>

	<?php wp_footer(); ?>

</footer>

</body>
</html>