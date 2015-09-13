/**
 * Created by Luke Hardiman on 27/08/2015.
 * 
 */

"use strict";

//Globals
var game_grid,image_block_grid, word_block_grid, word_blocks,image_block;



//Handles images matching with words just an array
//This is just to build a game , below would actually come from a ajax call
var words = ['Rock', 'Paper', 'Scissor'];
var images = ['images/rock.png', 'images/paper.png', 'images/sissors.png'];

var game = [];


for (var i = 0; i < words.length; i++){

    var match = {
        image_block  : {
            src : images[i]
        },
        word_block  :  {
            text : words[i]
        }
    };
    game.push(match);
}

console.log("game",game);




console.log("app.js loaded");
//gameModule used between scripts app.js loaded first point
var gameModule = {
    debug : true,   //logout more console and skip some pages for testing
    screen : {
        height: null,   //current screen
        width: null
    },
    _score : 0,
    score :function(){
        this._score+= 50;
        this.setScore()
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
    },
    setScore : function(){
        //basic scorer for testing not actuall score
        $(".game_score").text(this._score);
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
    remove: function(image){
        console.log("removing block")
        $(image).hide();
        dropImage.top = dropImage.top + 200 - 1;//offset 1px so were not touching
        gameModule.score();
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
        image_block.attr('id','block_'+dropImage.count);



        console.log("app.js dropImage running");


        //setup our grid blocks append our hidden div elements
        $image_grid.append(image_block);
        //$game_grid.append($word_blocks);

        var desiredDrop = dropImage.position.get() - 50;     //desired position offset 50
        var speed   = 3 * 1000; //2 second move

        //see if we need to re-shuffe our game stack
        if (dropImage.count >= game.length){
            //reset count
            dropImage.count = 0;
            game = shuffle(game);
        }


        if (desiredDrop < image_block.height()){
            //can not drop any more blocks
            $("#game_grid").hide();
            $("#game_over").show();
            console.log("app.js can not drop any more blocks");
            return false;
        }

        //get this block we want to show
        var thisBlock = game[dropImage.count];

        image_block.attr('match_id',thisBlock.id);

        $('img',image_block)
            .attr('src',thisBlock.image_block.src)
            .css({
                'width'  : image_block.width(),
                'height' : image_block.height()
            });
        console.log("app.js dropImage rand",game);

        //lets just display where our image is for testing
        image_block.show();
        image_block.css('background-color' , 'black');//jst so i can see where its rendering lol

        image_block.droppable({
            over: function(event, ui) {
                console.log('You are over item with id ' + this.id);
                console.log('match_id ' + $(this).attr('match_id'));
                console.log('Dragged: ' + $(ui.draggable).attr("id"));

                if ($(this).attr('match_id') == $(ui.draggable).attr("id")){
                    dropImage.remove(this);
                }

            }
        });

        //drop the image
        image_block.animate({top:  desiredDrop

        },speed,function () {
            //disable droppable
            image_block.droppable('disable');

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
     game_grid           =  $("#game_grid");
     image_block_grid    =  $('#image_block_grid');
     word_block_grid     = $('#word_block_grid');
     word_blocks         =  $('#word_blocks');
     image_block         =  $("#image_block");   //clone this element

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
        'height': gameModule.renderHeight(80) + 'px'
        //'border': '1px'
    });


    //lets render our image word block
    word_blocks.css({
        'width': '100px',
        'height':'50px',
        'border': '1px',
        'margin':'10px 5px 15px 25px'
    });


    //setup our image_block image
    image_block.css({
        'height':'100px',
        'width': gameModule.scaleWidth(80,game_grid) + 'px',
        'border': '1px',
        'position': 'absolute'
    });


    console.log("app.js finished game setup");

    createWords();
    //lets drop an image div down
    dropImage.drop();
//    dropImage.drop();
});

/**
 * Adds the words into the word grid from a game array
 */
function createWords(){
    //loops our game array and adds the words into space
    //append our word block to our word block grid
    $.each(game,function(i,gm){
        //clone a word block
        var word_block = word_blocks.clone();
        //create random id
        var random_id = guidGenerator();
        game[i].id = random_id;
        //console.log("gm",gm);
        word_block.attr('id',random_id);

        //for word_block puposes
        word_block.css('background-color' , 'green');//jst so i can see where its rendering lol
        word_block.show();
        word_block.text(gm.word_block.text)
        //word_block.draggable();


        word_block.draggable({
            revert: true
        });

        word_block_grid.append(word_block);
    });

    console.log("game normal",game);
    game = shuffle(game);
    console.log("game randomized",game);
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

/**
 * Create a random GUID for matching id and drop image
 */
function guidGenerator() {
    var S4 = function() {
        return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}
/**
 * Shuffles Array
 * @param array
 * @returns {*} Shuffled Array
 */
function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex ;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

/**
 * Reloads/Refreshes our page
 */
function refreshPage() {

    return window.location.href = "index.html";
    //will fix this
    $.mobile.changePage(
        window.location.href = "index.html",
        {
            allowSamePageTransition : true,
            transition              : 'none',
            showLoadMsg             : false,
            reloadPage              : true
        }
    );
}