<?php
/**
 * The template for an article thumbnail in a listing
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$image = get_field('sidetracked_edition_image');
$imageSize = 'square-small';
$isAdvert = get_field('sidetracked_is_advert');
$articleInfo = get_field('sidetracked_article_info');
$info = $articleInfo != "" ? $articleInfo : get_field('sidetracked_sub_title');

?>

<?php if ($image) { ?>
	<div class="span four">
		<a class="article-img" href="<?php the_permalink(); ?>">
			<?php if (!$isAdvert) { ?>
				<span class="title-bar">
					<span class="title"><?php the_title(); ?></span>
					<span class="sub-title"><?php echo $info; ?></span>
				</span>
			<?php } ?>
			<img src="<?php echo $image['sizes'][$imageSize]; ?>" alt="<?php echo $image['alt']; ?>" />
		</a>
	</div>
<?php } ?>
