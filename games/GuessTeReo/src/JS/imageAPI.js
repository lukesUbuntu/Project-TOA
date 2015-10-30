var words = [];
var images = [];

function getImage(callback){
    //saveGameData?game_score=454545&prefix=tblocks
    $.getJSON('/api/words?img_src1&limit=4',function(response){

        if (response.success == true){
            //loop all images to the images array and match the images same index
            console.log("response.data",response.data);
            $.each(response.data,function(index,data){
                words.push(data.mri_word);
                images.push(data.img_src1);
            });
            if (typeof callback == "function")
                callback();

        }else{
            throw Error("Failed to retrieve images");
        }
    });
}

console.log("words",words);
console.log("images",images);
images = [];
words = [];


getImage(function(){
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
});