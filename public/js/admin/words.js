/**
 * Created by 9901623 on 21/10/2015.
 */
$(document).ready(function(){
    //bb
    $('#wordLists').DataTable();

    //words modal
    var editWord = $("#editWord");

    //bind our buttons
    $(editWord).on('show.bs.modal', function(e) {
        var editDetails = $(e.relatedTarget).data('record');
        console.log('editDetails',editDetails)
        $(this).find('.danger').click(function(e){
            console.log('closing');
        });
    });

});

//bind our edit functions to edit modal
