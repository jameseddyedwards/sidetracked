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
$pageTitle = strtolower(get_the_title());
$is_advice = $pageTitle == 'advice';
$is_reviews = $pageTitle == 'reviews';

?>

<section class="survive">

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
							$image = get_field('sidetracked_edition_image');					
							$imageSize = $count == 1 && $is_advice ? "rectangle-wide" : "square-small"; // Set a default image size so the gallery displays if an image size list is not provided.
						?>
						<div class="span <?php echo $count == 1 && $is_advice ? 'twelve' : 'four'; ?>">
							<a class="article-img" href="<?php the_permalink(); ?>">
								<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
								<span class="title-bar">
									<span class="title"><?php the_title(); ?></span>
									<span class="sub-title"><?php the_excerpt_rss(); ?></span>
								</span>
							</a>
						</div>
					<?php endforeach; ?>

				</div>
			<?php } ?>
		</section>


		<!-- To Do: Need to add in pagination functionality and map it to this styling 
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
		-->

		<hr />

		<!-- All Guides - Advice Only -->
		<?php if ($is_advice) { ?>
			<section class="block all-guides">
				<div class="row">
					<div class="span twelve">
						<h3 class="center">All Guides</h3>
					</div>
				</div>
				<div class="row">
					<div class="span four">
						<?php foreach($posts as $post) : setup_postdata($post); ?>
							<?php $count = $count + 1; ?>
							<?php if ($count == 5 || $count == 10) { ?>
								</div>
								<div class="span four">
							<?php } ?>
							
							<span class="guide-link">
								<a class="article-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</span>

						<?php endforeach; ?>
					</div>
				</div>
			</section>

			<hr />
		<?php } ?>

	<?php endwhile; ?>

</section>