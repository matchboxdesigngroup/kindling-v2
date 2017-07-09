jQuery((function($) {
    // See vendor/boostrap.js to enable/disable specific bootstrap JS plugins.
    require('./vendor/boostrap.js');

    /**
     * Document Ready
     */
    $(document).ready(function() {
        // Setup generic site helpers.
        require('./site.js').init();

        // Handles setup for Flexslider (see slider.js).
        require('./sliders.js').load();
    });
})(jQuery));
