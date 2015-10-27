/**
 * Created by Luke Hardiman on 21/10/2015.
 */

$(document).ready(function(){
    var editDetails = null; //global

    $('#wordLists').DataTable();
    //words modal
    var editWordModal = $("#editWord");
    var deleteModal = $("#deleteModal");
    var action = null;

    $(deleteModal).on('show.bs.modal', parseWordData);
    //bind our buttons
    $(editWordModal).on('show.bs.modal', parseWordData);

    //detroy modal
    $('#close',editWordModal).click(function(e){

        console.log('closing killing editDetails');
        editDetails = null;
        clearInputs()
        return e.preventDefault();
    });
    //save our entry details and update server
    $('#delete',deleteModal).click(function(e) {
        console.log("deleteDetails",editDetails);
        $.post( "wordsDelete",{word : editDetails}, function( data ) {
            //didn't complete so we are just reloading page :(
            window.location.href = "words";
            //clear all inputs so fresh input fields
        });

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
        $.post( "wordsUpdate",{word : editDetails}, function( data ) {
            //didn't complete so we are just reloading page :(
            window.location.href = "words";
            //clear all inputs so fresh input fields
            $.each(editDetails,function(key, value){
                $('#' + key,editWordModal).val('');
            });
            $(editWordModal).modal('toggle');
        });
        return e.preventDefault();
    });


    function clearInputs(){
        var inputs = $(':input,textarea',editWordModal);
        //inputs should match :) which they allowed us to use angularJS
        $.each(inputs,function(key, element){
            $(element).val('');
        });
    }

    function parseWordData(e){
        action = $(e.relatedTarget).data('action');

        //check we are not adding
        if (action != "add"){
            editDetails = $WordsList.get($(e.relatedTarget).data('record_id'));

            //inputs should match :) which they allowed us to use angularJS
            $.each(editDetails,function(key, value){
                $('#' + key,editWordModal).val(value);
            });
            console.log('editDetails',editDetails)
        }

        if (action == "delete"){
            $('#mri_word',deleteModal).text(editDetails.mri_word);
        }
    }

});


console.log("loaded words.js");