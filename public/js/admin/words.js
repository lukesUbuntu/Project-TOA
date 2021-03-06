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

        var entry = $('.entry');
        //var editDetails = [];
        if (action == "add")
            editDetails = {};

        //lets update editDetails object with new entry details
        $.each(entry,function(key, value){
            var thisEntry  = $(value);

            try{
                editDetails[thisEntry.attr('id')] = thisEntry.val();
            }catch(e){
                console.log("attr",thisEntry.attr('id'));
                //console.log("value",thisEntry.val());
            }

        });


        if (action == "add"){
            console.log("editDetails ->",editDetails)
            //didn't complete so we are just reloading page :(
            $.ajax({
                type: "POST",
                url: "wordsAdd",
                data: {
                    'word' : editDetails
                },
                cache: false,
                success: function(){
                    $(editWordModal).modal('toggle');
                    window.location.href = "words";
                }
            });


            return e.preventDefault();
        }

        //grab all the input fields from our modal

        $.ajax({
            type: "POST",
            url: "wordsUpdate",
            data: {
                'word' : editDetails
            },
            cache: false,
            success: function(){
                $(editWordModal).modal('toggle');
            }
        });
        /*
        //lets post to server and update
        $.post( "wordsUpdate",{ 'word' : editDetails}, function( data ) {
            //didn't complete so we are just reloading page :(
            //window.location.href = "words";
            //clear all inputs so fresh input fields
            $.each(editDetails,function(key, value){
                $('#' + key,editWordModal).val('');
            });
            $(editWordModal).modal('toggle');
        });*/
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





        //lets update the fileForm of the record index we are using
        //check we are not adding
        if (action != "add"){
            editDetails = $WordsList.get($(e.relatedTarget).data('record_id'));

            //inputs should match :) which they allowed us to use angularJS
            $.each(editDetails,function(key, value){
                $('#' + key,editWordModal).val(value);
            });
            console.log('editDetails',editDetails)

            $("#img_src #index").val(editDetails.index);
            $("#img_src #img_src1").attr('src',editDetails.img_src1);
            $("#img_src #img_src2").attr('src',editDetails.img_src2);
            $("#img_src").show();
        }
        if (action == "delete"){
            console.log("editDetails",editDetails)
            $('#mri_word',deleteModal).text(editDetails.mri_word);
        }
        if (action == "add")
            $("#img_src").hide();


    }

    //attach to img





});
$(function () {
    var ul = $("#fileList");
    $('.img_src_upload').fileupload({

        // This function is called when a file is added to the queue ignore below i was trying to do some fancy uploading but ran out of time.
        add: function (e, data) {
            //This area will contain file list and progress information. ignore below was trying to do fancy but will skip github.com/lukesubuntu
            /*
            var tpl = $('<li class="working">'+
                '<span class="fileupload" value="0" data-width="48" data-height="48" data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" />'+
                '% <span class="fileName"></span></li>' );

            // Append the file name and file size
            tpl.find('.fileName').text(data.files[0].name)
                .append('<i> ' + formatFileSize(data.files[0].size) + ' </i>');



            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);



            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){
                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }
                tpl.fadeOut(function(){
                    tpl.remove();
                });
            });
            */
            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },
        progress: function(e, data){

            //// Calculate the completion percentage of the upload
            //var progress = parseInt(data.loaded / data.total * 100, 10);
            //
            //// Update the hidden input field and trigger a change
            //// so that the jQuery knob plugin knows to update the dial
            //data.context.find('.fileupload').text(progress).change();
            //
            //if(progress == 100){
            //    data.context.removeClass('working');
            //   // $(this).remove();
            //}
        },
        done: function (e, data) {
            var response = data.result.data;
            if (typeof response.tag  == "string")
                $("#img_src #"+ response.tag).attr('src',response.url);
            else
                console.log("failed",response);
            //

        }
    });
    //Helper function for calculation of progress
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
        return (bytes / 1000).toFixed(2) + ' KB';
    }
});


console.log("loaded words.js");