$(document).ready(function () {

    $("#owl-demo").owlCarousel({
        items: 4,
        loop: true,
        autoplay: true,
        autoplayTimeout: 10000,
        autoplaySpeed: 1000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            769: {
                items: 2,
                nav: true
            },
            1100: {
                items: 3,
                nav: true
            },
            1376: {
                items: 4,
                nav: true
            }
        },
        nav: true,
        navText: ["", ""],
        afterMove: function (elem) {
            var current = this.currentItem;
            var currentImg = elem.find('.owl-item').eq(current).find('img');

            $('figure')
                .find('img')
                .attr({
                    'src': currentImg.attr('src'),
                    'alt': currentImg.attr('alt'),
                    'title': currentImg.attr('title')
                });
            $('#figcaption').text(currentImg.attr('title'));
        }
    });

    $(window).on("load", function () {
        $(window).scroll(function () {
            var windowBottom = $(this).scrollTop() + $(this).innerHeight();
            $(".lazyload").each(function () {
                var objectBottom = $(this).offset().top + $(this).outerHeight();
                if (objectBottom < windowBottom) {
                    if ($(this).css("opacity") === 0) {
                        $(this).fadeTo(600, 1);
                    }
                } else {
                    if ($(this).css("opacity") === 1) {
                        $(this).fadeTo(600, 0);
                    }
                }
            });
        }).scroll();
    });

    $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function () {
        $(this).toggleClass('open');
    });
    $('#myCarousel').carousel({
        interval: 2500,
        cycle: true
    });

    var els = document.querySelectorAll('i.remove'),
        el;
    for (var i = 0; i < els.length; i++) {
        el = els[i];
        if ($(window).width() < 990) {
            el.parentNode.removeChild(el)
        }
    }

    var $modal = $(".modal-transparent");
    var $modalBackdrop = $(".modal-backdrop");

    $modal.on('show.bs.modal', function () {
        setTimeout(function () {
            $modalBackdrop.addClass("modal-backdrop-transparent");
        }, 0);
    });
    $modal.on('hidden.bs.modal', function () {
        $modalBackdrop.addClass("modal-backdrop-transparent");
    });

    $modal.on('show.bs.modal', function () {
        setTimeout(function () {
            $modalBackdrop.addClass("modal-backdrop-fullscreen");
        }, 0);
    });
    $modal.on('hidden.bs.modal', function () {
        $modalBackdrop.addClass("modal-backdrop-fullscreen");
    });

    $('.anchor').click(function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name="' + this.hash.slice(1) + '"]');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 1000
                }, 1000);
                return false;
            }
        }
    });

    $('.carousel-inner').each(function () {
        if ($(this).children('div').length < 2) $(this).siblings('.carousel-control, .carousel-indicators').hide();
    });

    $(".numbers-only").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $("section.producers").myCollapse({
        visible_producers: 1,
        animation_speed: 300,
        items_per_click: 1
    });

    $("#remove-hidden-floors").click(function () {
        $("div.floors").toggleClass("hidden");
        $("#remove-hidden-floors").toggleClass("selected-choice");
        $(".modal-body .doors a").toggleClass("hidden");
    });

    $(".show-doors").click(function () {
        $("div.doors").toggleClass("hidden");
        $("#remove-hidden-doors").toggleClass("selected-choice-2");
        $(this).toggleClass("hidden");
    });

    $("#remove-hidden-doors").click(function () {
        $("div.doors").toggleClass("hidden");
        $("#remove-hidden-doors").toggleClass("selected-choice-2");
        $(".modal-body .floors a").toggleClass("hidden");
    });

    $(".show-floors").click(function () {
        $("div.floors").toggleClass("hidden");
        $("#remove-hidden-floors").toggleClass("selected-choice");
        $(this).toggleClass("hidden");
    });

    $("section.category .lightSlider").lightSlider({
        item: 1,
        speed: 600,
        loop: true,
        auto: true,
        slideMargin: 0,
        pause: 3000,
        pauseOnHover: true,
        onSliderLoad: function () {
            $('.lightSlider').removeClass('cS-hidden');
        }
    });

    $("section.sec-navbar .lightSlider").lightSlider({
        speed: 600,
        slideMargin: 0,
        pager: false,
        autoWidth: true
    });

    $(".category:not(:last-of-type) hr").addClass("myhrline");
    $(".category:last-of-type hr").addClass("myhrline2");

    $.validate({
        modules: 'location, date, security, file',
        onModulesLoaded: function () {
            $('#country').suggestCountry();
        }
    });

    // Create a lightbox
    (function () {
        var $lightbox = $("<div class='lightbox'></div>");
        var $img = $("<img>");
        // Add image and caption to lightbox

        $lightbox
            .append($img);

        // Add lighbox to document

        $('body').append($lightbox);

        $('.lightbox-gallery img').click(function (e) {
            e.preventDefault();

            // Get image link and description
            var src = $(this).attr("src");

            // Add data to lighbox

            $img.attr('src', src);

            // Show lightbox

            $lightbox.fadeIn('fast');

            $lightbox.click(function () {
                $lightbox.fadeOut('fast');
            });
        });

    }());

});


(function ($) {
    $.fn.myCollapse = function (options) {

        var settings = $.extend({ //
            visibleProducers: 1,   //
            animationSpeed: 400,  // Settings
            itemsPerClick: 1   //
        }, options);

        var $myClass = $(this).find('.producer'); // nájde všetkých producerov
        var $obj = $(this);

        var items = function ($duration, $test, $type) {  //funkcia na slide objektov podľa indexu
            $test.each(function (index) {
                if ($type === 'myClass') {
                    if (index > settings.visibleProducers - 1) {
                        $(this).slideToggle($duration);
                    }
                }
                if ($type === 'myHidden') {
                    if (index < settings.itemsPerClick) {
                        $(this).slideToggle($duration);
                    }
                }
            });
        };

        items(0, $myClass, 'myClass'); // volanie prvej funkcie

        var $myHidden = $obj.find('.producer').filter(":hidden");  // Nájde počet skrytých producerov ešte pred kliknutím
        $(".left-to-show").html($myHidden.length);                // zobrazuje počet producerov ešte pred kliknutím

        $(this).find('a[role="button"]').on("click", function () {  // funkcia na klik
            items(settings.animationSpeed, $myHidden, 'myHidden'); // volanie prvej funkcie pri kliku
            $myHidden = $obj.find('.producer').filter(":hidden");
            var length = $myHidden.length;
            if (length === 0) {     // ak je index 0, napíš niečo
                $('a[role="button"]').text('Všetky zobrazené');
            } else { // inak vypisuj koľko ešte objektov zostáva na zobrazenie
                $(".left-to-show").html(length);
            }
        });
        return this;
    };
})(jQuery);



