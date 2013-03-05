<?php
/**
 * The template for displaying search forms in Sidetracked
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */
?>

<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text"><?php _e( 'Search', 'sidetracked' ); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'sidetracked' ); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'sidetracked' ); ?>" />
	<div class="clear"></div>
</form>
