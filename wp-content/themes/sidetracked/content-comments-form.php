<?php
/**
 * The template for displaying the comment form on any post
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

global $current_user;
get_currentuserinfo();

?>

<?php
/*
//WordPress populated form
$fields = array(
	'title_reply' => "Post a Comment",
);

comment_form($fields);
*/
?>

<div class="block">
<?php if ('open' == $post->comment_status) : ?>
	<?php $req = get_option('require_name_email'); ?>

	<h3><?php comment_form_title('Post a Comment', 'Post a reply to %s'); ?></h3>
	
	<div id="respond" class="row">
		<div class="span two">&nbsp;</div>
		<div class="span eight comment-form">

			<?php if (get_option('comment_registration') && !$user_ID) : ?>
				<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=">logged in</a> to post a comment.</p>
			<?php else : ?>
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<fieldset>
							<input id="author" name="author" type="text" value="<?php echo $current_user->display_name ?>" size="22" tabindex="1" />
							<label for="author">Name <?php if ($req) echo "<span class='required'>*</span>"; ?><?php if ($user_ID) { ?> <span class="logout">(Not you? <a title="Log out of this account" href="<?php echo wp_logout_url(get_permalink()); ?>">Log out</a>)</span><?php } ?></label>						

							<input id="email" name="email" type="text" value="<?php echo $current_user->user_email ?>" size="22" tabindex="2" />
							<label for="email">Email <?php if ($req) echo "<span class='required'>*</span>"; ?></label>

							<input type="text" name="url" id="url" value="" size="22" tabindex="3" placeholder="<?php echo $current_user->data->user_url ?>" />
							<label for="url">Website</label>
						<?php //endif; ?>

						<textarea id="comment" name="comment" tabindex="4"></textarea>
						<?php comment_id_fields(); ?>

						<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
						<?php cancel_comment_reply_link("Cancel reply"); ?>
						<?php do_action('comment_form', $post->ID); ?>
					</fieldset>
				</form>
			<?php endif; ?>

		</div>
		<div class="span two">&nbsp;</div>
	</div>

	<div class="row">
		<div class="span2">&nbsp;</div>
		<div class="span9">

			<div class="next-prev-arrows cf">
				<span class="prev">
					<?php previous_post_link("%link"); ?>
				</span>
				<span class="next">
					<?php next_post_link("%link"); ?>
				</span>
			</div>
			
			<hr class="bottom" />
		</div>
		<div class="span1">&nbsp;</div>
	</div>

<?php endif; ?>
</div>

