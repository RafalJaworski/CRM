$(document).ready(function () {
    /*======     MENU      ======*/
    $('#menu-content > li').on('click',function () {
        var thisel = $(this);
        $('#menu-content > li').removeClass('active');
        thisel.addClass('active');
    });
    /*======     END OF MENU      ======*/

    /*======     GENERAL      ======*/
    $('.alert').fadeOut(3000);
    /*======     END OF GENERAL      ======*/
});