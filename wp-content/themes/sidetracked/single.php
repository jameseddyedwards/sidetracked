<?php
/**
 * The Template for displaying all single POSTS.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

?>

<?php /* ID required for screen readers link */ ?>
<section id="body-content">
	
	<!-- Content -->
	<?php get_template_part('content'); ?>

	<!-- Comments -->
	<?php// comments_template('', true); ?>

	<!-- Comments Form -->
	<?php// get_template_part('content', 'comments-form'); ?>

	<!-- Recent Posts -->
	<?php// get_template_part('content', 'recent-posts'); ?>

</section>

<?php get_footer(); ?>