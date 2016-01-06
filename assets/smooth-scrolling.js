(function ($) {
    $(function(){

        /*
         | Don't enable for Mac as they already do it :)
         */
        if (navigator.appVersion.indexOf("Mac")===-1) {
            $("html").niceScroll({
                zindex: 10, 
                cursorwidth: 10, 
                railoffset: 140, 
                bouncescroll: true, 
                autohidemode: false
            });
        }

    });
}(jQuery));