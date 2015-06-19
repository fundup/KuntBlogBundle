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


//paralax effect on image
function updateBackground($el, speed) {

    var diff = $(window).scrollTop() - $el.offset().top;
    var yPos = -(diff * speed);

    var coords = '50% ' + yPos + 'px';

    $el.css({
        backgroundPosition: coords
    });
}

$(function() {
    FreelanceBlogBundle.eqHeight();

    $(".rotate").textrotator({
        animation: "flip", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
        separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
        speed: 2000 // How many milliseconds until the next word show.
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });


    //Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    });

    //START paralax on header
    var $el = $('header');
    $(window).scroll(function () {
        updateBackground($el, 0.3);
    });
    updateBackground($el, 0.3);
    //END paralax on header

});
