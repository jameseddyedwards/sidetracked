<?php
/**
 * The fall back template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

// Feature Image
$featureImageObj = get_field('sidetracked_feature_image');
//var_dump($featureImageObj);
?>

<section id="body-content">

	<?php while (have_posts()) : the_post(); ?>

		<?php if ($featureImageObj) { ?>
			<img class="feature-image" src="<?php echo $featureImageObj['sizes']['rectangle-xl']; ?>" alt="<?php echo $featureImageObj['alt']; ?>" />
		<?php } ?>
		
		<article class="block">

			<!-- Edit Post Link -->
			<?php edit_post_link( __('Edit', 'sidetracked')); ?>

			<h1><?php the_title(); ?></h1>

			<h2><?php the_field('sidetracked_sub_title'); ?></h2>

			<div class="row">
				<?php the_content(); ?>
			</div>

			<?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __( 'Pages:', 'sidetracked' ) . '</span>', 'after' => '</div>')); ?>

			<?php if (get_the_author_meta('description') && is_multi_author()) { // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('sidetracked_author_bio_avatar_size', 68)); ?>
					</div>
					<div id="author-description">
						<h2><?php printf( esc_attr__( 'About %s', 'sidetracked' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
						<div id="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'sidetracked' ), get_the_author() ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<?php /*

			<?php
				// translators: used between list items, there is a space after the comma
				$categories_list = get_the_category_list( __( ', ', 'sidetracked' ) );

				// translators: used between list items, there is a space after the comma
				$tag_list = get_the_tag_list('', __(', ','sidetracked'));
				if ('' != $tag_list) {
					// $utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sidetracked' );
					$utility_text = __('<span class="meta">Posted in %1$s and tagged %2$s.</span>', 'sidetracked' );
				} elseif ('' != $categories_list) {
					$utility_text = __('<span class="meta">Posted in %1$s.</span>', 'sidetracked' );
				} else {
					$utility_text = __('<span class="meta">Posted by <a href="%6$s">%5$s</a>.</span>', 'sidetracked' );
				}

				printf(
					$utility_text,
					$categories_list,
					$tag_list,
					esc_url(get_permalink()),
					the_title_attribute('echo=0'),
					get_the_author(),
					esc_url(get_author_posts_url(get_the_author_meta('ID')))
				);
			?>


			<?php $tags = wp_get_post_tags($post->ID); ?>
			<?php if ($tags) { ?>
			
				<!-- You May Also Like -->
				<h3>If you liked this post you might enjoy these too:</h3>
				<ol class="ymal">
					<?php
						$first_tag = $tags[0]->term_id;
						$args = array(
							'tag__in' => array($first_tag),
							'post__not_in' => array($post->ID),
							'showposts'=>5,
							'caller_get_posts'=>1
						);
						$my_query = new WP_Query($args);
					?>
					<?php if ($my_query->have_posts()) { ?>
						<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
					<?php } ?>
				</ol>
			<?php } ?>


			<div class="next-previous clearfix">
				<div class="previous">
					<?php previous_post_link('%', '', 'yes'); ?>
				</div>
				<div class="next">
					<?php next_post_link('%', '', 'yes'); ?>
				</div>
			</div>
			<?php */ ?>
			
		</article>

	<?php endwhile; ?>

</section>