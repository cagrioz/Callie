jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.callie_loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': callie_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : callie_loadmore_params.current_page
		};
 
		$.ajax({ // you can also use $.post here
			url : callie_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.addClass('loading'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 

					button.removeClass('loading');
					$('.masonry').append(data);
                	$('.masonry').masonry('reloadItems');

                	var masonry = $('.masonry').data('masonry');
                	masonry.layout();


					callie_loadmore_params.current_page++;
 
					if ( callie_loadmore_params.current_page == callie_loadmore_params.max_page ) 
						button.remove(); // if last page, remove the button
 
					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});