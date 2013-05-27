<?php

/* Utility function for use across the Sidetracked website */

function my_acf_format_value_for_api($value, $post_id, $field){
	return str_replace( ']]>', ']]>', apply_filters( 'the_content', $value) );
}
function my_on_init(){
	if(!is_admin()){
		remove_all_filters('acf/format_value_for_api/type=wysiwyg');
		add_filter('acf/format_value_for_api/type=wysiwyg', 'my_acf_format_value_for_api', 10, 3);
	}
}
add_action('init', 'my_on_init');


// Is the current page the news landing page?
function sidetracked_is_news_landing() {
	return get_cat_ID("News") == get_query_var('cat') ? true : false;
}


// Is the current page a news article page?
function sidetracked_is_news_article() {
	return get_the_title($post->post_parent) == 'News' ? true : false;
}


// Generates a newsletter sign up block
function sidetracked_newsletter_signup($buttonText) {

	$buttonText = $buttonText != '' ? $buttonText : "GO";

	$html = '<hr />';
	$html .= '<section class="block newsletter-signup">';
	$html .= '<div class="row">';
	$html .= '<div class="span twelve">';
	$html .= '<h4 class="center">Don\'t miss out. Sign up to receive free monthly email updates from Sidetracked</h4>';
	$html .= '<form class="newsletter" action="http://groups.google.com/group/sidetracked/boxsubscribe">';
	$html .= '<fieldset class="single-input">';
	$html .= '<input name="email" type="text" placeholder="sign up for enews updates">';
	$html .= '<input name="sub" type="submit" value="' . $buttonText . '">';
	$html .= '</fieldset>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</section>';

	return $html;
}

?>