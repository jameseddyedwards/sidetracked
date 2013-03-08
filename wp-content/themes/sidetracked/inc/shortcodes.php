<?php

function span_one_shortcode($atts, $content = null) {
	if ($content != null) {
		extract(shortcode_atts(array(
			'url' => '/'
		), $atts));

		$sizeArray = explode(',', $content);

		return sidetracked_gallery($sizeArray);
	}
}

function structure_row($content = null) {return '<div class="row">' . do_shortcode($content) . '</div>';}
function structure_span_one($content = null) {return '<div class="one">' . $content . '</div>';}
function structure_span_two($content = null) {return '<div class="two">' . $content . '</div>';}
function structure_span_three($content = null) {return '<div class="three">' . $content . '</div>';}
function structure_span_four($content = null) {return '<div class="four">' . $content . '</div>';}
function structure_span_five($content = null) {return '<div class="five">' . $content . '</div>';}
function structure_span_six($content = null) {return '<div class="six">' . $content . '</div>';}
function structure_span_seven($content = null) {return '<div class="seven">' . $content . '</div>';}
function structure_span_eight($content = null) {return '<div class="eight">' . $content . '</div>';}
function structure_span_nine($content = null) {return '<div class="nine">' . $content . '</div>';}
function structure_span_ten($content = null) {return '<div class="ten">' . $content . '</div>';}
function structure_span_eleven($content = null) {return '<div class="eleven">' . $content . '</div>';}
function structure_span_twelve($content = null) {return '<div class="twelve">' . $content . '</div>';}

add_shortcode('row', 'structure_row');
add_shortcode('one', 'structure_span_one');
add_shortcode('two', 'structure_span_two');
add_shortcode('three', 'structure_span_three');
add_shortcode('four', 'structure_span_four');
add_shortcode('five', 'structure_span_five');
add_shortcode('six', 'structure_span_six');
add_shortcode('seven', 'structure_span_seven');
add_shortcode('eight', 'structure_span_eight');
add_shortcode('nine', 'structure_span_nine');
add_shortcode('ten', 'structure_span_ten');
add_shortcode('eleven', 'structure_span_eleven');
add_shortcode('twelve', 'structure_span_twelve');


?>
