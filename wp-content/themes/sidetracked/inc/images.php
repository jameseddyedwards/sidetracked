<?php

// Add Sidetracked's custom image sizes
add_theme_support('post-thumbnails');
add_image_size('thumbnail-square', '195', '195', true);
add_image_size('small-square', '404', '404', true);
add_image_size('medium-square', '822', '822', true);
add_image_size('large-square', '1240', '1240', true);
add_image_size('small-rectangle', '613', '404', true);
add_image_size('medium-rectangle', '822', '404', true);
add_image_size('large-rectangle', '1240', '822', true);
add_image_size('wide-rectangle', '1240', '404', true);


/**
 * Remove standard image sizes so that these sizes are not
 * created during the Media Upload process
 *
 * Tested with WP 3.2.1
 *
 * Hooked to intermediate_image_sizes_advanced filter
 * See wp_generate_attachment_metadata( $attachment_id, $file ) in wp-admin/includes/image.php
 *
 * @param $sizes, array of default and added image sizes
 * @return $sizes, modified array of image sizes
 * @author Ade Walker http://www.studiograsshopper.ch
 */
function remove_wmp_image_sizes( $sizes) {
	unset($sizes['thumbnail']);
	unset($sizes['medium']);
	unset($sizes['large']);
	unset($sizes['full']);

	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_wmp_image_sizes');


function custom_wmu_image_sizes($sizes) {
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	unset( $sizes['full'] );

	$myimgsizes = array(
		"thumbnail-square" => __("Thumbnail Square"),
		"small-square" => __("Small Square"),
		"medium-square" => __("Medium Square"),
		"large-square" => __("Large Square"),
		"small-rectangle" => __("Small Rectangle"),
		"medium-rectangle" => __("Medium Rectangle"),
		"large-rectangle" => __("Large Rectangle"),
		"wide-rectangle" => __("Wide Rectangle")
	);
	$newimgsizes = array_merge($sizes, $myimgsizes);
	
	return $newimgsizes;
}
add_filter('image_size_names_choose', 'custom_wmu_image_sizes');


/*
 * Creates a size specifc image 
 * $size = Any image size shown above
function sidetracked_get_image($size = 'thumbnail-square') {
	$imageObj = get_field('feature_image', get_the_id());

	if ($imageObj != '') {
		$imageUrl = $imageObj[sizes][$size];
		$imageTitle = $imageObj[title];
		$imageHtml = '<img src="' . $imageUrl . '" alt="' . $imageTitle . '" />';
		return $imageHtml;
	} else {
		return;
	}
}
*/


?>