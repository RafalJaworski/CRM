$(document).ready(function () {
    $('#menu-content > li').on('click',function () {
        var thisel = $(this);
        $('#menu-content > li').removeClass('active');
        thisel.addClass('active');
    });

    $('.alert').fadeOut(3000);
});