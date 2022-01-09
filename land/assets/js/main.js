(function($) {
    "use strict";

    jQuery(document).ready(function($) {

        /*------------------------------
            wow js init
        -------------------------------*/
        new WOW().init();

    });

    /*------------------------------
           Scroll to top
    -------------------------------*/

    $(window).scroll(function() {

        if ($(this).scrollTop() > 800) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    })

    $(".scroll-to-top").click(function() {

        $("html, body").animate({
            scrollTop: 0
        }, 2000);
    })

    $(window).on('load', function() {

        /*------------------------------
           Preloader
        -------------------------------*/

        $('.preloader-inner').fadeOut(1000);
    });

}(jQuery));