(function($) {
    "use strict";

    /* ITENS DO TOPO */
    var header = $('.sticky-bar');
    var win = $(window);
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass('stick');
        } else {
            header.addClass('stick');
        }
    });
    $('#mobile-menu-active').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: ".mobile-menu-area .mobile-menu",
    });
    $('.search-content').css('display','none');
    $(".search-active").on("click", function(e) {
        e.preventDefault();
        $(this).parent().find('.search-content').slideToggle('medium');
    });

    /* SLIDESHOW PRINCIPAL */
    $('.slider-active').owlCarousel({
        loop: true,
        nav: true,
        autoplay: false,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        autoplayTimeout: 5000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        item: 1,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    /* CARROSSEL PARCEIROS */
    $('.partners-active').owlCarousel({
        loop: true,
        nav: false,
        autoplay: true,
        autoplayTimeout: 5000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        item: 6,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items:3
            },
            992: {
                items: 4
            },
            1200: {
                items: 6
            }
        }
    })

    /* SCROLLUP */
    $.scrollUp({
        scrollText: '<i class="fas fa-sort-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /* CONTADOR REGRESSIVO */
    $('[data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown day">%-D <p>Dias</p></span> <span class="cdown hour">%-H <p>Horas</p></span> <span class="cdown minutes">%M <p>Minutos</p></span class="cdown second"> <span>%S <p>Segundos</p></span>'));
        });
    });

    /* TV AMIC */
    $("#tv-amic .list-group-item").click(function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $("#tv-amic .list-group-item").removeClass('active');
        $(this).addClass('active');
        $("#video-tv").attr("src", 'https://www.youtube.com/embed/'+url);
    })

    new WOW().init();
})(jQuery);