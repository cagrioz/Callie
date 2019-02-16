jQuery(document).ready(function($) {

	// ---------------------------------------------------------
	//  	Video
	// ---------------------------------------------------------
	var videoOptions = jQuery('#callie_video_format_metabox');
	var videoTrigger = jQuery('#post-format-video');

	videoOptions.css('display', 'none');

	// ---------------------------------------------------------
	//  	Gallery
	// ---------------------------------------------------------
	var galleryOptions = jQuery('#callie_gallery_format_metabox');
	var galleryTrigger = jQuery('#post-format-gallery');

	galleryOptions.css('display', 'none');

	// ---------------------------------------------------------
	//  	Core
	// ---------------------------------------------------------
	var group = jQuery('#post-formats-select input');

	group.change( function() {

		if(jQuery(this).val() == 'gallery') {
			galleryOptions.css('display', 'block');
			CallieHideAll(galleryOptions);

		} else if(jQuery(this).val() == 'video') {
			videoOptions.css('display', 'block');
			CallieHideAll(videoOptions);

		} else {
			videoOptions.css('display', 'none');
			galleryOptions.css('display', 'none');
		}

	});

	if(galleryTrigger.is(':checked'))
		galleryOptions.css('display', 'block');

	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');

	function CallieHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		galleryOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}

	// ---------------------------------------------------------
	//  	Story
	// ---------------------------------------------------------
	

});