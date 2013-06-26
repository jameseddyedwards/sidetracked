<?php
/**
 * The snippet of code which displays the Previous / Next arrow buttons
 *
 * @package WordPress
 * @subpackage Sidetracked
 * @since Sidetracked 1.0
 */
?>

<div class="next-prev-arrows cf">
	<span class="prev">
		<?php previous_post_link("%link", '%title', true); ?>
	</span>
	<span class="next">
		<?php next_post_link("%link", '%title', true); ?>
	</span>
</div>