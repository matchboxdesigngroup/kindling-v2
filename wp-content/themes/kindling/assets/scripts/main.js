jQuery((function($) {
    require('./vendor/boostrap.js');
    var site    = {};

    /**
     * Initialize FlexSliders here
     *
     * @example http://flexslider.woothemes.com/
     *
     * @return boolean false
     */
    // site.initFlexslider = function() {
    //     require('./../../node_modules/flexslider/jquery.flexslider.js');
    //     if (typeof $.fn.flexslider !== 'function' ) {
    //         return;
    //     } // if()

    //     var slider = $('.flexslider');

    //     // Check if a slider exists
    //     if ( slider.length === 0 ) {
    //         return false;
    //     }

    //     return false;
    // }; // site.initFlexslider()

    /**
     * Initializes FitVid  jQuery plugin.
     *
     * @example http://fitvidsjs.com/
     *
     * @return  {Void}
     */
    site.initFitVids = function() {
        if ( typeof $.fn.fitVids !== 'function' ) {
            return;
        } // if()

        $('.fitvid').fitVids();
    }; // site.initFitVids()

    /**
     * Scrolls the page to the top of the provided element
     *
     * @param  {object}          elem            The jQuery selector object to scroll to.
     * @param  {string}          [easing=linear] The easing used when scrolling.
     * @param  {(string|number)} [speed=1500]    The speed to scroll.
     * @param {number}           [offsetTop=10]  Offset above the top of the element to scroll to.
     *
     * @return boolean               false
     */
    site.scollTo = function( elem, easing, speed, offsetTop ) {
        speed     = ( typeof speed === 'undefined' ) ? 1500 : speed;
        easing    = ( typeof easing === 'undefined' ) ? 'linear' : easing;
        offsetTop = ( typeof offsetTop === 'undefined' ) ? 10 : offsetTop;

        var offset = elem.offset().top - offsetTop;
        $('html,body').animate( { scrollTop : offset }, speed, easing );

        return false;
    }; // site.scollTo()

    /**
     * Initializes the back to top button.
     *
     * @todo Possibly add parameters but we will see
     *
     * @return  {void}
     */
    site.initBackToTop = function() {
        var pageTopLinkElem = $('.page-top-link');

        if ( pageTopLinkElem.length === 0 ) {
            return;
        } // if()

        pageTopLinkElem.click(function() {
            $(window.opera ? 'html' : 'html, body').stop(true, true).animate({ scrollTop : 0 }, 1500, 'easeInOutQuad');
            return false;
        });

        $(window).scroll(function() {
            if ($(window).scrollTop() > 150){
                pageTopLinkElem.stop(true, true).fadeIn(1000);
            } else {
                pageTopLinkElem.stop(true, true).fadeOut(1000);
            }
        });
    }; // site.initBackToTop()

    /**
     * Document Ready
     */
    $(document).ready(function() {
        $( 'p:empty' ).remove();

        site.initFitVids();
    });

    /**
     * Window Resize.
     */
    // $(window).resize(function() {
    // });

    /**
     * Window Load
     */
    $(window).load(function() {
        site.initBackToTop();
        // site.initFlexslider();
    });
})(jQuery));
