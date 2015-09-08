/**
 * Created by Luke Hardiman on 27/08/2015.
 */
console.log("app.js loaded");
//gameModule used between scripts app.js loaded first point
var gameModule = {
    screen : {
        height: null,
        width: null,
    }
};

$(document).on('pageinit','#splash',function(){
    //just splash screen while int.
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