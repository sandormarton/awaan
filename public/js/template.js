
jQuery(document).ready( function() {
    // jQuery(".lazy-image").unveil(300);

    // jQuery(document).find(".lazy-image-handler").unveil(200, function() {
    //     jQuery(this).load(function() {
    //         jQuery(this).removeData("src");
    //         jQuery(this).addClass("loaded");
    //     });
    // });

    jQuery(".lazy-image-handler").Lazy({
        onFinishedAll: function() {
            jQuery(this).removeData("src");
            jQuery(this).addClass("loaded");
        }
    });
    // jQuery("body").niceScroll({
		// cursorcolor : '#2BB6F3',
		// cursorborder : '1px solid #2BB6F3',
		// cursorborderradius : '5px',
    //     cursorwidth: "10px",
    //     autohidemode:  false,
    //     bouncescroll: false,
    //     smoothscroll: true
    // });
	var lang = jQuery('#language-selected').attr('data-lang');
	var direction = 'ltr';
	if(lang == 'ar'){
        direction = 'rtl';
	}
	//console.log('direction :' + direction);
	jQuery('select').select2({
		minimumResultsForSearch: Infinity,
		dir: direction
	});

    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|BB10/i.test(navigator.userAgent) ? true : false;

	jQuery(window).scroll(function(){
		var homeScroll = 150;
		if(isMobile){
            homeScroll = 100;
		}
		if(!$("#TopLeaderboardCollapse-wrappper").hasClass('in')){
            homeScroll = 50;
		}
        if (jQuery(this).stop().scrollTop() > homeScroll) {
            jQuery('.menu-wrapper').addClass('stickytop-menu-wrapper');
            // jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.menu-wrapper').removeClass('stickytop-menu-wrapper');
            // jQuery('.scrollup').fadeOut();
        }
    });
    
    jQuery('.scrollup').click(function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 500);
        return false;
    });
    
    jQuery(".menuprogramCollapse").mCustomScrollbar({
	    theme:"minimal"
	});
    	
});
