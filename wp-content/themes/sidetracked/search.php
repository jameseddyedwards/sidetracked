<?php
/**
 * The template for displaying search and the Explore page
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

do_action('explore');

$exploreCatId = get_cat_ID("Explore");
$filter = str_replace(" ", "+", $_GET['filter']);
$catList = $exploreCatId . "," . str_replace("+", ",", $filter);

/* Posts
$postArgs = array(
	'posts_per_page'  => 12,
	'numberposts'     => 12,
	'offset'          => 0,
	'category'        => $catList,
	'orderby'         => '',
	'order'           => 'ASC',
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
*/

// Category list
$exploreCatId = get_cat_ID("Explore");
$catargs = array(
	'type'                     => 'post',
	'child_of'                 => $exploreCatId,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false
);

$exploreCategories = get_categories($catargs);
$parentCat = 0;

?>

<section class="explore">

	<h1>Explore</h1>

	<hr />

	<section class="block">
		<div class="row explore-filter cf">
			<div class="span four">

				<h4>Enter your destination or adventure and press search</h4>
				
				<?php get_search_form(); ?>
				
				<?php if (get_search_query() != ' ' && get_search_query() != '' && have_posts()) { ?>
					<h5><?php printf(__('Showing results for "%s"', 'sidetracked'), get_search_query()); ?></h5>
				<?php } else if (!have_posts()) { ?>
					<h5><?php printf(__('No results found for "%s".', 'sidetracked'), get_search_query()); ?> Please try again.</h5>
				<?php } ?>

			</div>
			<div class="span eight">
				<!-- Category List -->
				<ul class="explore-categories cf">
					<?php foreach($exploreCategories as $categoryParent) { ?>
						<?php
							$obj = get_object_vars($categoryParent);
							$parent = $obj[parent];
							$catId = $obj[cat_ID];
							$catName = $obj[name];
						?>

						<?php if ($parent == $exploreCatId) { ?>
							<?php $childCategories = get_categories(array('child_of'=>$catId,'hide_empty'=>0)); ?>
							<li class="parent cat-item">
								<span<?php echo $currentCategoryId == $catId ? ' class="current"' : ''; ?>><?php echo $catName; ?></span>
								<?php if ($childCategories != "") { ?>
									<ul class="children">
										<?php foreach($childCategories as $childCategory) { ?>
											<?php
												$obj = get_object_vars($childCategory);
												$childCatName = $obj[name];
												$childCatId = $obj[cat_ID];
												$catURL = esc_url(home_url('/')) . '?s=' . get_search_query() . '&filter=' . $filter;
												if (strpos($catURL, $childCatId) === FALSE) {
													$catURL = $filter != "" ? $catURL . "+" . $childCatId : $catURL . $childCatId;
												} else {
													$catURL = str_replace($childCatId . "+", "", $catURL);
													$catURL = str_replace("+" . $childCatId, "", $catURL);
													$catURL = str_replace($childCatId, "", $catURL);
												}
											?>

											<li class="cat-item">
												<a href="<?php echo $catURL; ?>"<?php echo strpos($catURL, $childCatId) === FALSE ? ' class="selected"' : ''; ?> rel="category" title="View latest posts in <?php echo $childCatName; ?>"><?php echo $childCatName; ?></a>
											</li>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
						<?php } ?>

					<?php } ?>
				</ul>
			</div>
		</div>
	</section>

	<hr />
		
	<section class="block">

		<?php if (have_posts()) { ?>
			<?php //print_r($posts); ?>
			<div class="row">
				<?php while (have_posts()) : the_post(); ?>
					<?php
						$image = get_field('sidetracked_edition_image');
						$imageSize = 'square-small';
						$isAdvert = get_field('sidetracked_is_advert');
						$articleInfo = get_field('sidetracked_article_info');
						$info = $articleInfo != "" ? $articleInfo : get_field('sidetracked_sub_title');
					?>
					<?php if ($image) { ?>
						<div class="span four">
							<a class="article-img" href="<?php the_permalink(); ?>">
								<?php if (!$isAdvert) { ?>
									<span class="title-bar">
										<span class="title"><?php the_title(); ?></span>
										<span class="sub-title"><?php echo $info; ?></span>
									</span>
								<?php } ?>
								<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
							</a>
						</div>
					<?php } ?>
				<?php endwhile; ?>

			</div>

			<!-- Pagination links -->
			<?php next_posts_link('&larr; Older posts'); ?>
			<?php previous_posts_link('Newer posts &rarr;'); ?>

		<?php } else { ?>

		<?php } ?>

	</section>

	<?php if (have_posts()) { ?>
		<hr />
	<?php } ?>

</section>

<?php get_footer(); ?>
