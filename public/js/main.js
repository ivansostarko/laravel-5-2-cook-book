$(document).ready(function(){

    //Init functions
    LazyLoad();
    ProgressBar();
    scrollToTop();


    //Lazy Load
    function LazyLoad() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    }

    //Top progress bar
    function ProgressBar() {
        //Start loader
        NProgress.start();
        $(window).load(function () {
            NProgress.done();
        });
    }

    //Scroll to Top
    function scrollToTop() {
        $(function () {
            $('#goTop').goTop();
        });
    }

});