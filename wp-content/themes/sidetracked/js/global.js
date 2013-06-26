
function articleRollover($){

	$('.article-img', '.edition').hover(function(){
		$(this).children('.title-bar').stop(true, true).fadeIn('slow');
	},
	function(){
		$(this).children('.title-bar').stop(true, true).fadeOut('slow');
	});

	$('.article-img', '.also-on-sidetracked').hover(function(){
		$(this).children('.title-bar').stop(true, true).fadeIn('slow');
	},
	function(){
		$(this).children('.title-bar').stop(true, true).fadeOut('slow');
	});

}

function updateHeight($) {
	$('.posted-on', '.news').height($('img', '.news-article-image').height());
}

function newsDateHeightMatch($) {
	
	$(window).resize(function() {
		updateHeight($)
	});

	updateHeight($)
}

function touchScreenNav($) {
	$(".nav-button").click(function(){
		console.log("clicked");
		$(this).siblings("nav").toggleClass('hidden-phone').toggleClass('hidden-tablet');
	});
}


jQuery(document).ready(function($) {
	// Fit Vids
	touchScreenNav($);
	articleRollover($);
	newsDateHeightMatch($)
	$("article").fitVids();
});