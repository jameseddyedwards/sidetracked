<?php
/**
 * The template for displaying search forms in Sidetracked
 *
 * @package WordPress
 * @subpackage sidetracked
 * @since Sidetracked 1.0
 */

$searchCatId = get_cat_ID("Explore");
$args = array(
	'show_option_all'    => '',
	'show_option_none'   => '',
	'orderby'            => 'ID', 
	'order'              => 'ASC',
	'show_count'         => 0,
	'hide_empty'         => 0, 
	'child_of'           => $searchCatId,
	'exclude'            => '',
	'echo'               => 1,
	'selected'           => 0,
	'hierarchical'       => 0, 
	'name'               => 'cat',
	'id'                 => '',
	'class'              => 'postform',
	'depth'              => 0,
	'tab_index'          => 0,
	'taxonomy'           => 'category',
	'hide_if_empty'      => false
);

?>

<form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<fieldset class="single-input">
		<label for="s" class="assistive-text"><?php _e('Search', 'sidetracked'); ?></label>
		<input type="text" class="field" name="s" id="s" />
		<?php //wp_dropdown_categories($args); ?>
		<input type="submit" class="submit" name="submit" id="search" value="<?php esc_attr_e( 'search', 'sidetracked' ); ?>" />
		<br class="clear" />
	</fieldset>
</form>
