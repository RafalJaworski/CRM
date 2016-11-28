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



    /*======     USER FORM      ======*/
    var companyUsers = function (thisEl) {
        if(thisEl.val() !=''){
            $.ajax({
                method: 'POST',
                url : thisEl.data('ajax-users'),
                data : {'companyId':thisEl.val()},
                success: function(response) {
                    var usersSelect =  $('#ticket_users');
                    usersSelect.removeAttr('disabled');

                    usersSelect.children().remove();
                    $.each(response.users,function (key,value) {
                        var $opt = $('<option/>');
                        $opt.val(value.id);
                        $opt.text(value.firstName);

                        usersSelect.append($opt);
                    });
                }
            });
        }else {
            $('#ticket_users').children().remove();
            $('#ticket_users').attr('disabled', true);
        }
    };
    // after choosing company
    $('#ticket_companies').on('change', function () {
        companyUsers($(this));
    });
    /*======     END OF USER FORM      ======*/
    
    
    /*======     LIST      ======*/
        $('.list-link').on('click',function (e){
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).data('ajax-entity'),
                success: function (data) {
                    $('.show-container').show();
                    $('.show-container').html(data.content);
                  

                }
            });
        });
    /*======     END OF LIST      ======*/
    
    
    
});