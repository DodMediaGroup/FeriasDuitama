jQuery(document).ready(function($) {
	$.init();
});

$.imgToSvg = function(image){
    var $img = image;
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    $.get(imgURL, function(data) {
        var $svg = jQuery(data).find('svg');
        if(typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
        }
        if(typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', imgClass+' replaced-svg');
        }
        $svg = $svg.removeAttr('xmlns:a');
        $img.replaceWith($svg);

        if($img.hasClass('map-animate'))
            $.myScrollAnimate();
    }, 'xml');
}
$.resizing = function(element){
    $(window).resize(function() {
        var width = element.outerWidth();
        element.css({
            "height": width * eval(element.attr('data-resizing'))
        });
        if(element.hasClass('panel')){
            element.parent().find('.panel').css({
                "height": width * eval(element.attr('data-resizing'))
            });
        }
    }).resize();
}
$.activeLoading = function(){
    $('.modal-loading').addClass('active');
}
$.deactiveLoading = function(){
    $('.modal-loading').removeClass('active');
}
$.showMessage = function($message, $type){
    $type = $type || '';
    $box = $('.message-popup');

    $box.text($message);
    $box.css({
        top: $('.bar-menu').outerHeight()
    }).addClass('active ' + $type);
    
    setTimeout(function(){
        $box.css({
            top: 0
        }).removeClass('active ' + $type);
        setTimeout(function(){
            $box.text('');
        }, 400)
    }, 8000);
}

/***** FERIASDUITAMA *****/
$.runSlider = function($slider){
    $slider.fractionSlider();
}
$.runCarousel = function($carousel){
	$addCarouselClass = function(event){
		$carousel.find('.live, .left, .right').removeClass('left live right');
	    $carousel.find('.active').each(function(index, el) {
	    	if(index == 0)
	    		$(this).addClass('left');
	    	else if(index == 1)
	    		$(this).addClass('live');
	    	else if(index == 2)
	    		$(this).addClass('right');
	    });
	}
	$removeCarouselClass = function(event){
		$carousel.find('.live, .left, .right').removeClass('left live right');
	}
	$carousel.owlCarousel({
		items : 3,
		margin: 12,
		responsiveClass:true,

		onDrag: $removeCarouselClass,
		onInitialized: $addCarouselClass,
		onTranslated: $addCarouselClass
	});
	$carousel.on('click', function(event) {
		event.preventDefault();
		$addCarouselClass();
	});
}
$.socialFeed = function(content){
	var gridOptions = {
        itemSelector: '.social-feed-element',
        percentPosition: true,
        columnWidth: '.grid-sizer'
    };
    content.socialfeed({
        facebook:{
            accounts: ['@alfonsosilvaalcalde','!alfonsosilvaalcalde'],
            limit: 5,
            access_token: '150849908413827|a20e87978f1ac491a0c4a721c961b68c'
        },
        twitter:{
            accounts: ['@SilvaPesca2015'],
            limit: 5,
            consumer_key: 'dsXxL9n5ndT6WJBgZem0iFErw',
            consumer_secret: 'wwre7ne4AOSneaRGQlu1kSjs7UEjzxQsykqEaXB0isvLYX1Q45',
        },
        // GENERAL SETTINGS
        length:200,
        show_media:true,
        template: '_template-social.html',
        // Moderation function - if returns false, template will have class hidden
        moderation: function(content){
            return  (content.text) ? content.text.indexOf('fuck') == -1 : true;
        },
        //update_period: 5000,
        // When all the posts are collected and displayed - this function is evoked
        callback: function(){
            content.imagesLoaded().progress( function() {
                content.masonry(gridOptions);
            });
        }
    });
}

$.init = function(){
	//$.activeLoading();
    //$('body').addClass('mod-modal');

    $(document).on('keypress', '.js-input-number', function(event){
        if(!((event.which <= 57 && event.which >= 48) || event.which == 8))
            event.preventDefault();
    });

    $('.to-svg').each(function(index, el) {
        $.imgToSvg($(this));
    });

    $('.js-resizing').each(function(index, el) {
        $.resizing($(this));
    });

    /***** FERIASDUITAMA *****/
    $('.slider').each(function(index, el) {
        $.runSlider($(this));
    });
    $('.oxl-carousel').each(function(index, el) {
    	$.runCarousel($(this));
    });
    $('#social-feed').each(function(index, el) {
        $.socialFeed($(this));
    });
}