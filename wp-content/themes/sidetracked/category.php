<?php
/**
 * The template for displaying a Category.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

$contentType = sidetracked_is_news_landing() ? 'content-news-landing' : 'content';

?>

<?php // ID required for screen readers link ?>
<section id="body-content">
	<?php get_template_part($contentType); ?>
</section>


<?php /*
<?php if (have_posts()) : ?>
	<?php
	global $post;
	$currentCategoryId = get_query_var('cat');
	$args = array('numberposts' => 1, 'category' => $currentCategoryId);
	$myposts = get_posts($args);
	?>
	<?php foreach($myposts as $post) : setup_postdata($post); ?>
		<div class="container white content">
			<div class="row">
				<div class="span2">
					<?php if ('post' == get_post_type()) : ?>
						<div class="post-date">
							<?php sidetracked_posted_on(); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="span9">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<h1><?php the_title(); ?></h1>
						</header>

						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="continue-reading">
							<span>continue reading</span>
						</a>
					</article>
				</div>
				<div class="span1">&nbsp;</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>

<div id="category-children" class="container white">
	<div class="row">
		<div class="span12">
			<?php if (have_posts()) : ?>
				<h2>Browse blog posts</h2>
				<div class="row category-filter">
					<div class="span3">
						<h3>Browse Blog Posts by Category</h3>
					</div>
					<div class="span9">

						<!-- Category List -->
						<ul id="category-links" class="post-categories">
							<?php
							$categories = get_categories(/*array('number'=>12));
							foreach($categories as $category) {
								$obj = get_object_vars($category);
								$catId = $obj[cat_ID];
								$catName = $obj[name];
								$catURL = esc_url(home_url('/')) . '?cat=' . $catId;
								?>

								<li>
									<a<?php echo $currentCategoryId == $catId ? ' class="current"' : ''; ?> rel="category" title="View latest posts in <?php echo $catName; ?>" href="<?php echo $catURL; ?>"><?php echo $catName; ?></a>
								</li>

								<?php
							}
							?>
						</ul>
					</div>
				</div>
				<div id="category-posts" class="row posts">
					<?php while (have_posts()) : the_post(); ?>
						<div class="span3">
							<a class="post-thumb" href="<?php the_permalink(); ?>">
								<?php echo ah_get_custom_thumb(); ?>
								<span class="title"><?php the_title(); ?></span>
							</a>
						</div>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<h1><?php echo single_cat_title(); ?><?php _e(' has no posts', 'sidetracked'); ?></h1>
				<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sidetracked'); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>

			<!-- Pagination -->
			<div id="pagination" class="row">
				<div class="span12">
					<?php 
						if (function_exists('wp_paginate')) {
							wp_paginate();
						} else if ($wp_query->max_num_pages > 1) {
							sidetracked_content_nav('nav-below');
						}
					?>
				</div>
			</div>

		</div>
	</div>
</div>

<?php */ ?>

<?php get_footer(); ?>
