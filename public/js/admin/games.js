/**
 * Created by 9901623 on 21/10/2015.
 */
$(document).ready(function(){
    //$('#gamesList').DataTable();

    //remove admin account
    $(".enableDisable").click(function(){
        var index = $(this).data('index');
        var action = $(this).data('action');

        if (action == 'delete') {
            if (confirm("Are you sure you wish to delete this account you can not restore.") == false)
                    return  false;
        }
        $.ajax({
            type: "POST",
            url: "adminGames",
            data: {
                'index' : index,
                'action' : action
            },
            cache: false,
            success: function(){
               window.location.href = "games";
            }
        });
    });



});
console.log("public/js/admin/games.js loaded")