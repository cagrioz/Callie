var svTransitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';

/**
 * @class StoryView
 * @desc --
 * @param {} view -
 */
function StoryView( options ) {
  var fsvTemplate = [
    '<div class="sv-fake">',
      '<span class="close">X</span>',
      '<div class="profile">',
        '<div class="image"></div>',
        '<span class="name"></span>',
      '</div>',
      '<div class="content"><div class="media-container"></div></div>',
    '</div>'
  ];
  this.options = options;
  this.itemSelector = '.story-view-item';
  this.fsvTemplate = fsvTemplate.join('\n');
  this.view = $( options.view );
  this.stories = [];
  this.mediaItems = [];
  this.maskView = null;
  this.fakeStoryView = null;
  this.currentStory = null;
  this.currentMediaProgress = null;
  this.currentMedia = 0;
  this.paused = false;
  this.removingState = false;
  this.lastTouchStartTime = null;
  this.mediaStartTime = null;
  this.init();
}

StoryView.prototype.Helpers = {

  /**
   * @desc
   * @param {} element -
   */
  getBackground: function( element ) {
    var bg = element.css( 'background-image' );
    return bg.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '')
  },

  /**
   * @desc
   * @param {} element -
   */
  isTouchDevice: function() {
    return 'ontouchstart' in window || 'onmsgesturechange' in window;
  }
}

/**
 * @desc
 *
 */
StoryView.prototype.init = function() {
  this.getItems();
};

/**
 * @desc
 *
 */
StoryView.prototype.getItems = function() {
  var items = this.view.find( this.itemSelector );

  // Get all story items in view
  // #
  items.each( function( idx, item ) {
    var $item = $( item );

    /**
     * [ jQuery Event: click --> $item ]
     */
    $item.on( 'click', this.storyClick.bind( this, $item ) );

    $item.data( 'has-next', idx != items.length -1 ? true : false );
    this.stories.push( $item );
  }.bind( this ));
}

/**
 * @desc
 * @param {} story -
 */
StoryView.prototype.storyClick = function( story ) {
  if( story.hasClass( 'activated' ) ) return;
  this.removingState = false;
  this.openStory( story );
}

/**
 * @desc
 * @param {} x -
 */
StoryView.prototype.changeMediaByGesture = function ( x, type ) {
  var wv = $( window ).width();

  // Get next media
  // #
  if( x > wv / 2 ) {
    this.nextMedia( true );
  }

  // Get previous media
  // #
  if( x < wv / 2 ) {
    this.prevMedia( true );
  }
};


/**
 * @desc
 * @param {} event -
 */
StoryView.prototype.fakeStoryViewMouse = function( event ) {
    var diff
      , evX = event.clientX || event.changedTouches[ 0 ].clientX
      , evType = event.type;

  // Detecting pause state
  // #
  if( evType == 'touchstart' || evType == 'mousedown' )
    this.lastTouchStartTime = Date.now();

  if( evType == 'touchend' || evType == 'mouseup' )
    diff = Date.now() - this.lastTouchStartTime;

  if( !diff ) {
     this.paused = true;
    return;
  }
  else this.paused = false;

  if( ( evType == 'touchend' || evType == 'mouseup' ) && diff < 400 ) {
    this.changeMediaByGesture( evX, event.type );
  }
}


/**
 * @desc
 * @param {} mediaIndex -
 */
StoryView.prototype.closeStory = function() {
  var that = this
    , t1, t2;

  this.fakeStoryView.removeClass( 'open' );

  t1 = setTimeout( function() {
    clearTimeout( t1 );
    this.fakeStoryView.addClass( 'removing' );
  }.bind( this ), 200 );

  /*
   *
   *
   * [ jQuery Event: one --> this.fakeStoryView ]
   */
  this.fakeStoryView.one( svTransitionEnd, function() {
    this.fakeStoryView.removeClass( 'move' )
    this.maskView.removeClass( 'open' )
    this.currentStory.removeClass( 'activated' );

    t2 = setTimeout( function() {
      clearTimeout( t2 );
      this.removingState = true;
      this.currentMedia = 0;
      that.mediaItems = [];
      this.maskView.remove();
      this.fakeStoryView.remove();
      this.maskView = null;
      this.fakeStoryView = null;
      this.currentStory.removeClass( 'activated' );
      $( 'body' ).removeClass( 'story-view--shown' );
    }.bind( this ), 200 );
  }.bind( this ));

}

/**
 * @desc
 * @param {} story -
 * @param isNextStory -
 */
StoryView.prototype.openStory = function( story, isNextStory, mediaIndex ) {
  var that = this;
  var fakeStoryView = this.fakeStoryView || $( this.fsvTemplate )
    , background = this.Helpers.getBackground( story )
    , fsLeft = story.position().left
    , fsTop = story.position().top - $( window ).scrollTop()
    , maskView = null
    , t1, t2;

  if( !isNextStory ) {
    maskView = this.maskView = $( '<div class="sv-mask" />' );

    fakeStoryView.css({
      transform: 'translateX( '+ fsLeft +'px) translateY( '+ fsTop +'px )',
      width: story.width(),
      height: story.height()
    })
    $( 'body' ).append( fakeStoryView );
    $( 'body' ).append( maskView );

    /**
     *
     * [ jQuery event: [ click ] --> fakeStoryView .close ]
     */
    fakeStoryView.find( '.close' ).on( 'click touchstart', function() {
      that.closeStory();
    });

    /**
     *
     * [ jQuery event: [ mousedown mouseup touchstart touchend ] --> fakeStoryView ]
     */
     var eventList = 'mousedown mouseup touchstart touchend';
    fakeStoryView.on( eventList, function( event ) {
      event.preventDefault();
      that.fakeStoryViewMouse( event );
    });
  }

  fakeStoryView.find( '.image' ).css( 'background-image', 'url('+ background +')' );

  // Fill fake view
  // #
  this.fakeView( fakeStoryView, story );

  // Animate
  // #
  t1 = setTimeout( function() {
    clearInterval( t1 );

    if( !isNextStory ) {
      fakeStoryView.addClass( 'move' )
      maskView.addClass( 'open' )
    }

    this.currentStory = story;
    story.addClass( 'activated' );
  }.bind( this ));

  t2 = setTimeout( function() {
    clearInterval( t2 );

    if( !isNextStory )
      fakeStoryView.addClass( 'open' )
  }, 200 );

  $( 'body' ).addClass( 'story-view--shown' );
}

