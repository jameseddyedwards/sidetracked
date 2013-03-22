<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$pageTitle = get_the_title(get_the_id());

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
$args = array(
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
$editionPosts = get_posts($args);

?>

<h1><?php the_title(); ?></h1>

<?php while (have_posts()) : the_post(); ?>
	
	<section class="block" id="body-content">

		<?php if (isset($editionPosts)) { ?>
			<div class="row">

				<?php foreach($editionPosts as $post) : setup_postdata($post); ?>
					<?php
						$imageSize = get_field('sidetracked_edition_image_size');
						$image = get_field('sidetracked_edition_image');
						if ($imageSize == "") {
							$imageSize = "square-small"; // Set a default image size so the gallery displays if an image size list is not provided.
						}
						$class = sidetracked_get_image_class($imageSize);
					?>
					<div class="span <?php echo $class; ?>">
						<a href="<?php the_permalink(); ?>">
							<span><?php the_title(); ?></span>
							<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
						</a>
					</div>
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
				<a href="<?php echo $nextEditionLink; ?>"><?php echo $nextEdition; ?></a>
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
			<a href="<?php echo $nextEditionLink; ?>"><?php echo $nextEdition; ?></a>
		</span>
	</section>

<?php endwhile; ?>