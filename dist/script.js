!function(e){var n={};function o(t){if(n[t])return n[t].exports;var a=n[t]={i:t,l:!1,exports:{}};return e[t].call(a.exports,a,a.exports,o),a.l=!0,a.exports}o.m=e,o.c=n,o.d=function(e,n,t){o.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:t})},o.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(n,"a",n),n},o.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},o.p="/",o(o.s=0)}([function(e,n,o){o(1),e.exports=o(2)},function(e,n){function o(){var e=document.createElement("script");e.src="//browser-update.org/update.min.js",document.body.appendChild(e)}try{document.addEventListener("DOMContentLoaded",o,!1)}catch(e){window.attachEvent("onload",o)}!function(e){var n,o,t=[];e(document).ready(function(){n=e(".pswp")[0],e('a[href$=".pdf"] > img').each(function(){e(this).parent().addClass("disable-ps")}),o=e("article:not(.excerpt) a:not(.disable-ps) > img"),e(o).each(function(){(new Image).src=e(this).parent().attr("href")}),e(window).on("load",function(){e(o).each(function(){var n=new Image,o=e(this).parent().attr("href");n.src=o;var a={src:o,w:n.width,h:n.height};e(this).parent().next().is("figcaption")&&(a.title=e(this).parent().next().text()),t.push(a)}),o.on("click",function(e){e.preventDefault(),new PhotoSwipe(n,PhotoSwipeUI_Default,t,{index:o.index(this)}).init()}),window.location.hash&&e('a[href="'+window.location.hash+'"]').tab("show");var a=null;e('a[href^="'+location.protocol+"//"+location.host+location.pathname+'"]').on("click",function(n){var o=e(this).attr("href").split("#")[1];if(o){var t="#"+o;0!==e('a[href="'+t+'"]').length&&(n.preventDefault(),e('a[href="'+t+'"]').tab("show"),a&&clearTimeout(a),a=setTimeout(function(){e("html, body").stop().animate({scrollTop:e(t).offset().top-10},400)},400))}}),e('[data-toggle="tooltip"]').tooltip(),e(window).on("scroll",function(){e(window).scrollTop()>100?e(".back-to-top").show("slow"):e(".back-to-top").hide("slow")}),e(".back-to-top").click(function(){e("html, body").stop().animate({scrollTop:0},400)}),e(window).scroll()})})}(jQuery)},function(e,n){throw new Error("Module build failed: ModuleBuildError: Module build failed: Error: Node Sass does not yet support your current environment: Linux 64-bit with Unsupported runtime (67)\nFor more information on which environments are supported please see:\nhttps://github.com/sass/node-sass/releases/tag/v4.9.3\n    at module.exports (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/node-sass/lib/binding.js:13:13)\n    at Object.<anonymous> (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/node-sass/lib/index.js:14:35)\n    at Module._compile (internal/modules/cjs/loader.js:738:30)\n    at Object.Module._extensions..js (internal/modules/cjs/loader.js:749:10)\n    at Module.load (internal/modules/cjs/loader.js:630:32)\n    at tryModuleLoad (internal/modules/cjs/loader.js:570:12)\n    at Function.Module._load (internal/modules/cjs/loader.js:562:3)\n    at Module.require (internal/modules/cjs/loader.js:667:17)\n    at require (internal/modules/cjs/helpers.js:20:18)\n    at Object.<anonymous> (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/sass-loader/lib/loader.js:3:14)\n    at Module._compile (internal/modules/cjs/loader.js:738:30)\n    at Object.Module._extensions..js (internal/modules/cjs/loader.js:749:10)\n    at Module.load (internal/modules/cjs/loader.js:630:32)\n    at tryModuleLoad (internal/modules/cjs/loader.js:570:12)\n    at Function.Module._load (internal/modules/cjs/loader.js:562:3)\n    at Module.require (internal/modules/cjs/loader.js:667:17)\n    at require (internal/modules/cjs/helpers.js:20:18)\n    at loadLoader (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/loadLoader.js:13:17)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:165:10)\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:173:18\n    at loadLoader (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/loadLoader.js:36:3)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:165:10)\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:173:18\n    at loadLoader (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/loadLoader.js:36:3)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at runLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:362:2)\n    at NormalModule.doBuild (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModule.js:182:3)\n    at NormalModule.build (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModule.js:275:15)\n    at runLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModule.js:195:19)\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:364:11\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:170:18\n    at loadLoader (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/loadLoader.js:27:11)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:165:10)\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:173:18\n    at loadLoader (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/loadLoader.js:36:3)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:165:10)\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:173:18\n    at loadLoader (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/loadLoader.js:36:3)\n    at iteratePitchingLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at runLoaders (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/loader-runner/lib/LoaderRunner.js:362:2)\n    at NormalModule.doBuild (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModule.js:182:3)\n    at NormalModule.build (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModule.js:275:15)\n    at Compilation.buildModule (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/Compilation.js:157:10)\n    at moduleFactory.create (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/Compilation.js:460:10)\n    at factory (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModuleFactory.js:243:5)\n    at applyPluginsAsyncWaterfall (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModuleFactory.js:94:13)\n    at /mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/tapable/lib/Tapable.js:268:11\n    at NormalModuleFactory.params.normalModuleFactory.plugin (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/CompatibilityPlugin.js:52:5)\n    at NormalModuleFactory.applyPluginsAsyncWaterfall (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/tapable/lib/Tapable.js:272:13)\n    at resolver (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModuleFactory.js:69:10)\n    at process.nextTick (/mnt/d/Sites/wordpress/wp-content/themes/psba-manila/node_modules/webpack/lib/NormalModuleFactory.js:196:7)\n    at processTicksAndRejections (internal/process/next_tick.js:74:9)")}]);