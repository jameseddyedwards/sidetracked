<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$catId = get_cat_ID(get_the_title());
$postArgs = array(
	'posts_per_page'  => 7,
	'numberposts'     => 7,
	'offset'          => 0,
	'category'        => $catId,
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
$count = 0;
?>

<h1>Survive</h1>

<hr />

<?php /* Survive navigation menu */ ?>
<?php wp_nav_menu(array(
	'theme_location'	=> 'navigation-survive',
	'menu_class'		=> 'survive-menu'
)); ?>

<?php while (have_posts()) : the_post(); ?>
	
	<section class="block" id="body-content">

		<?php if (isset($posts)) { ?>
			<div class="row">

				<?php foreach($posts as $post) : setup_postdata($post); ?>
					<?php
						$count = $count + 1;
						$imageSize = get_field('sidetracked_edition_image_size');
						$image = get_field('sidetracked_edition_image');
						if ($count == 1) {
							$imageSize = "rectangle-medium";
						} elseif ($imageSize == "") {
							$imageSize = "square-small"; // Set a default image size so the gallery displays if an image size list is not provided.
						}
					?>
					<div class="span <?php echo $count == 1 ? 'twelve' : 'four'; ?>">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
							<span class="title-bar">
								<span><?php the_title(); ?></span>
							</span>
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