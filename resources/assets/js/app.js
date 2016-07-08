    jQuery(document).ready(function ($) {
        //Start loader
        NProgress.start();
        $(window).load(function () {
            NProgress.done();
        });
    });