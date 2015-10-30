/**
 * Created by 9901623 on 21/10/2015.
 */
$(document).ready(function(){
    $('#usersLists').DataTable();

    //remove admin account
    $(".adminAction").click(function(){
        var index = $(this).data('index');
        var action = $(this).attr('id');

        if (action == 'delete') {
            if (confirm("Are you sure you wish to delete this account you can not restore.") == false)
                    return  false;
        }
        $.ajax({
            type: "POST",
            url: "usersAdmin",
            data: {
                'index' : index,
                'action' : action
            },
            cache: false,
            success: function(){
               window.location.href = "users";
            }
        });
    });



});
console.log("public/js/admin/users.js loaded")