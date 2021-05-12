global.$ = global.jQuery = require('jquery');
let Slick = require('slick-carousel');

// import ModuleName from 'module-path';
// let libName = require('library-name');

const magnificPopup = require('magnific-popup');
const Formstone = require('formstone');
const superfish = require('superfish');

require('formstone/dist/js/navigation.js');
require('formstone/dist/js/background.js');
require('formstone/dist/js/equalize.js');
require('formstone/dist/js/cookie.js');
require('formstone/dist/js/tooltip.js');

// $.fn.isInViewport = function() {
//     var elementTop = $(this).offset().top;
//     var elementBottom = elementTop + $(this).outerHeight() / 2;

//     var viewportTop = $(window).scrollTop();
//     var viewportBottom = viewportTop + $(window).height();

//     return elementBottom > viewportTop && elementTop < viewportBottom;
// };


jQuery(document).ready(function($) {

    var hidelegend = $.cookie('hidefeilegend');

    if (!hidelegend) {
        $('#feilegend').show();
    } else {
        $( "#show-fei-legend" ).show();
    }
    $("#show-fei-legend").tooltip({
      direction: "bottom",
    });

    $( "#hide-fei-legend" ).on( "click", function(event) {
        $.cookie('hidefeilegend', true);
        $('#feilegend').fadeOut();
        $( "#show-fei-legend" ).fadeIn();
        event.preventDefault();
    });
    $( "#show-fei-legend" ).on( "click", function(event) {
        $.cookie('hidefeilegend', null);
        $('#show-fei-legend').fadeOut();
        $('#feilegend').show();
        $(".fei-sidebar").navigation("close");
        $(".equalize").equalize("resize");
        event.preventDefault();
    });


    // $(window).on('resize scroll', function() {
    //     if ($('.slider').isInViewport()) {
    //         $('#sidemenu').css({backgroundColor: 'rgba(12%, 4%, 14%, 0.75)'});
    //     } else {
    //         $('#sidemenu').css({backgroundColor: 'rgba(12%, 4%, 14%, 0.95)'});
    //     }
    // });

    $('ul.mainmenu').superfish({
      delay:       0,
      animation:   {opacity:'show',height:'show'},
      speed:       'fast',
      autoArrows:  false
    });

    // navtoggle
    $("#mobilenav").navigation({
        type: "overlay",
        gravity: "right",
        maxWidth: "1024px",
        label: false
    });

    $( "#hidemenu" ).on( "click", function(event) {
        $("#mobilenav").navigation("close");
        event.preventDefault();
    });

    $(".fei-sidebar").navigation({
        type: "overlay",
        gravity: "left",
        maxWidth: "1279px",
        label: false
    });

    $('.background').background();

    $('.modal').magnificPopup({
        type:'inline',
        midClick: true,
    });

    $('.equalize').equalize();

    $('.slider').slick({
        fade: true,
        arrows: false,
        dots: true,
        autoplay: true,
        infinite: true,
        speed: 500,
        autoplaySpeed: 4500,
        focusOnSelect: true,
        pauseOnHover: true,
        pauseOnDotsHover: true,
        adaptiveHeight: true
    });

    $('.accordion-toggle').on('click', function(event){
        event.preventDefault();
        // create accordion variables
        var accordion = $(this);
        var accordionContent = accordion.next('.accordion-content');

        // toggle accordion link open class
        accordion.toggleClass("open");
        // toggle accordion content
        accordionContent.slideToggle(250);

        $('.accordion-toggle').not(this).removeClass("open").next('.accordion-content').slideUp(250);

    });

});
