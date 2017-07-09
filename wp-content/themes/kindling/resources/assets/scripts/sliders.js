require('./../../../node_modules/flexslider/jquery.flexslider.js');

let sliders = {};
let $ = window.jQuery;

/**
 * Get the sliders.
 * Add slider selectors and options below.
 *
 * @return {Array}
 */
sliders.get = function() {
    return [
        // Replace and duplicate object to add new sliders.
        {
            selector: '.flexslider',
            options: {
                animation: 'slide',
            },
        },
    ];
};

/**
 * Loads FlexSliders here
 *
 * @example http://flexslider.woothemes.com/
 *
 * @return boolean false
 */
sliders.load = function() {
    if (!sliders.flexsliderExists()) {
        return;
    }

    $.each(sliders.get(), function(index, slider) {
        let $slider = $(slider.selector);
        if (sliders.exist($slider)) {
            $slider.flexslider(slider.options);
        }
    });
};

/**
 * Checks if Flexslider exists.
 *
 * @return {Boolean}
 */
sliders.flexsliderExists = function() {
    return (typeof $.fn.flexslider === 'function');
};

/**
 * Checks if the slider exists.
 *
 * @param  {Object} $slider
 *
 * @return {Boolean}
 */
sliders.exist = function($slider) {
    return ($slider.length !== 0);
};

module.exports = sliders;
