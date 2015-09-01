/**
 * Created by Luke Hardiman on 27/08/2015.
 */
console.log("app.js loaded")
$(document).on('pageinit','#splash',function(){
// the .on() method does require jQuery 1.7 + but this will allow you to have the contained code only run when the #splash page is initialized.
    setTimeout(function(){
        $.mobile.changePage("game.html", "fade");
    }, 4000);
});