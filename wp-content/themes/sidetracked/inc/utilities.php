<?php

/*
 * Returns CSS class for specified image size
*/
function sidetracked_get_image_class($imageSize) {
	
	if ($imageSize != "") {

		switch ($imageSize) {
		case "large-square":
		case "large-rectangle":
		case "wide-rectangle":
			$class = "twelve";
			break;
		case "medium-rectangle":
		case "medium-square":
			$class = "eight";
			break;
		case "small-rectangle":
			$class = "six";
			break;
		case "thumbnail-square":
			$class = "two";
			break;
		default:
			$class = "four";
		}
	
	} else {
		$class = "four";
	}
	
	return $class;
}
