<?php
/**
 * The template for displaying a Sidetracked Edition containing multiple articles.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$layoutOne = array("eight", "four", "four", "four", "four");
$layoutOne = array("eight", "four", "four", "four", "four");
$layoutOne = array("eight", "four", "four", "four", "four");

?>

<?php while (have_posts()) : the_post(); ?>
	
	<section class="related-posts">
		<section class="block">
			<hr />
			<h3><span>Also on Sidetracked</span></h3>
		</section>
	</section>

<?php endwhile; ?>

