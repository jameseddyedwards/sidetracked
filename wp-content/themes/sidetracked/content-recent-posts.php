<?php
/**
 * The template for displaying recent posts in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */
?>
<?php
	$currentPostID = get_the_ID();
	$category_blog = get_cat_ID('Blog');
	$category_adventures = get_cat_ID('Adventures');
	$recentPostsQuery = array(
		'posts_per_page' => 3,
		'cat' => $category_blog . ',' . $category_adventures
	);
	$queryObject = new WP_Query($recentPostsQuery);
?>

<?php if ($queryObject -> have_posts()) { ?>
	<div class="container recent white">
		<div class="row">
			<div class="span12">
				<h2>You May Also Like</h2>
			</div>
		</div>

		<!-- YARPP Related Posts -->
		<?php if (function_exists('related_posts')) {
			related_posts();
		} ?>

		<div class="row tab-row active">		
			<?php while ($queryObject -> have_posts()) { ?>
				<?php
					$recentPostID = get_the_ID();
					$queryObject -> the_post();
				?>
				<div class="span4">
					<a class="post-thumb" href="<?php the_permalink(); ?>">
						<span class="title"><?php the_title(); ?></span>
					</a>
					<span class="excerpt"><?php echo strip_tags(get_the_excerpt()) ?>...</span>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
