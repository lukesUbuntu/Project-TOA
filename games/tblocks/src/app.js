/**
 * Created by Luke Hardiman on 27/08/2015.
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
    position : null,
    count : function(){
        return
    },
    drop: function($image_block,$game_grid){//can define image_block or game_grid
        //if we don't pass anything lets just grab the standard element locations
        $image_block = (gameModule.isElement($image_block)) ? $image_block : $("#image_block");
        $game_grid = (gameModule.isElement($game_grid)) ? $game_grid : $("#game_grid");

        //clone our image block div
        var image_block = $image_block.clone();
        console.log("app.js dropImage running");

        //if we don't have a current position
        if (dropImage.position == null);
        dropImage.position = image_block.position();

        //setup our grid blocks append our hidden div elements
        $game_grid.append(image_block);
        $game_grid.append(word_blocks);

        //lets just display where our image is for testing
        image_block.show();
        image_block.css('background-color' , 'black');//jst so i can see where its rendering lol

        //drop image test
        var windowHeight = $(window).height();
        var lineHeight = $game_grid.height();

        console.log("this.position()",dropImage.position)

        var desiredBottom = dropImage.position.top + 20;     //desired position offset 20
        var speed   = 2 * 1000; //2 second move

        var newPosition = windowHeight - (lineHeight - desiredBottom);
        //newPosition
        console.log("newPosition",newPosition);
        console.log("desiredBottom",desiredBottom);
        console.log("image_block.position()",image_block.position());
        //desiredBottom

        image_block.animate({top:$game_grid.height()},speed,function () {
            image_block.css({
                bottom: desiredBottom,
                top: 'auto'
            });
            dropImage.position = image_block.position();
            console.log("image_block.position()",image_block.position())
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
    var game_grid       =  $("#game_grid");
    var image_blocks    =  $('#image_block_grid');
    var word_blocks     =  $('#word_blocks');
    var image_block     =  $("#image_block");   //clone this element
    //startup

    //lets render our game_grid
    game_grid.css({
        'height': gameModule.renderHeight(80) + 'px',
        'width': '100%',
        'border': '1px'
    });
    //lets redner our image block
    image_blocks.css({
        'width': gameModule.renderWidth(60) + 'px',
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

    console.log("app.js finished game setup");

    //startup end
    /*
     element.style {
     display: block;
     margin: 0 auto;
     border: 1px;
     height: 200px;
     width: 200px;
     }
     */
    //dropImage(image_block,game_grid);
    dropImage.drop();
//    dropImage.drop();
});
/**
 * Drops an div/image to bottom of game_grid but clones our image holder
 */
function dropImage($image_block,$game_grid){
    //if we don't pass anything lets just grab the standard element locations
    $image_block = (gameModule.isElement($image_block)) ? $image_block : $("#image_block");
    $game_grid = (gameModule.isElement($game_grid)) ? $game_grid : $("#game_grid");

    //clone our image block div
    var image_block = $image_block.clone();
    console.log("app.js dropImage running")
    //setup our grid blocks append our hidden div elements
    $game_grid.append(image_block);
    $game_grid.append(word_blocks);

    //lets just display where our image is for testing
    image_block.show();
    image_block.css('background-color' , 'black');//jst so i can see where its rendering lol

    //drop image test
    var windowHeight = $(window).height();
    var lineHeight = $game_grid.height();
    var desiredBottom = 20;     //desired ending
    var speed   = 2 * 1000; //2 second move

    var newPosition = windowHeight - (lineHeight - desiredBottom);
    //newPosition
    console.log("newPosition",newPosition);
    console.log("desiredBottom",desiredBottom);
    console.log("image_block.position()",image_block.position());
    //desiredBottom

    image_block.animate({top:$game_grid.height()},speed,function () {
        image_block.css({
            bottom: desiredBottom,
            top: 'auto'
        });

        console.log("image_block.position()",image_block.position())
    });

}
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