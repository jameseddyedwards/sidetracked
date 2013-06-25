
function articleRollover($){

	$('.article-img', '.edition').hover(function(){
		$(this).children('.title-bar').stop(true, true).fadeIn('slow');
		console.log("hover");
	},
	function(){
		$(this).children('.title-bar').stop(true, true).fadeOut('slow');
	});

}


jQuery(document).ready(function($) {
	// Fit Vids
	articleRollover($);
	$("article").fitVids();
});