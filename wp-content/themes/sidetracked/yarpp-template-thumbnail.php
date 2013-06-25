<?php
/*
YARPP Template: Thumbnails
Description: Responsive thumbnails
Author: James 'Eddy' Edwards
*/

$recommendedPosts = array(get_the_id());

?>

<?php if (have_posts()) { ?>
	<section class="also-on-sidetracked">
		<section class="block">
			<hr />
			<h3><span>Also on Sidetracked</span></h3>
			<div class="row cf">
				<?php while (have_posts()) : the_post(); ?>
					<?php
					array_push($recommendedPosts, get_the_id());
					$image = get_field('sidetracked_edition_image');
					$imageSize = get_field('sidetracked_edition_image_size');
					$imageSize = "square-small"; // Set a default image size so the gallery displays if an image size list is not provided.
					$articleInfo = get_field('sidetracked_article_info');
					$info = $articleInfo != "" ? $articleInfo : get_field('sidetracked_sub_title');
					?>
					<div class="span four">
						<a class="article-img" href="<?php the_permalink(); ?>">
							<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
							<span class="title-bar">
								<span class="title"><?php the_title(); ?></span>
								<span class="sub-title"><?php echo $info; ?></span>
							</span>
						</a>
					</div>
				<?php endwhile; ?>
			</div>

			<?php
			// Posts
			$editionsCat = get_cat_ID("Editions");
			$postArgs = array(
				'posts_per_page'  => 3,
				'numberposts'     => 3,
				'offset'          => 0,
				'category'        => '',
				'orderby'         => 'rand',
				'order'           => 'DESC',
				'include'         => '',
				'exclude'         => $recommendedPosts,
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

			<div class="row cf">
				<?php foreach($posts as $post) : setup_postdata($post); ?>
					<?php
					$image = get_field('sidetracked_edition_image');
					$articleInfo = get_field('sidetracked_article_info');
					$info = $articleInfo != "" ? $articleInfo : get_field('sidetracked_sub_title');
					?>
					<div class="span four">
						<a class="article-img" href="<?php the_permalink(); ?>">
							<img src="<?php echo $image['sizes']['square-small']; ?>" alt="<?php echo $image['alt']; ?>" />
							<span class="title-bar">
								<span class="title"><?php the_title(); ?></span>
								<span class="sub-title"><?php echo $info; ?></span>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	</section>
<?php } ?>
