
jQuery(function(){

	// Conditional Branch for device
	if ((navigator.userAgent.indexOf('iPhone') > 0) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {

		//////// For smartphone //////////

  	var fixedarea = jQuery(".js-fixed");//fixed header
  	var slidebutton = jQuery(".js-slide-button");//slide button for slide navigation

		// fixed function depends on scroll position
		jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 180 ) {
				// fixedarea.addClass("is-active"); //一旦非表示
	    } else {
				// fixedarea.removeClass("is-active"); //一旦非表示
	    }
		});

    // slide function for slide navigation
    jQuery(function(){
    	slidebutton.click(function(){
    		jQuery(".js-slide").toggleClass("is-active");
    		jQuery(".js-overlay").toggleClass("is-active");
    	});
    	jQuery(".js-overlay").click(function(){
        jQuery(".js-slide").toggleClass("is-active");
    		jQuery(".js-overlay").toggleClass("is-active");
    	});
    });

	}else{

		//////// for Desktop //////////

		// Header Fixed Nav
		jQuery(window).load(function() {

			jQuery(window).scroll(function () {
		    if (jQuery(this).scrollTop() > 320) {
	        jQuery(".js-slide").addClass("is-active");
		    } else {
	        jQuery(".js-slide").removeClass("is-active");
		    }
			});

		});

	}

});


// Smooth Scroll
jQuery(function() {
	var headerHight = 98; //ヘッダの高さ
	jQuery('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = jQuery(this.hash);
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				jQuery('html,body').animate({
				scrollTop: target.offset().top-headerHight
				}, 500);
				return false;
			}
		}
	});
});

// viewport setting
$(function() {
  if(navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('iPod') > 0 || (navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0)){
    $("meta[name='viewport']").remove();
    $("head").append('<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">');
  } else {
    $("meta[name='viewport']").remove();
    $("head").append('<meta name="viewport" content="width=1180px,user-scalable=auto">');
  }
});

// embed map
$('.embed-map').click(function () {
  $('.embed-map iframe').css("pointer-events", "auto");
});

$( ".embed-map" ).mouseleave(function() {
  $('.embed-map iframe').css("pointer-events", "none");
});
