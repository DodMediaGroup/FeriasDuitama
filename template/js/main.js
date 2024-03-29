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
        if($(window).width() >= 751){
            $carousel.find('.active').each(function(index, el) {
                if(index == 0)
                    $(this).addClass('left');
                else if(index == 1)
                    $(this).addClass('live');
                else if(index == 2)
                    $(this).addClass('right');
            });
        }
        else{
            $carousel.find('.active').each(function(index, el) {
                $(this).addClass('live');
            });
        }
    }
    $removeCarouselClass = function(event){
        $carousel.find('.live, .left, .right').removeClass('left live right');
    }
    $carousel.owlCarousel({
        items: 3,
        margin: 12,
        responsiveClass:true,
        responsive:{
            0: {
                items: 1
            },
            768: {
                items: 3
            }
        },

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
            accounts: ['@feriadeduitama','!feriadeduitama'],
            limit: 5,
            access_token: '203728599967701|64758de9e7f82ce8e2d13211ae9cdbc0'
        },
        twitter:{
            accounts: ['@FeriaDeDuitama'],
            limit: 5,
            consumer_key: 'AKKltjX0hfabCm5bwDx2zrzZB',
            consumer_secret: '8OncjL3pI8acpmjF3bICLK9kehmBqeQQ7PBVOXzROEZ94TegwB',
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
$.createAccordion = function($box){
    $box.accordion({
        active: false,
        collapsible: true,
        heightStyle: "content"
    });
}
$.loadEventJson = function($link){
    //$.activeLoading();
    //$('body').addClass('mod-modal');

    $.ajax({
        url: $link.attr('href'),
        type: 'GET',
        dataType: 'json',
    })
    .done(function(data) {
        $title = $('.event__load').find('.title-post');
        $image = $('.event__load').find('.post-image img');
        $place = $('.event__load').find('.event-place');
        $hour = $('.event__load').find('.event-hour');
        $description = $('.event__load').find('.post-content');

        $title.text(data.title);
        $image.attr({
            src: data.image,
            alt: data.title
        });
        $place.text(data.place);
        $hour.text(data.hour);
        $description.html(data.description);

        $('.events__list a.active').removeClass('active');
        $link.addClass('active');

        $(document).scrollTop($('.event__load').position().top);
    })
    .fail(function() {
        $.showMessage('Ocurrio un error en la conexión. Por favor intente mas tarde.');
    })
    .always(function() {
        $.deactiveLoading();
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
    $('.accordion').each(function(index, el) {
        $.createAccordion($(this));
    });

    $('.menu-button').on('click', function(event) {
        event.preventDefault();
        $menu = $(this).parent('.menu');
        if($menu.hasClass('active'))
            $menu.removeClass('active');
        else
            $menu.addClass('active');
    });
    $('.load-event').on('click', function(event) {
        event.preventDefault();
        $.loadEventJson($(this));
    });
}