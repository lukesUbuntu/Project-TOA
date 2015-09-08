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
        width: null,
    },
    renderHeight : function(pert){  //render a %
        return this.screen.height * pert / 100
    },
    renderWidth : function(pert){
        return this.screen.width * pert / 100
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
    console.log("gameModule",gameModule)

    $('body').on('click', '#play_game', function(ev) {
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
    //for name sake
    if (typeof gameModule == "undefined") throw new Error("gameModule not loaded in scope....");
    //adjust height of our game screen block div
    var game_grid = $("#game_grid");
    //lets render our game_grid for images
    game_grid.css({
        'height': gameModule.renderHeight(60) + 'px',
        'width': gameModule.renderWidth(60) + 'px',
        'border': '1px'
    })

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

    },500)
    // the .on() method does require jQuery 1.7 + but this will allow you to have the contained code only run when the #splash page is initialized.
    setTimeout(function(){
        $.mobile.changePage("game.html", "fade");
    }, 4000);
}