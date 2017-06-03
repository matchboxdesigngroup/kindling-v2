let site = {};
let $ = window.jQuery;

/**
 * Removes odd empty paragraphs that can be added by wpautop.
 */
site.removeEmptyParagraphs = function() {
    $( 'p:empty' ).remove();
};

/**
 * Initializes FitVid  jQuery plugin.
 *
 * @example http://fitvidsjs.com/
 *
 * @return  {Void}
 */
site.initFitVids = function() {
    require('./vendor/jquery.fitvids.js');

    if ( typeof $.fn.fitVids === 'function' ) {
        $('.fitvid').fitVids();
    } // if()
};

/**
 * Scrolls the page to the top of the provided element
 *
 * @param  {object}          elem            The jQuery selector object to scroll to.
 * @param  {string}          [easing=linear] The easing used when scrolling.
 * @param  {(string|number)} [speed=1500]    The speed to scroll.
 * @param {number}           [offsetTop=10]  Offset above the top of the element to scroll to.
 */
site.scollTo = function( elem, easing, speed, offsetTop ) {
    speed     = ( typeof speed === 'undefined' ) ? 1500 : speed;
    easing    = ( typeof easing === 'undefined' ) ? 'linear' : easing;
    offsetTop = ( typeof offsetTop === 'undefined' ) ? 10 : offsetTop;

    let offset = elem.offset().top - offsetTop;
    $('html,body').animate( { scrollTop : offset }, speed, easing );
};

/**
 * Initializes the back to top button.
 */
site.initBackToTop = function() {
    let $pageTopLinkElem = $('.page-top-link');

    if ( $pageTopLinkElem.length === 0 ) {
        return;
    } // if()

    $pageTopLinkElem.click(function() {
        $(window.opera ? 'html' : 'html, body').stop(true, true).animate({ scrollTop : 0 }, 1500, 'easeInOutQuad');
        return false;
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() > 150){
            $pageTopLinkElem.stop(true, true).fadeIn(1000);
        } else {
            $pageTopLinkElem.stop(true, true).fadeOut(1000);
        }
    });
};

/**
 * Generic site helpers.
 */
site.init = function() {
    site.removeEmptyParagraphs();
    site.initFitVids();
    site.initBackToTop();
};

module.exports = site;
