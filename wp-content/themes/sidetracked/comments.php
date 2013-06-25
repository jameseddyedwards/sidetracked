<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to sidetracked_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */
?>

<section class="comments">
	<div class="block">
		<div class="row cf">
			<div class="span two">&nbsp;</div>
			<div class="span eight"><h3>Comments</h3></div>
			<div class="span two">&nbsp;</div>
		</div>
				
		<?php if (!have_comments()) { // No comments or comments disabled ?>
			<div class="row cf">
				<div class="span two">&nbsp;</div>
				<div class="span eight">
					<p class="nocomments"><?php _e('There are currently no comments. Be the first to post a comment below.', 'sidetracked'); ?></p>
				</div>
				<div class="span two">&nbsp;</div>
			</div>

		<?php } elseif (have_comments()) { ?>
			<div class="row cf">
				<div class="span two">&nbsp;</div>
				<div class="span eight">
					<?php if (post_password_required()) { ?>
						<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'sidetracked'); // Comments are password protected ?></p>
					<?php } else { ?>
						<?php wp_list_comments(array('callback' => 'sidetracked_comment', /*'style' => 'div'*/)); ?>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php if (have_comments() && !post_password_required()) { ?>
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // Are there comments to navigate through ?>
			<div class="row cf">
				<div class="span two">&nbsp;</div>
				<div class="span eight">
					<nav id="comment-nav-below">
						<h1 class="assistive-text"><?php _e( 'Comment navigation', 'sidetracked' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sidetracked' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sidetracked' ) ); ?></div>
					</nav>
				</div>
				<div class="span two">&nbsp;</div>
			</div>
		<?php } ?>
	<?php } ?>

	<!-- Comments Form -->
	<?php get_template_part('content', 'form-comments'); ?>

</section>
