/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 154);
/******/ })
/************************************************************************/
/******/ ({

/***/ 154:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(155);
module.exports = __webpack_require__(156);


/***/ }),

/***/ 155:
/***/ (function(module, exports) {

var $buoop = { required: { e: -4, f: -3, o: -3, s: -1, c: -3 }, insecure: true, api: 2018.05 };
function $buo_f() {
    var e = document.createElement("script");
    e.src = "//browser-update.org/update.min.js";
    document.body.appendChild(e);
};
try {
    document.addEventListener("DOMContentLoaded", $buo_f, false);
} catch (e) {
    window.attachEvent("onload", $buo_f);
};

// Photoswipe

(function ($) {
    var pswp;
    var itemSources;
    var items = [];

    function getImageSize(img, callback) {
        var $img = $(img);

        var wait = setInterval(function () {
            var w = $img[0].naturalWidth,
                h = $img[0].naturalHeight;
            if (w && h) {
                clearInterval(wait);
                callback.apply(this, [w, h]);
            }
        }, 30);
    }

    $(document).ready(function () {
        pswp = $('.pswp')[0];

        // Find all a > img
        var aImg = $('a[href$=".pdf"] > img');

        aImg.each(function () {
            $(this).parent().addClass('disable-ps');
        });

        itemSources = $('article:not(.excerpt) a:not(.disable-ps) > img');

        // Preload images
        $(itemSources).each(function () {
            var img = new Image();
            img.src = $(this).parent().attr('href');
        });

        $(window).on('load', function () {
            // Apply items on load
            $(itemSources).each(function () {
                var img = new Image();
                var imgsrc = $(this).parent().attr('href');
                img.src = imgsrc;

                var item = {
                    src: imgsrc,
                    w: img.width,
                    h: img.height
                };

                // Apply figcaption if present
                if ($(this).parent().next().is('figcaption')) {
                    item.title = $(this).parent().next().text();
                }

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
                $('a[href="' + window.location.hash + '"]').tab('show');
            }

            var scrollTo = null;

            // Initial active page
            $('a[href^="' + location.protocol + '\/\/' + location.host + location.pathname + '"]').on('click', function (e) {
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

/***/ }),

/***/ 156:
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

/******/ });