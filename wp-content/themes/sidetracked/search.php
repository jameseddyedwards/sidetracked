<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

get_header();

?>

<div class="container white content">
	<?php if (have_posts()) : ?>
		
		<div class="row">
			<div class="span12">
				<h1 class="page-title"><?php printf( __( '"%s" Search Results', 'sidetracked' ), get_search_query()); ?></h1>
				
				<!-- Pagination -->
				<? if (function_exists('wp_paginate')) {
					wp_paginate();
				} else if ($wp_query->max_num_pages > 1) {
					sidetracked_content_nav( 'nav-above' );
				} ?>
			</div>
		</div>

		<!-- Post List -->
		<div class="row">
			<?php while (have_posts()) : the_post(); ?>
				<div class="span4">
					<a class="post-thumb" href="<?php the_permalink(); ?>">
						<?php echo ah_get_custom_thumb(); ?>
						<span class="title"><?php the_title(); ?></span>
					</a>
					<span class="excerpt"><?php echo strip_tags(get_the_excerpt()) ?>...</span>
				</div>
			<?php endwhile; ?>
		</div>

		<!-- Pagination -->
		<div class="row">
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

	<?php else : ?>
		<div class="row">
			<div class="span12">
				<h1>No Results Found</h1>
				<p><?php _e('Unfortunately nothing can be found relating to your search. Why not try searching for a more generic keyword:', 'sidetracked'); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="row category-filter">
		<div class="span12">
			<h2>Can't find what you're looking for? Try searching by category:</h2>

			<!-- Category List -->
			<ul class="post-categories">
				<?php
				$categories = get_categories(array('number'=>12));
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

</div>

<?php get_footer(); ?>