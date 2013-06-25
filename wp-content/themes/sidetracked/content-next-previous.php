<?php
/**
 * The snippet of code which displays the Previous / Next arrow buttons
 *
 * @package WordPress
 * @subpackage Sidetracked
 * @since Sidetracked 1.0
 */
?>

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