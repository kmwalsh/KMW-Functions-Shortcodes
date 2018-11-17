jQuery(document).ready(function( $ ) {

	
// open external links in new window
$('.kmw-js-sc-toggle').on('click', function()
{
	if ( ! $(this).parent().hasClass('kmw-open') ){
		$(this).parent().addClass('kmw-open');
		$(this).siblings('.kmw-sc-dropdown').slideDown();
	} else {
		$(this).parent().removeClass('kmw-open');
		$(this).siblings('.kmw-sc-dropdown').slideUp();
	}
});


// open external links in new window
$('a').each(function() {
		var a = new RegExp('/' + window.location.host + '/');
		if(!a.test(this.href)) {
			$(this).click(function(event) {
				event.preventDefault();
				event.stopPropagation();
				window.open(this.href, '_blank');
			});
		}
});

// anchor links fix on sites with sticky header
jQuery('a[href*=\\#]]')
	.click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

		var target = jQuery(this.hash);
		target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		if (target.length) {
		jQuery('html,body').animate({
			scrollTop: target.offset().top - 125 //offsets for fixed header
		}, 1000);
		return false;
		}
	}
	});
	//Executed on page load with URL containing an anchor tag.
	if(jQuery(location.href.split("#")[1])) {
	var target = jQuery('#'+location.href.split("#")[1]);
	if (target.length) {
		jQuery('html,body').animate({
		scrollTop: target.offset().top - 125 //offset height of header here too.
		}, 1000);
		return false;
	}
}

}); //jQuery noConflict WP Wrapper

