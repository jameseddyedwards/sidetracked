<?php
/**
 * The template for displaying search and the Explore page
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

$exploreCatId = get_cat_ID("Explore");
$NewsCatId = '-' . get_cat_ID("News");
$filterCatList = "";
$emptySearch = get_search_query() == ' ' || get_search_query() == '' ? true : false;
if (isset($_GET['filter'])) {
	$filter = str_replace(" ", "+", $_GET['filter']);
	$filterCatList = $NewsCatId . ',' . str_replace("+", ",", $filter);
}

/* Posts */
if ($emptySearch || !have_posts()) {
	$postArgs = array(
		'posts_per_page'  => 12,
		'numberposts'     => 12,
		'category'        => $filterCatList,
		'orderby'         => 'title',
		'order'           => 'ASC',
	);
	$posts = get_posts($postArgs);
}

?>

<section class="explore">

	<h1>Explore</h1>

	<hr />

	<section class="block">
		<div class="row explore-filter cf">
			<div class="span four">

				<h4>Enter your destination or adventure and press search</h4>
				
				<?php get_search_form(); ?>
				
				<?php if (!$emptySearch && have_posts()) { ?>
					<h5><?php printf(__('Showing results for "%s"', 'sidetracked'), get_search_query()); ?></h5>
				<?php } else if ($emptySearch) { ?>
					<?php // Do Nothing ?>
				<?php } else { ?>
					<h5><?php printf(__('No results found.', 'sidetracked'), get_search_query()); ?> Try browsing our latest:</h5>
				<?php } ?>
			</div>
			<div class="span eight">
				<!-- Article Thumbnail -->
				<?php get_template_part('content', 'explore-categories'); ?>
			</div>
		</div>
	</section>

	<hr />
		
	<section class="block">

		<?php if (!$emptySearch && have_posts()) { ?>
			<div class="row">
				<?php while (have_posts()) : the_post(); ?>

					<!-- Article Thumbnail -->
					<?php get_template_part('content', 'article-thumb'); ?>

				<?php endwhile; ?>
			</div>

			<!-- Pagination links -->
			<?php next_posts_link('&larr; Older posts'); ?>
			<?php previous_posts_link('Newer posts &rarr;'); ?>

		<?php } else { ?>

			<div class="row">
				<?php foreach ($posts as $post) :  setup_postdata($post); ?> 					
					
					<!-- Article Thumbnail -->
					<?php get_template_part('content', 'article-thumb'); ?>

				<?php endforeach; ?>
			</div>

		<?php } ?>

	</section>

	<?php if (have_posts()) { ?>
		<hr />
	<?php } ?>

</section>

<?php get_footer(); ?>
