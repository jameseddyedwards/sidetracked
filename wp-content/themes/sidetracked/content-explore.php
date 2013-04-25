<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$postArgs = array(
	'posts_per_page'  => 12,
	'numberposts'     => -1,
	'offset'          => 0,
	'category'        => '',
	'orderby'         => 'rand',
	'order'           => 'DESC',
	'include'         => '',
	'exclude'         => '',
	'meta_key'        => '',
	'meta_value'      => '',
	'post_type'       => 'post',
	'post_mime_type'  => '',
	'post_parent'     => '',
	'post_status'     => 'publish',
	'suppress_filters' => true
);
$posts = get_posts($postArgs);

?>

<h1><?php the_title(); ?></h1>

<hr />

<?php 

/*
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$wp_query = new WP_Query($args);
while ( have_posts() ) : the_post();
    the_title()
endwhile;

*/

$exploreCatId = get_cat_ID("Explore");
$exploreArgs = array(
	'child_of'                 => $exploreCatId,
	'hide_empty'               => 0
);
$exploreCategories = get_categories($exploreArgs);
$catParent;

$args = array(
 'child_of' => $exploreCatId,
 'hierarchy' => 1
)


?>

<?php //$posts_array = get_posts($args); ?>

<!-- then the pagination links -->
<?php next_posts_link( '&larr; Older posts' ); ?>
<?php previous_posts_link( 'Newer posts &rarr;' ); ?>


<section class="block">
	<div class="row">
		<div class="span four">
			<p>Enter your destination or adventure and press search</p>
			<?php get_search_form(); ?>

			<!-- Category List -->
			<ul class="post-categories">
				<?php wp_list_categories($args); ?>
				<?php
				//$numberOfEditions = count($editionsCategories);

				//$categories = get_categories(array('ID'=>3));
				foreach($exploreCategories as $categoryParent) {
					$obj = get_object_vars($categoryParent);
					//var_dump($obj);
					$catId = $obj[cat_ID];
					$catName = $obj[name];
					$catURL = esc_url(home_url('/')) . '?cat=' . $catId;
					?>
					<li>
						<a<?php echo $currentCategoryId == $catId ? ' class="current"' : ''; ?> rel="category" title="View latest posts in <?php echo $catName; ?>" href="<?php echo $catURL; ?>"><?php echo $catName; ?></a>
					</li>

					<?php
				}
				?>
			</ul>
		</div>
	</div>
</section>

<?php while (have_posts()) : the_post(); ?>
	
	<section class="block">

		<?php if (isset($posts)) { ?>
			<div class="row">

				<?php foreach($posts as $post) : setup_postdata($post); ?>
					<?php
						$image = get_field('sidetracked_edition_image');
						$imageSize = 'square-small';
					?>
					<?php if ($image) { ?>
						<div class="span four">
							<a href="<?php the_permalink(); ?>">
								<span class="title-bar">
									<span class="title"><?php the_title(); ?></span>
									<span><?php the_excerpt_rss(); ?></span>
								</span>
								<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
							</a>
						</div>
					<?php } ?>
				<?php endforeach; ?>

			</div>
		<?php } ?>
	</section>

	<section class="next-prev-bar">
		<div class="block">
			<span class="prev">
				<?php if ($pageTitle == "Edition 1") { ?>
					<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
				<?php } else { ?>
					<a href="<?php echo $previousEditionLink; ?>"><?php echo $previousEdition; ?></a>
				<?php } ?>
			</span>
			<span class="next">
				<?php if ($pageTitle == "Edition " . $numberOfEditions) { ?>
					<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
				<?php } else { ?>
					<a href="<?php echo $nextEditionLink; ?>"><?php echo $nextEdition; ?></a>
				<?php } ?>
			</span>
		</div>
	</section>

	<section class="next-prev-arrows">
		<span class="prev">
			<?php if ($pageTitle == "Edition 1") { ?>
				<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
			<?php } else { ?>
				<a href="<?php echo $previousEditionLink; ?>"><?php echo $previousEdition; ?></a>
			<?php } ?>
		</span>
		<span class="next">
			<?php if ($pageTitle == "Edition " . $numberOfEditions) { ?>
				<a class="all-editions" href="<?php echo $editionsLink ?>">All Editions</a>
			<?php } else { ?>
				<a href="<?php echo $nextEditionLink; ?>"><?php echo $nextEdition; ?></a>
			<?php } ?>
		</span>
	</section>

<?php endwhile; ?>