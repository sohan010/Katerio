;
(function($) {
    "use strict";

    $(document).ready(function() {

        // JS for rtl
        var rtlEnable = $('html').attr('dir');
        var sliderRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');
        var OwlRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');

        /*--------------------
            wow js init
        ---------------------*/
        new WOW().init();

        /*------------------------------------
            magnific popup activation
        --------------------------------------*/

        $('.videos-play, .videos-play-global').magnificPopup({
            type: 'iframe',
        });

        /* 
        ----------------------------------------
            SearchBar
        ----------------------------------------
        */

        $(document).ready(function() {
            $('.search-close').on('click', function() {
                $('.search-bar').removeClass('active');
            });
            $('.search-open').on('click', function() {
                $('.search-bar').toggleClass('active');
            });
        });

        /* 
        ----------------------------------------
            Sidebars
        ----------------------------------------
        */

        $(document).ready(function() {
            $('.sidebars-close').on('click', function() {
                $('.sidebars-wrappers').removeClass('active');
            });
            $('.sidebars-item').on('click', function() {
                $('.sidebars-wrappers').toggleClass('active');
            });
        });


        /*----------------------
            Slick Slider
        -----------------------*/

        $('.slick-slider-one').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: OwlRtlValue,
            arrows: true,
            dots: false,
            prevArrow: '<i class="las la-angle-left"></i>',
            nextArrow: '<i class="las la-angle-right"></i>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
        });

        $('.slick-slider-two').slick({
            slidesToShow: 1,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            prevArrow: '<i class="las la-angle-left"></i>',
            nextArrow: '<i class="las la-angle-right"></i>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
        });

        $('.slick-slider-three,.video-slider-two,.comments-sldier').slick({
            rtl: OwlRtlValue,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            prevArrow: '<i class="las la-arrow-left"></i>',
            nextArrow: '<i class="las la-arrow-right"></i>',
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
        });
        $('.slick-slider-four').slick({
            rtl: OwlRtlValue,
            slidesToShow: 6,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            prevArrow: '<i class="las la-arrow-left"></i>',
            nextArrow: '<i class="las la-arrow-right"></i>',
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            swipeToSlide: true,
            responsive: [{
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 5,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 375,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        $('.team-slider').slick({
            slidesToShow: 4,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            prevArrow: '<i class="las la-arrow-left"></i>',
            nextArrow: '<i class="las la-arrow-right"></i>',
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            swipeToSlide: true,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*----------------------
            Banner Ads
        -----------------------*/

        $('.banner-ads-slider').slick({
            slidesToShow: 1,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            prevArrow: '<i class="las la-angle-left"></i>',
            nextArrow: '<i class="las la-angle-right"></i>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
        });

        /*----------------------
            Video Slider
        -----------------------*/

        $('.video-slider').slick({
            slidesToShow: 1,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            prevArrow: '<i class="las la-angle-left"></i>',
            nextArrow: '<i class="las la-angle-right"></i>',
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
        });

        /*----------------------
            Sports Slider
        -----------------------*/

        $('.sports-slider').slick({
            slidesToShow: 4,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            prevArrow: '<i class="las la-angle-left"></i>',
            nextArrow: '<i class="las la-angle-right"></i>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
            responsive: [{
                    breakpoint: 1300,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*----------------------
            News Filter isotoop
        -----------------------*/
        $('#imageloader').imagesLoaded(function() {
            var $grid = $('.news-grids').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-item',
                }
            });
            // filter items on button click
            $('.news-button-list').on('click', '.lists', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({ filter: filterValue });
                // filter items add class
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });
        });


        /*
        ========================================
            accordion
        ========================================
        */

        $('.faq-contents .faq-title').on('click', function(e) {
            var element = $(this).parent('.faq-item');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('.faq-panel').removeClass('open');
                element.find('.faq-panel').slideUp(300, "swing");
            } else {
                element.addClass('open');
                element.children('.faq-panel').slideDown(300, "swing");
                element.siblings('.faq-item').children('.faq-panel').slideUp(300, "swing");
                element.siblings('.faq-item').removeClass('open');
                element.siblings('.faq-item').find('.faq-title').removeClass('open');
                element.siblings('.faq-item').find('.faq-panel').slideUp(300, "swing");
            }
        });

    });


    $(window).on('scroll', function() {

        //back to top show/hide
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 300) {
            ScrollTop.fadeIn(300);
        } else {
            ScrollTop.fadeOut(300);
        }
    });

    /*------------------
        back to top
    ------------------*/
    $(document).on('click', '.back-to-top', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 1500);
    });

    /*-------------------------------
        Navbar Fix
    ------------------------------*/
    $(window).on('resize', function() {
        if ($(window).width() < 991) {
            navbarFix()
        }
    });

    function navbarFix() {
        $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children>a, .navbar-area .navbar-nav li.appside-megamenu>a', function(e) {
            e.preventDefault();
        })
    }


    /*-----------------
        preloader
    ------------------*/

    $(window).on('load', function() {
        $('#preloader').delay(1000).fadeOut('slow');
        $('body').delay(1000).css({
            'overflow': 'visible',
        });
    });

    /* $(window).on('load', function() {
        var preLoder = $("#preloader");
        preLoder.fadeOut(1000);

    }); */


    /*-----------------------------------------
           global slick slicer control
       ------------------------------------------*/
    var globalSlickInit = $('.global-slick-init');

    if (globalSlickInit.length > 0) {
        //todo have to check slider item

        $.each(globalSlickInit, function (index, value) {

            if ($(this).children('div').length > 1) {
                //todo configure slider settings object
                var sliderSettings = {};
                var allData = $(this).data();


                var infinite = typeof allData.infinite == 'undefined' ? false : allData.infinite;
                var slidesToShow = typeof allData.slidestoshow == 'undefined' ? 1 : allData.slidestoshow;
                var slidesToScroll = typeof allData.slidestoscroll == 'undefined' ? 1 : allData.slidestoscroll;
                var speed = typeof allData.speed == 'undefined' ? '500' : allData.speed;
                var dots = typeof allData.dots == 'undefined' ? false : allData.dots;
                var cssEase = typeof allData.cssease == 'undefined' ? 'linear' : allData.cssease;

                var prevArrow = typeof allData.prevarrow == 'undefined' ? '' : allData.prevarrow;
                var nextArrow = typeof allData.nextarrow == 'undefined' ? '' : allData.nextarrow;
                var centerMode = typeof allData.centermode == 'undefined' ? false : allData.centermode;
                var centerPadding = typeof allData.centerpadding == 'undefined' ? false : allData.centerpadding;
                var rows = typeof allData.rows == 'undefined' ? 1 : parseInt(allData.rows);
                var autoplaySpeed = typeof allData.autoplayspeed == 'undefined' ? 2000 : parseInt(allData.autoplayspeed);
                var lazyLoad = typeof allData.lazyload == 'undefined' ? false : allData.lazyload; // have to remove it from settings object if it undefined
                var appendDots = typeof allData.appenddots == 'undefined' ? false : allData.appenddots;
                var appendArrows = typeof allData.appendarrows == 'undefined' ? false : allData.appendarrows;
                var asNavFor = typeof allData.asnavfor == 'undefined' ? false : allData.asnavfor;
                var fade = typeof allData.fade == 'undefined' ? false : allData.fade;
                var responsive = typeof $(this).data('responsive') == 'undefined' ? false : $(this).data('responsive');

                //slider settings object setup
                sliderSettings.infinite = infinite;
                sliderSettings.slidesToShow = slidesToShow;
                sliderSettings.slidesToScroll = slidesToScroll;
                sliderSettings.speed = speed;
                sliderSettings.dots = dots;
                sliderSettings.cssEase = cssEase;
                sliderSettings.prevArrow = prevArrow;
                sliderSettings.nextArrow = nextArrow;
                sliderSettings.rows = rows;
                sliderSettings.autoplaySpeed = autoplaySpeed;

                if (typeof centerMode != false) {
                    sliderSettings.centerMode = centerMode;
                }
                if (typeof centerPadding != false) {
                    sliderSettings.centerPadding = centerPadding;
                }
                if (typeof lazyLoad != false) {
                    sliderSettings.lazyLoad = lazyLoad;
                }
                if (typeof appendDots != false) {
                    sliderSettings.appendDots = appendDots;
                }
                if (typeof appendArrows != false) {
                    sliderSettings.appendArrows = appendArrows;
                }

                if (typeof asNavFor != false) {
                    sliderSettings.asNavFor = asNavFor;
                }
                if (typeof fade != false) {
                    sliderSettings.fade = fade;
                }
                if (typeof responsive != false) {
                    sliderSettings.responsive = responsive;
                }
                $(this).slick(sliderSettings);

            }
        });
    }



})(jQuery);