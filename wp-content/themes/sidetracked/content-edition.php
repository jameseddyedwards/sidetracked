<?php
/**
 * The template for displaying a Sidetracked Edition containing multiple articles.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$pageTitle = get_the_title();

$editionNumber = explode(" ", $pageTitle);
$editionNumber = (int)$editionNumber[1];
$nextEdition = "Edition " . ($editionNumber + 1);
$nextEditionId = get_page_by_title($nextEdition);
$nextEditionLink = get_permalink($nextEditionId);

$previousEdition = "Edition " . ($editionNumber - 1);
$previousEditionId = get_page_by_title($previousEdition);
$previousEditionLink = get_permalink($previousEditionId);

$editionsPage = get_page_by_title('Editions');
$editionsLink = get_permalink($editionsPage->ID);
$categoryId = get_cat_ID($pageTitle);
$postArgs = array(
	'posts_per_page'  => -1,
	'numberposts'     => -1,
	'offset'          => 0,
	'category'        => $categoryId,
	'orderby'         => 'post_date',
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

$editionsCatId = get_cat_ID("Editions");
$editionsArgs = array(
	'child_of'                 => $editionsCatId,
	'hide_empty'               => 0
);
$editionsCategories = get_categories($editionsArgs);
$numberOfEditions = count($editionsCategories);
$imageSizeCount = 0;

?>

<section class="edition">

	<h1><?php the_title(); ?></h1>

	<?php while (have_posts()) : the_post(); ?>
		
		<section class="block" id="body-content">

			<?php if (isset($posts)) { ?>
				<div class="row cf">

					<?php foreach($posts as $post) : setup_postdata($post); ?>
						<?php
							$isAdvert = get_field('sidetracked_is_advert');
							$imageSize = get_field('sidetracked_edition_image_size');
							$imageSize = $imageSize == "" ? "square-small" : $imageSize; // Set a default image size so the gallery displays if an image size list is not provided.
							$class = sidetracked_get_image_class($imageSize);
							$align = get_field('sidetracked_edition_image_align');
							$image = get_field('sidetracked_edition_image');
							$imageSizeCount = $imageSizeCount + sidetracked_get_image_size_count($imageSize);
							$pageLink = get_field('sidetracked_advert_custom_link') != '' ? get_field('sidetracked_advert_custom_link') : get_field('sidetracked_advert_page_link');
							$pageLink = $isAdvert ? $pageLink : get_permalink();
							$articleInfo = get_field('sidetracked_article_info');
							$info = $articleInfo != "" ? $articleInfo : get_field('sidetracked_sub_title');
						?>

						<?php if ($image != '') { ?>
							<div class="span <?php echo $class; ?> <?php echo $align == 'right' ? 'right' : '' ?>">
								<?php if ($pageLink != '') { ?>
									<a class="article-img" href="<?php echo $pageLink; ?>">
								<?php } ?>
								<?php if (!$isAdvert) { ?>
									<span class="title-bar">
										<span class="title"><?php the_title(); ?></span>
										<span class="sub-title"><?php echo $info; ?></span>
									</span>
								<?php } ?>
									<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php if ($pageLink != '') { ?>
									</a>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if ($imageSizeCount == 12) { ?>
							<?php $imageSizeCount = 0; ?>
							</div>
							<div class="row cf">
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

</section>