var FreelanceBlogBundle = FreelanceBlogBundle || {};

FreelanceBlogBundle = (function($, window, undefined) {

    var eqHeight;
    eqHeight = function() {
        var maxHeight = 0;
        $('.eq-height').each(function() {
            var currentHeight = $(this).outerHeight();
            if(currentHeight >= maxHeight) {
                maxHeight = currentHeight;
            }
        });
        $('.eq-height').css('min-height', maxHeight);
    };



    return {
        eqHeight: eqHeight
    };

}(jQuery, window));

$(function() {
    FreelanceBlogBundle.eqHeight();

    $(".rotate").textrotator({
        animation: "flip", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
        separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
        speed: 2000 // How many milliseconds until the next word show.
    });

    //paralax
    $('.header-content').parallax("center", 0.3);
});
