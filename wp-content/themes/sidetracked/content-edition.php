<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$images = get_field('sidetracked_gallery');
$imageSizes = get_field('sidetracked_gallery_layout');
$imageSizeArray = explode(",", $imageSizes);
$i = 0;
<<<<<<< HEAD
$pageTitle = strtolower(get_the_title(get_the_id()));
=======
>>>>>>> Work on editions layout

?>

<h1><?php the_title(); ?></h1>

<?php while (have_posts()) : the_post(); ?>
	
<<<<<<< HEAD
	<section class="block" id="body-content">

		<?php if ($images) { ?>
			<div class="row">

				<?php foreach($images as $image): ?>
					<?php 
						//echo wp_read_image_metadata($image);
						$imageSize = $imageSizeArray[$i];
						if ($imageSize == "") {
							$imageSize = "small-square"; // Set a default image size so the gallery displays if an image size list is not provided.
						}
						$class = sidetracked_get_image_class($imageSize);
					?>

					<div class="span <?php echo $class; ?>">
						<a href="">
							<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
						</a>
					</div>
					<?php // echo $image['caption']; ?>
					<?php // wp_get_attachment_metadata($attachment_id); ?>
					<?php $i = $i + 1; ?>
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
=======
<?php // var_dump(get_field('sidetracked_gallery')); // View array data (for debugging) ?>
   
<section id="body-content">

	<?php if ($images) { ?>
		<div class="row">

			<?php foreach($images as $image): ?>
				<?php 
					$imageSize = $imageSizeArray[$i];
					if ($imageSize == "") {
						$imageSize = "small-square"; // Set a default image size so the gallery displays if an image size list is not provided.
					}
					$class = sidetracked_get_image_class($imageSize);
				?>
				<div class="span <?php echo $class; ?>">
					<a href="">
						<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
					</a>
				</div>
				<?php // echo $image['caption']; ?>
				<?php // wp_get_attachment_metadata($attachment_id); ?>
				<?php $i = $i + 1; ?>
			<?php endforeach; ?>

		</div>
	<?php } ?>
</section>
>>>>>>> Work on editions layout

<?php endwhile; ?>