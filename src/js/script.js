var $buoop = {required:{e:-4,f:-3,o:-3,s:-1,c:-3},insecure:true,api:2018.05 }; 
function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.min.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)};

(function($){
    var pswp;
    var itemSources;
    var items = [];

    $(document).ready(function () {
        pswp = $('.pswp')[0];

        itemSources = $('article:not(.excerpt) a > img');

        // Preload images
        $(itemSources).each(function () {
            var img = new Image();
            img.src = $(this).parent().attr('href');
        });

        $(window).on('load', function () {
            // Apply items on load
            $(itemSources).each(function () {
                var img = new Image();
                img.src = $(this).parent().attr('href');

                var item = {
                    src: img.src,
                    w: img.width,
                    h: img.height
                };

                items.push(item);
            });

            // Init gallery
            itemSources.on('click', function (e) {
                e.preventDefault();
                var gallery = new PhotoSwipe(pswp, PhotoSwipeUI_Default, items, {
                    index: itemSources.index(this)
                });
                gallery.init();
            });

            if (window.location.hash) {
                $('a[href="' + window.location.hash +'"]').tab('show');
            }

            var scrollTo = null;

            $('a[href^="' + location.protocol+'\/\/'+location.host+location.pathname + '"]').on('click', function (e) {
                var hash = $(this).attr('href').split('#')[1];

                if (!hash) {
                    return;
                }

                var id = '#' + hash;

                if ($('a[href="' + id + '"]').length === 0) {
                    return;
                }

                e.preventDefault();
                $('a[href="' + id + '"]').tab('show');

                if (scrollTo) {
                    clearTimeout(scrollTo);
                }

                scrollTo = setTimeout(function () {
                    $("html, body").stop().animate({
                        scrollTop: $(id).offset().top - 10
                    }, 400);    
                }, 400);
            });

            $('[data-toggle="tooltip"]').tooltip();

            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 100) {
                    $('.back-to-top').show('slow');
                } else {
                    $('.back-to-top').hide('slow');
                }
            });

            $('.back-to-top').click(function () {
                $("html, body").stop().animate({
                    scrollTop: 0
                }, 400);
            });

            $(window).scroll();
        });
    });
})(jQuery);