/**
 * @desc
 * @param {} view -
 * @param {} story -
 */
StoryView.prototype.fakeView = function( view, story ) {
  var that = this;
  var bars = $( '<ul class="media-bars" />' )
    , content = view.find( '.content' )
    , bar, $media, type, src;

  story.find( '.media li *' ).each( function( idx, media ) {
    $media = $( media );

    // Create bar
    // #
    bar = $( '<li><span class="progress"></span></li>' );
    bar.attr( 'data-type', type = $media.get( 0 ).tagName.toLowerCase() );
    bar.attr( 'data-src', src = $media.attr( 'src' ) );
    bars.append( bar );

    // Save media content
    // #
    that.mediaItems.push({
      duration: $media.parent().data( 'duration' ),
      type: type,
      src: src
    })
  });

  content.find( '.media-bars' ).remove();
  content.prepend( bars );
  this.fakeStoryView = view;

  // Start from first
  // #
  this.showMedia( this.currentMedia );
}

/**
 * @desc
 * @param {} mediaIndex -
 */
StoryView.prototype.showMedia = function( mediaIndex ) {
  var that = this;
  var item = this.mediaItems[ mediaIndex ]
    , bar = this.fakeStoryView.find( '.media-bars li' ).eq( mediaIndex )
    , content = this.fakeStoryView.find( '.content .media-container' )
    , progressItem = bar.find( '.progress' )
    , prevProgressItems = this.fakeStoryView.find( '.media-bars li:lt('+ this.currentMedia +') .progress' )
    , nextProgressItems = this.fakeStoryView.find( '.media-bars li:gt('+ this.currentMedia +') .progress' )
    , tick = 0
    , tempWidth = 0
    , element;

  this.mediaStartTime = Date.now();

  // Remove media if exist
  // #
  content.find( '.current-media' ).remove();

  // Create image
  // #
  if( item.type == 'img' ) {
    element = new Image();

    /**
     *
     * [ Image event: load --> element ]
     */
    element.onload = function() {
      content.append( this );
    }
    element.src = item.src;
  }

  if( item.type == 'video' ) {
    element = document.createElement( 'video' );
    element.src = item.src;
    element.autoplay = true;
    element.controls = false;
    content.append( element );
  }

  $( element ).addClass( 'current-media' );

  // Show between duration time
  // #
  progressItem.css( 'width', '0' );
  nextProgressItems.css( 'width', '0' );
  prevProgressItems.css( 'width', '100%' );
  this.currentMediaProgress = setInterval(function(a) {

    // Stop when removing
    // #
    if( that.removingState )
      clearInterval( that.currentMediaProgress );

    if( !that.paused ) {
      tempWidth = ( ( Date.now() - that.mediaStartTime ) / 1000 ) / item.duration * 100;
      progressItem.css( 'width', tempWidth + '%' )

      // Get next media when finished
      // #
      if( parseInt( tempWidth ) >= 100 )
        that.nextMedia();
    }
    //
    // #
    else that.mediaStartTime = Date.now();
  });
}

/**
 * @desc
 * @param {} fromClick -
 */
StoryView.prototype.nextMedia = function( fromClick ) {

  // if user clicked next close story view
  // on last media item of last story
  if( this.currentMedia + 1 == this.mediaItems.length && this.currentStory.next().length == 0 && fromClick ) {
    return;
  }

  clearInterval( this.currentMediaProgress );
  var next = this.currentMedia + 1 == this.mediaItems.length
    ? this.finish()
    : this.currentMedia++
  ;

  // Show next media
  // #
  if( !!Number( next ) || next === 0 )
    this.showMedia( this.currentMedia );
}

/**
 * @desc
 * @param {} fromClick -
 */
StoryView.prototype.prevMedia = function( fromClick ) {

  clearInterval( this.currentMediaProgress );
  var prev = this.currentMedia - 1 == -1 && this.currentStory.prev().length > 0
    ? this.finish( true )
    : this.currentMedia - 1 == -1 && this.currentStory.prev().length == 0
      ? this.currentMedia = 0
      : this.currentMedia--
  ;

  // Show next media
  // #
  if( !!Number( prev ) || prev === 0 )
    this.showMedia( this.currentMedia );
}

/**
 * @desc
 * @param {} mediaIndex -
 * @param {} prev -
 */
StoryView.prototype.finish = function( prev ) {
  var story;

  // Get next story
  // #
  if( !prev && this.currentStory.data().hasNext ) {
    story = this.currentStory.next();
    this.currentMedia = 0;
  }
  // Get prev story
  // #
  else if( prev && this.currentStory.prev().length > 0 ) {
    story = this.currentStory.prev();
    this.currentMedia = story.find( '.media li' ).length - 1;
  }

  if( story ) {
    this.mediaItems = [];
    this.currentStory.removeClass( 'activated' );
    this.openStory( story, true );
  }
  else this.closeStory();

} 