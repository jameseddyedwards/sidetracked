<?php

/*
 * Returns CSS class for specified image size
*/
function sidetracked_get_image_class($imageSize) {
	
	if ($imageSize != "") {

		switch ($imageSize) {
		case "square-large":
		case "rectangle-large":
		case "rectangle-wide":
			$class = "twelve";
			break;
		case "rectangle-medium":
		case "square-medium":
			$class = "eight";
			break;
		case "rectangle-small":
			$class = "six";
			break;
		case "square-thumbnail":
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

// Is the current page the news landing page?
function sidetracked_is_news_landing() {
	return get_cat_ID("News") == get_query_var('cat') ? true : false;
}

// Is the current page a news article page?
function sidetracked_is_news_article() {
	return get_the_title($post->post_parent) == 'News' ? true : false;
}