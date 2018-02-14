/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
	*
	*	Current Page Active
	*
	------------------------------------*/
	$("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});

	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	//ajaxLock is just a flag to prevent double clicks and spamming
	var ajaxLock = false;

	var postOffset = parseInt(jQuery( '#offset' ).text());
	//Change that to your right site url unless you've already set global ajaxURL
	var ajaxURL = bellaajaxurl.url;

	function ajax_next_posts() {
		if( ! ajaxLock ) {
			ajaxLock = true;
			
			//Parameters you want to pass to query
			var ajaxData = '&post_type='+bellaajaxurl.posttype;
			if(bellaajaxurl.taxtype){
				ajaxData+='&tax_type='+bellaajaxurl.taxtype+'&tax_type_value='+bellaajaxurl.taxtypevalue;
			}
			ajaxData+='&post_offset=' + postOffset + '&action=bella_ajax_next_posts';

			//Ajax call itself
			jQuery.ajax({

				type: 'get',
				url:  ajaxURL,
				data: ajaxData,
				dataType: 'json',

				//Ajax call is successful
				success: function ( response ) {
					if(parseInt(response[1])!==0){
						$tracking.append(response[0]);
						postOffset+=parseInt(response[1]);
						$('.js-blocks').matchHeight();
						ajaxLock = false;
					}
				},

				//Ajax call is not successful, still remove lock in order to try again
				error: function (err) {
					ajaxLock = false;
				}
			});
		}
	}
	var $window = $(window);
	var $document = $(document);
	var $tracking = $('.tracking');
	if($tracking.length>0){
		$window.scroll(function(){
			var top = $tracking.offset().top;
			var height = $tracking.height();
			var w_height = $window.height();
			var d_scroll = $document.scrollTop();
			if(w_height+d_scroll>height+top){
				ajax_next_posts();
			}
		});
	}

	//ajaxLock is just a flag to prevent double clicks and spamming
	var ajaxLockImage = false;

	var postOffsetImage = parseInt(jQuery( '#offset' ).text());
	//Change that to your right site url unless you've already set global ajaxURL
	var ajaxURLImage = bellaajaxurl.url;

	function ajax_next_image() {
		if( ! ajaxLockImage ) {
			ajaxLockImage = true;
			
			//Parameters you want to pass to query
			var ajaxData = '&post_offset=' + postOffsetImage + '&post_id='+bellaajaxurl.postid+'&action=bella_ajax_next_image';

			//Ajax call itself
			jQuery.ajax({

				type: 'get',
				url:  ajaxURLImage,
				data: ajaxData,
				dataType: 'json',

				//Ajax call is successful
				success: function ( response ) {
					if(parseInt(response[1])!==0){
						$trackingImage.append(response[0]);
						postOffsetImage+=parseInt(response[1]);
						ajaxLockImage = false;
					}
				},

				//Ajax call is not successful, still remove lock in order to try again
				error: function (err) {
					ajaxLockImage = false;
				}
			});
		}
	}
	
	var $trackingImage = $('.tracking-images');
	if($trackingImage.length>0){
		$window.scroll(function(){
			var top = $trackingImage.offset().top;
			var height = $trackingImage.height();
			var w_height = $window.height();
			var d_scroll = $document.scrollTop();
			if(w_height+d_scroll>height+top){
				ajax_next_image();
			}
		});
	}

});// END #####################################    END