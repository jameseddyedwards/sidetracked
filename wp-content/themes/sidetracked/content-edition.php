<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$pageTitle = get_the_title(get_the_id());
$categoryId = get_cat_ID($pageTitle);
echo $pageTitle;
$args = array(
	'posts_per_page'  => 20,
	'numberposts'     => 20,
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
var_dump($editionPosts);
$i = 0;

?>

<h1><?php the_title(); ?></h1>

<?php while (have_posts()) : the_post(); ?>
	
	<section class="block" id="body-content">

		<?php if (isset($editionPosts)) { ?>
			<div class="row">

				<?php foreach($editionPosts as $post) : setup_postdata($post); ?>
					<?php
						var_dump($post);
						$imageSize = get_field('sidetracked_feature_image_size');
						$image = get_field('sidetracked_feature_image');
						echo $imageSize;
						if ($imageSize == "") {
							$imageSize = "small-square"; // Set a default image size so the gallery displays if an image size list is not provided.
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
				<?php if ($pageTitle == "edition 1") { ?>
					<a class="all-editions" href="">All Editions</a>
				<?php } else { ?>
					<?php previous_post('%', '', 'no'); ?>
				<?php } ?>
			</span>
			<span class="next">
				<?php next_post('%', '', 'yes'); ?>
			</span>
		</div>
	</section>

	<section class="next-prev-arrows">
		<span class="prev">
			<?php if ($pageTitle == "edition 1") { ?>
				<a class="all-editions" href="">All Editions</a>
			<?php } else { ?>
				<?php previous_post('%', '', 'no'); ?>
			<?php } ?>
		</span>
		<span class="next">
			<?php next_post('%', '', 'yes'); ?>
		</span>
	</section>

<?php endwhile; ?>