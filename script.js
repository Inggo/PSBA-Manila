!function(t){var e={};function o(n){if(e[n])return e[n].exports;var r=e[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}o.m=t,o.c=e,o.d=function(t,e,n){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},o.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,e){if(1&e&&(t=o(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)o.d(n,r,function(e){return t[e]}.bind(null,r));return n},o.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="/",o(o.s=3)}([,,,function(t,e,o){o(4),t.exports=o(7)},function(t,e){function o(){var t=document.createElement("script");t.src="//browser-update.org/update.min.js",document.body.appendChild(t)}try{document.addEventListener("DOMContentLoaded",o,!1)}catch(t){window.attachEvent("onload",o)}!function(t){var e,o,n=[];t(document).ready(function(){e=t(".pswp")[0],t('a[href$=".pdf"] > img').each(function(){t(this).parent().addClass("disable-ps")}),o=t("article:not(.excerpt) a:not(.disable-ps) > img"),t(o).each(function(){(new Image).src=t(this).parent().attr("href")}),t(window).on("load",function(){t(o).each(function(){var e=new Image,o=t(this).parent().attr("href");e.src=o;var r={src:o,w:e.width,h:e.height};t(this).parent().next().is("figcaption")&&(r.title=t(this).parent().next().text()),n.push(r)}),o.on("click",function(t){t.preventDefault(),new PhotoSwipe(e,PhotoSwipeUI_Default,n,{index:o.index(this)}).init()}),window.location.hash&&t('a[href="'+window.location.hash+'"]').tab("show");var r=null;t('a[href^="'+location.protocol+"//"+location.host+location.pathname+'"]').on("click",function(e){var o=t(this).attr("href").split("#")[1];if(o){var n="#"+o;0!==t('a[href="'+n+'"]').length&&(e.preventDefault(),t('a[href="'+n+'"]').tab("show"),r&&clearTimeout(r),r=setTimeout(function(){t("html, body").stop().animate({scrollTop:t(n).offset().top-10},400)},400))}}),t('[data-toggle="tooltip"]').tooltip(),t(window).on("scroll",function(){t(window).scrollTop()>100?t(".back-to-top").show("slow"):t(".back-to-top").hide("slow")}),t(".back-to-top").click(function(){t("html, body").stop().animate({scrollTop:0},400)}),t(window).scroll()})})}(jQuery)},,,function(t,e){}]);