/**
 * Created by Luke Hardiman on 27/08/2015.
 * 
 */

"use strict";

console.log("app.js loaded");
//gameModule used between scripts app.js loaded first point
var gameModule = {
    debug : true,   //logout more console and skip some pages for testing
    screen : {
        height: null,   //current screen
        width: null
    },
    renderHeight : function(pert){  //render a % of document height
        return (typeof pert != "undefined") ? this.screen.height * pert / 100 : this.screen.height;
    },
    renderWidth : function(pert){
        return (typeof pert != "undefined") ? this.screen.width * pert / 100 : this.screen.width;
    },
    scaleWidth : function(pert,element){//render a % of element with
        return (typeof pert != "undefined") ? $(element).width() * pert / 100 :  $(element).width();
    },
    isElement : function($element){ //checks if we have a valid jquery Object & element exists
        return (typeof $element != "undefined" && $element instanceof jQuery && $element.length);
    }

};

/**
 * Drops an div/image to bottom of game_grid but clones our image holder
 */
var dropImage = {
    maxImages: 6,       //max images to drop down
    currentImage : 0,   //current image index
    position : {
        top:null,
        set:function(){//takes element and sets top
            this.top = $("#game_grid").height()
        },
        get:function(){//gets the current drop point top
            if (this.top == null) this.set() ;
           return this.top;
        },
        dropped: function(image){
            //console.log("dropped",this)
            this.top = this.top - $(image).height() - 1;//offset 1px so were not touching
            dropImage.count++;
        }
    },
    count :0,
    drop: function(){
        //if we don't pass anything lets just grab the standard element locations
        var $image_block = (gameModule.isElement($image_block)) ? $image_block : $("#image_block");
        var $image_grid =  $("#game_grid #image_block_grid");
        //(gameModule.isElement($game_grid)) ? $game_grid :
        var $word_blocks = $("#word_blocks");

        //clone our image block div
        var image_block = $image_block.clone();
        //change id_name
        image_block.attr('id','block_'+dropImage.count)
        console.log("app.js dropImage running");


        //setup our grid blocks append our hidden div elements
        $image_grid.append(image_block);
        //$game_grid.append($word_blocks);

        var desiredDrop = dropImage.position.get() - 50     //desired position offset 50
        var speed   = 1 * 1000; //2 second move


        if (desiredDrop < image_block.height()){
            //can not drop any more blocks
            console.log("app.js can not drop any more blocks")
            return false;
        }

        //lets just display where our image is for testing
        image_block.show();
        image_block.css('background-color' , 'black');//jst so i can see where its rendering lol


        console.log("this.position.get()",dropImage.position.get());




        //var newPosition = windowHeight - (lineHeight - desiredBottom);

        //newPosition
        //console.log("$game_grid.height()",$game_grid.height());
        console.log("image.height",image_block.height())
        console.log("desiredDrop",desiredDrop);
        console.log("image_block.position()",image_block.position());
        //drop the image
        image_block.animate({top:  desiredDrop

        },speed,function () {
            dropImage.position.dropped(this);
            //we can now drop again
            setTimeout(dropImage.drop,0);
        });

    }
};









/**
 * On Splash Screen Load
 */
$(document).on('pageinit','#splash',function(){

    //just splash screen while int.
    if (!gameModule.debug)
    splashScreen();

    //lets passheight to our gamemodule
    gameModule.screen.height = $(window).height();   // returns height of browser viewport
    gameModule.screen.width = $(window).width();
    console.log("gameModule",gameModule);

    $('body').on('click', '#play_game', function() {
        $.mobile.changePage('start_game.html', {
            transition : "slide"
        });
        return false;
    });

    //while in debug lets just go straight to page for live editing
    if (gameModule.debug)
        $.mobile.changePage("start_game.html", "fade");
});
/**
 * On start_game load
 */
$(document).on('pageinit','#start_game',function(){
    //for name sake if we don't have our gameModule object throw us out.
    if (typeof gameModule == "undefined") throw new Error("gameModule not loaded in scope....");

    //adjust height of our game screen block div
    var game_grid           =  $("#game_grid");
    var image_block_grid    =  $('#image_block_grid');
    var word_block_grid     = $('#word_block_grid');
    var word_blocks         =  $('#word_blocks');
    var image_block         =  $("#image_block");   //clone this element
    //startup

    //lets render our game_grid
    game_grid.css({
        'height': gameModule.renderHeight(80) + 'px',
        'width': '100%',
        'border': '1px'
    });

    //lets redner our image block grid container
    image_block_grid.css({
        'width': gameModule.renderWidth(40) + 'px',
        'height': gameModule.renderHeight(80) + 'px',
        'border': '1px'
    });
    
    //lets render our word block grid container
    word_block_grid.css({
        'width': gameModule.renderWidth(40) + 'px',
        'height': gameModule.renderHeight(80) + 'px',
        'border': '1px'
    });



    //lets render our image word block
    word_blocks.css({
        //'width': gameModule.renderWidth(60) + 'px',
        'height': gameModule.renderHeight(80) + 'px',
        'border': '1px'
    });

    //setup our image_block image
    image_block.css({
        'height':'100px',
        'width': gameModule.scaleWidth(80,game_grid) + 'px',
        'border': '1px',
        'position': 'absolute'
    });
    game_grid.append(word_blocks);
    console.log("app.js finished game setup");


    //lets drop an image div down
    dropImage.drop();
//    dropImage.drop();
});

/**
 * Fake Loading Demo lol
 */
function splashScreen(){
    var x = ".";
    //on loading
    var loading = setInterval(function(){

        $('#loading').text(x);
        x =  (x.length > 4) ? "." : x + ".";

    },500);
    // the .on() method does require jQuery 1.7 + but this will allow you to have the contained code only run when the #splash page is initialized.
    setTimeout(function(){
        $.mobile.changePage("game.html", "fade");
    }, 4000);
}