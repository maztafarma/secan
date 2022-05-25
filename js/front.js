$(function () {

    // ================================================
    //  NAVBAR BEHAVIOR
    // ================================================
    $(window).on('scroll load', function () {

        if ($(window).scrollTop() > 5) {
            $('.navbar').addClass('fixed-top');
        } else {
            $('.navbar').removeClass('fixed-top')
        }
    });

    // ================================================
    // Scroll Spy
    // ================================================
    // $('body').scrollspy({
    //     target: '#navbarSupportedContent',
    //     offset: 80
    // });

});
