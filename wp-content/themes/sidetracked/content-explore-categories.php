<?php
/**
 * The template for outputting the explore category listing
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$exploreCatId = get_cat_ID("Explore");
$filter = isset($_GET['filter']) ? str_replace(" ", "+", $_GET['filter']) : '';
$currentCategoryId = get_query_var('cat');
$parentCat = 0;


$catargs = array(
	'type'                     => 'post',
	'child_of'                 => $exploreCatId,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'taxonomy'                 => 'category',
	'pad_counts'               => false
);

$exploreCategories = get_categories($catargs);

?>

<!-- Category List -->
<ul class="explore-categories cf">
	<?php foreach($exploreCategories as $categoryParent) { ?>
		<?php
			$obj = get_object_vars($categoryParent);
			$parent = isset($obj['parent']) ? $obj['parent'] : '';
			$catId = isset($obj['cat_ID']) ? $obj['cat_ID'] : '';
			$catName = isset($obj['name']) ? $obj['name'] : '';
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
								$childCatName = $obj['name'];
								$childCatId = $obj['cat_ID'];
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

