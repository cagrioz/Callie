jQuery(function($){

    "use strict";

    // Story Setup
    var storyView = new StoryView({
        view: document.querySelector('.stories'),
        autoClose: true
    });

    var storyWidgetView = new StoryView({
        view: document.querySelector('.story-widget-carousel'),
        autoClose: true
    });
    
    /* Sidemenu */
    $(".mobile-toggle").on("click", function() {
        $(".mobile-menu").toggleClass("slidein");
        $(".wrapper").toggleClass("stop");
    });
    
    $(".mobile-navigation ul").parent().addClass("menu-item-has-children");
    $(".mobile-navigation li.menu-item-has-children > a").on("click",function(){
        $(this).next("ul").slideToggle();
        $(this).parent().siblings().find("ul").slideUp();
        return false;
    });

    /* =========== FitVids =========== */
    $(".post-thumbnail").fitVids();

    /* Masonry Layout */
    $('.masonry').masonry({
        itemSelector: '.post',
        percentPosition: true,
        gutter: 26
    });
    
    /* Tweet Slider */
    $(".tweet-slider").owlCarousel({
    	items:1,
        loop:true,
        autoplay:true,
        autoplayTimeout:4000,
        smartSpeed:500,
        dots:true,
        nav:false
    });

    /* Story Slider */
    $(".story-widget .story-inner").owlCarousel({
        loop:true,
        smartSpeed:500,
        dots:true,
        mouseDrag:false,
        nav:false,
        responsive: {
            0: {
                items:2
            },
            310: {
                items:3
            }
        }
    });

    /* Gallery Format */
    $('.post-thumbnail.gallery').owlCarousel({
        items:1,
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        smartSpeed:1000,
        dots:false,
        nav:true,
        navText:["<img src='./resources/icons/prev.svg'>", "<img src='./resources/icons/next.svg'>"]
    });
    
    /* You May Also Like Slider */
    $('.related-posts-wrapper').owlCarousel({
        items:1,
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        smartSpeed:1500,
        dots:true,
        mouseDrag:false,
        animateOut:'slideOutDown',
        animateIn:'slideInDown',
    });

    $('.post-thumbnail.video').magnificPopup({
        type: 'iframe',
        
        iframe: {
            markup: '<div class="mfp-iframe-scaler">'+
                        '<div class="mfp-close"></div>'+
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
        },

        patterns: {
            youtube: {
                index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                id: 'v=', // String that splits URL in a two parts, second part should be %id%
                // Or null - full URL will be returned
                // Or a function that should return %id%, for example:
                // id: function(url) { return 'parsed id'; }

                src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
            },
            vimeo: {
                index: 'vimeo.com/',
                id: '/',
                src: '//player.vimeo.com/video/%id%?autoplay=1'
            }
        },
        srcAction: 'iframe_src', 
    });
    
}); /*=== Document.Ready Ends Here ===*/