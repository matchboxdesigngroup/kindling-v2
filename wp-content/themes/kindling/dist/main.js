/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
/***/ (function(module, exports) {

eval("/** global SN_GLOBALS */\njQuery(function ($) {\n    var site = {};\n\n    // Globals defined in scripts.php\n    // ajaxurl = SN_GLOBALS.ajaxurl\n\n    /**\n     * Initialize FlexSliders here\n     *\n     * @example http://flexslider.woothemes.com/\n     *\n     * @return boolean false\n     */\n    // site.initFlexslider = function() {\n    //  if (typeof $.fn.flexslider !== 'function' ) {\n    //      return;\n    //  } // if()\n\n    //  var slider = $('.flexslider');\n\n    //  // Check if a slider exists\n    //  if ( slider.length === 0 ) {\n    //      return false;\n    //  }\n\n    //  return false;\n    // }; // site.initFlexslider()\n\n    /**\n     * Initializes FitVid  jQuery plugin.\n     *\n     * @example http://fitvidsjs.com/\n     *\n     * @return  {Void}\n     */\n    site.initFitVids = function () {\n        if (typeof $.fn.fitVids !== 'function') {\n            return;\n        } // if()\n\n        $('.fitvid').fitVids();\n    }; // site.initFitVids()\n\n    /**\n     * Adding selectric jQuery plugin.\n     *\n     * @example http://lcdsantos.github.io/jQuery-Selectric/\n     *\n     * @return  {void}\n     */\n    // site.selectricInit = function() {\n    //  if ( typeof $.fn.selectric !== 'function' ) {\n    //      return;\n    //  } // if()\n\n    //  var selectElem = $('select');\n    //  if ( selectElem.length === 0 ) {\n    //      return;\n    //  } // if()\n\n    //  selectElem.selectric();\n\n    //  if ( $('.selectricWrapper').length === 0 ) {\n    //      selectElem.addClass('selectric-disabled');\n    //      $('form').addClass('selectric-disabled-form');\n    //  } // if()\n    // }; // site.selectricInit()\n\n    /**\n     * Scrolls the page to the top of the provided element\n     *\n     * @param  {object}          elem            The jQuery selector object to scroll to.\n     * @param  {string}          [easing=linear] The easing used when scrolling.\n     * @param  {(string|number)} [speed=1500]    The speed to scroll.\n     * @param {number}           [offsetTop=10]  Offset above the top of the element to scroll to.\n     *\n     * @return boolean               false\n     */\n    site.scollTo = function (elem, easing, speed, offsetTop) {\n        speed = typeof speed === 'undefined' ? 1500 : speed;\n        easing = typeof easing === 'undefined' ? 'linear' : easing;\n        offsetTop = typeof offsetTop === 'undefined' ? 10 : offsetTop;\n\n        var offset = elem.offset().top - offsetTop;\n        $('html,body').animate({ scrollTop: offset }, speed, easing);\n\n        return false;\n    }; // site.scollTo()\n\n    /**\n     * Initializes the back to top button.\n     *\n     * @todo Possibly add parameters but we will see\n     *\n     * @return  {void}\n     */\n    site.initBackToTop = function () {\n        var pageTopLinkElem = $('.page-top-link');\n\n        if (pageTopLinkElem.length === 0) {\n            return;\n        } // if()\n\n        pageTopLinkElem.click(function () {\n            $(window.opera ? 'html' : 'html, body').stop(true, true).animate({ scrollTop: 0 }, 1500, 'easeInOutQuad');\n            return false;\n        });\n\n        $(window).scroll(function () {\n            if ($(window).scrollTop() > 150) {\n                pageTopLinkElem.stop(true, true).fadeIn(1000);\n            } else {\n                pageTopLinkElem.stop(true, true).fadeOut(1000);\n            }\n        });\n    }; // site.initBackToTop()\n\n    /**\n     * Document Ready\n     */\n    $(document).ready(function () {\n        $('p:empty').remove();\n\n        site.initFitVids();\n    });\n\n    /**\n     * Window Resize.\n     */\n    // $(window).resize(function() {\n    // });\n\n    /**\n     * Window Load\n     */\n    $(window).load(function () {\n        site.initBackToTop();\n    });\n}(jQuery));//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9hc3NldHMvc2NyaXB0cy9tYWluLmpzP2VmODciXSwic291cmNlc0NvbnRlbnQiOlsiLyoqIGdsb2JhbCBTTl9HTE9CQUxTICovXG5qUXVlcnkoKGZ1bmN0aW9uKCQpIHtcbiAgICB2YXIgc2l0ZSAgICA9IHt9O1xuXG4gICAgLy8gR2xvYmFscyBkZWZpbmVkIGluIHNjcmlwdHMucGhwXG4gICAgLy8gYWpheHVybCA9IFNOX0dMT0JBTFMuYWpheHVybFxuXG4gICAgLyoqXG4gICAgICogSW5pdGlhbGl6ZSBGbGV4U2xpZGVycyBoZXJlXG4gICAgICpcbiAgICAgKiBAZXhhbXBsZSBodHRwOi8vZmxleHNsaWRlci53b290aGVtZXMuY29tL1xuICAgICAqXG4gICAgICogQHJldHVybiBib29sZWFuIGZhbHNlXG4gICAgICovXG4gICAgLy8gc2l0ZS5pbml0RmxleHNsaWRlciA9IGZ1bmN0aW9uKCkge1xuICAgIC8vICBpZiAodHlwZW9mICQuZm4uZmxleHNsaWRlciAhPT0gJ2Z1bmN0aW9uJyApIHtcbiAgICAvLyAgICAgIHJldHVybjtcbiAgICAvLyAgfSAvLyBpZigpXG5cbiAgICAvLyAgdmFyIHNsaWRlciA9ICQoJy5mbGV4c2xpZGVyJyk7XG5cbiAgICAvLyAgLy8gQ2hlY2sgaWYgYSBzbGlkZXIgZXhpc3RzXG4gICAgLy8gIGlmICggc2xpZGVyLmxlbmd0aCA9PT0gMCApIHtcbiAgICAvLyAgICAgIHJldHVybiBmYWxzZTtcbiAgICAvLyAgfVxuXG4gICAgLy8gIHJldHVybiBmYWxzZTtcbiAgICAvLyB9OyAvLyBzaXRlLmluaXRGbGV4c2xpZGVyKClcblxuICAgIC8qKlxuICAgICAqIEluaXRpYWxpemVzIEZpdFZpZCAgalF1ZXJ5IHBsdWdpbi5cbiAgICAgKlxuICAgICAqIEBleGFtcGxlIGh0dHA6Ly9maXR2aWRzanMuY29tL1xuICAgICAqXG4gICAgICogQHJldHVybiAge1ZvaWR9XG4gICAgICovXG4gICAgc2l0ZS5pbml0Rml0VmlkcyA9IGZ1bmN0aW9uKCkge1xuICAgICAgICBpZiAoIHR5cGVvZiAkLmZuLmZpdFZpZHMgIT09ICdmdW5jdGlvbicgKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH0gLy8gaWYoKVxuXG4gICAgICAgICQoJy5maXR2aWQnKS5maXRWaWRzKCk7XG4gICAgfTsgLy8gc2l0ZS5pbml0Rml0VmlkcygpXG5cbiAgICAvKipcbiAgICAgKiBBZGRpbmcgc2VsZWN0cmljIGpRdWVyeSBwbHVnaW4uXG4gICAgICpcbiAgICAgKiBAZXhhbXBsZSBodHRwOi8vbGNkc2FudG9zLmdpdGh1Yi5pby9qUXVlcnktU2VsZWN0cmljL1xuICAgICAqXG4gICAgICogQHJldHVybiAge3ZvaWR9XG4gICAgICovXG4gICAgLy8gc2l0ZS5zZWxlY3RyaWNJbml0ID0gZnVuY3Rpb24oKSB7XG4gICAgLy8gIGlmICggdHlwZW9mICQuZm4uc2VsZWN0cmljICE9PSAnZnVuY3Rpb24nICkge1xuICAgIC8vICAgICAgcmV0dXJuO1xuICAgIC8vICB9IC8vIGlmKClcblxuICAgIC8vICB2YXIgc2VsZWN0RWxlbSA9ICQoJ3NlbGVjdCcpO1xuICAgIC8vICBpZiAoIHNlbGVjdEVsZW0ubGVuZ3RoID09PSAwICkge1xuICAgIC8vICAgICAgcmV0dXJuO1xuICAgIC8vICB9IC8vIGlmKClcblxuICAgIC8vICBzZWxlY3RFbGVtLnNlbGVjdHJpYygpO1xuXG4gICAgLy8gIGlmICggJCgnLnNlbGVjdHJpY1dyYXBwZXInKS5sZW5ndGggPT09IDAgKSB7XG4gICAgLy8gICAgICBzZWxlY3RFbGVtLmFkZENsYXNzKCdzZWxlY3RyaWMtZGlzYWJsZWQnKTtcbiAgICAvLyAgICAgICQoJ2Zvcm0nKS5hZGRDbGFzcygnc2VsZWN0cmljLWRpc2FibGVkLWZvcm0nKTtcbiAgICAvLyAgfSAvLyBpZigpXG4gICAgLy8gfTsgLy8gc2l0ZS5zZWxlY3RyaWNJbml0KClcblxuICAgIC8qKlxuICAgICAqIFNjcm9sbHMgdGhlIHBhZ2UgdG8gdGhlIHRvcCBvZiB0aGUgcHJvdmlkZWQgZWxlbWVudFxuICAgICAqXG4gICAgICogQHBhcmFtICB7b2JqZWN0fSAgICAgICAgICBlbGVtICAgICAgICAgICAgVGhlIGpRdWVyeSBzZWxlY3RvciBvYmplY3QgdG8gc2Nyb2xsIHRvLlxuICAgICAqIEBwYXJhbSAge3N0cmluZ30gICAgICAgICAgW2Vhc2luZz1saW5lYXJdIFRoZSBlYXNpbmcgdXNlZCB3aGVuIHNjcm9sbGluZy5cbiAgICAgKiBAcGFyYW0gIHsoc3RyaW5nfG51bWJlcil9IFtzcGVlZD0xNTAwXSAgICBUaGUgc3BlZWQgdG8gc2Nyb2xsLlxuICAgICAqIEBwYXJhbSB7bnVtYmVyfSAgICAgICAgICAgW29mZnNldFRvcD0xMF0gIE9mZnNldCBhYm92ZSB0aGUgdG9wIG9mIHRoZSBlbGVtZW50IHRvIHNjcm9sbCB0by5cbiAgICAgKlxuICAgICAqIEByZXR1cm4gYm9vbGVhbiAgICAgICAgICAgICAgIGZhbHNlXG4gICAgICovXG4gICAgc2l0ZS5zY29sbFRvID0gZnVuY3Rpb24oIGVsZW0sIGVhc2luZywgc3BlZWQsIG9mZnNldFRvcCApIHtcbiAgICAgICAgc3BlZWQgICAgID0gKCB0eXBlb2Ygc3BlZWQgPT09ICd1bmRlZmluZWQnICkgPyAxNTAwIDogc3BlZWQ7XG4gICAgICAgIGVhc2luZyAgICA9ICggdHlwZW9mIGVhc2luZyA9PT0gJ3VuZGVmaW5lZCcgKSA/ICdsaW5lYXInIDogZWFzaW5nO1xuICAgICAgICBvZmZzZXRUb3AgPSAoIHR5cGVvZiBvZmZzZXRUb3AgPT09ICd1bmRlZmluZWQnICkgPyAxMCA6IG9mZnNldFRvcDtcblxuICAgICAgICB2YXIgb2Zmc2V0ID0gZWxlbS5vZmZzZXQoKS50b3AgLSBvZmZzZXRUb3A7XG4gICAgICAgICQoJ2h0bWwsYm9keScpLmFuaW1hdGUoIHsgc2Nyb2xsVG9wIDogb2Zmc2V0IH0sIHNwZWVkLCBlYXNpbmcgKTtcblxuICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgfTsgLy8gc2l0ZS5zY29sbFRvKClcblxuICAgIC8qKlxuICAgICAqIEluaXRpYWxpemVzIHRoZSBiYWNrIHRvIHRvcCBidXR0b24uXG4gICAgICpcbiAgICAgKiBAdG9kbyBQb3NzaWJseSBhZGQgcGFyYW1ldGVycyBidXQgd2Ugd2lsbCBzZWVcbiAgICAgKlxuICAgICAqIEByZXR1cm4gIHt2b2lkfVxuICAgICAqL1xuICAgIHNpdGUuaW5pdEJhY2tUb1RvcCA9IGZ1bmN0aW9uKCkge1xuICAgICAgICB2YXIgcGFnZVRvcExpbmtFbGVtID0gJCgnLnBhZ2UtdG9wLWxpbmsnKTtcblxuICAgICAgICBpZiAoIHBhZ2VUb3BMaW5rRWxlbS5sZW5ndGggPT09IDAgKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH0gLy8gaWYoKVxuXG4gICAgICAgIHBhZ2VUb3BMaW5rRWxlbS5jbGljayhmdW5jdGlvbigpIHtcbiAgICAgICAgICAgICQod2luZG93Lm9wZXJhID8gJ2h0bWwnIDogJ2h0bWwsIGJvZHknKS5zdG9wKHRydWUsIHRydWUpLmFuaW1hdGUoeyBzY3JvbGxUb3AgOiAwIH0sIDE1MDAsICdlYXNlSW5PdXRRdWFkJyk7XG4gICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICBpZiAoJCh3aW5kb3cpLnNjcm9sbFRvcCgpID4gMTUwKXtcbiAgICAgICAgICAgICAgICBwYWdlVG9wTGlua0VsZW0uc3RvcCh0cnVlLCB0cnVlKS5mYWRlSW4oMTAwMCk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgIHBhZ2VUb3BMaW5rRWxlbS5zdG9wKHRydWUsIHRydWUpLmZhZGVPdXQoMTAwMCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH07IC8vIHNpdGUuaW5pdEJhY2tUb1RvcCgpXG5cbiAgICAvKipcbiAgICAgKiBEb2N1bWVudCBSZWFkeVxuICAgICAqL1xuICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgICAgICAkKCAncDplbXB0eScgKS5yZW1vdmUoKTtcblxuICAgICAgICBzaXRlLmluaXRGaXRWaWRzKCk7XG4gICAgfSk7XG5cbiAgICAvKipcbiAgICAgKiBXaW5kb3cgUmVzaXplLlxuICAgICAqL1xuICAgIC8vICQod2luZG93KS5yZXNpemUoZnVuY3Rpb24oKSB7XG4gICAgLy8gfSk7XG5cbiAgICAvKipcbiAgICAgKiBXaW5kb3cgTG9hZFxuICAgICAqL1xuICAgICQod2luZG93KS5sb2FkKGZ1bmN0aW9uKCkge1xuICAgICAgICBzaXRlLmluaXRCYWNrVG9Ub3AoKTtcbiAgICB9KTtcbn0pKGpRdWVyeSkpO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIGFzc2V0cy9zY3JpcHRzL21haW4uanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7QUFPQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7OztBQU9BO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7OztBQU9BO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7O0FBVUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7O0FBT0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTs7O0FBR0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }),

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ })

/******/ });