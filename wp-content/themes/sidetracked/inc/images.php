<?php

// Add Sidetracked's custom image sizes
add_theme_support('post-thumbnails');
add_image_size('square-thumbnail', 195, 195, true);
add_image_size('square-small', 404, 404, true);
add_image_size('square-medium', 822, 822, true);
add_image_size('square-large', 1240, 1240, true);
add_image_size('rectangle-small', 613, 404, true);
add_image_size('rectangle-medium', 822, 404, true);
add_image_size('rectangle-large', 1240, 822, true);
add_image_size('rectangle-wide', 1240, 404, true);
add_image_size('rectangle-xl', 9999, 1000, true);


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
		"square-thumbnail" => __("Square Thumbnail"),
		"square-small" => __("Square Small"),
		"square-medium" => __("Square Medium"),
		"square-large" => __("Square Large"),
		"rectangle-small" => __("Rectangle Small"),
		"rectangle-medium" => __("Rectangle Medium"),
		"rectangle-large" => __("Rectangle Large"),
		"rectangle-wide" => __("Rectangle Wide")
	);
	$newimgsizes = array_merge($sizes, $myimgsizes);
	
	return $newimgsizes;
}
add_filter('image_size_names_choose', 'custom_wmu_image_sizes');


function sidetracked_gallery($sizes) {
	$gallery = get_field('sidetracked_gallery');
	$html = '';

	if ($images) {
		$html = '<div class="flexslider">';
		$html .= '<ul class="slides">';
		foreach($images as $image) {
			$html .= '<li>';
			$html .= '<img src="' . $image['sizes']['square-thumbnail'] . '" alt="' . $image['alt'] . '" />';
			$html .= '<p class="flex-caption">' . $image['caption'] . '</p>';
			// Try to get metadata for image - link
			// $html .= '<?php wp_get_attachment_metadata($attachment_id);
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
	}
	return $html;
}
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