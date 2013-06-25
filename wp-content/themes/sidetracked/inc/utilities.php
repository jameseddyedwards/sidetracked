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
	return get_post_type($post) == "news-article" ? true : false;
}

// Is Edition?
function sidetracked_is_edition() {
	return strpos(strtolower(get_the_title()), 'edition') !== false ? true : false;
}

// Is page style inverted
function is_inverted() {
	return $invert = is_single() || sidetracked_is_news_article() || sidetracked_is_news_landing() ? true : false;
}

// Gets inverted class if page style is inverted
function get_invert_class() {
	return is_inverted() ? 'invert' : '';
}

?>