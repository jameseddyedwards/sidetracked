<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$postArgs = array(
	'posts_per_page'  => -1,
	'numberposts'     => -1,
	'offset'          => 0,
	'category'        => '',
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

?>

<h1><?php the_title(); ?></h1>

<hr />

<?php /* Our footer navigation menu. */ ?>
<?php wp_nav_menu(array(
	'theme_location'	=> 'navigation-survive'
)); ?>

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