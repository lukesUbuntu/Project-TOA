/**
 * Created by 9901623 on 21/10/2015.
 */
$(document).ready(function(){
    var editDetails = null; //global

    $('#wordLists').DataTable();
    //words modal
    var editWordModal = $("#editWord");

    //bind our buttons
    $(editWordModal).on('show.bs.modal', function(e) {
        //grab the details and render into the modal
        editDetails = $WordsList[$(e.relatedTarget).data('record_id')];

        //inputs should match :) which they allowed us to use angularJS
        $.each(editDetails,function(key, value){
            $('#' + key,editWordModal).val(value);
        });
        console.log('editDetails',editDetails)

    });

    //detroy modal
    $('#close',editWordModal).click(function(e){
        console.log('closing killing editDetails');
        editDetails = null;
        return e.preventDefault();
    });

    //save our entry details and update server
    $('#save',editWordModal).click(function(e){

        //grab all the input fields from our modal
        var entry = $('.entry',editWordModal);

        //lets update editDetails object with new entry details
        $.each(entry,function(key, value){
            editDetails[$(value).attr('id')] = $(value).val()
        });

        console.log("editDetails",editDetails);
        //lets post to server and update

        return e.preventDefault();
    });
});

//bind our edit functions to edit modal
