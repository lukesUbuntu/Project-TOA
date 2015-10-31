//API that is to add/remove scores amd feathers
function addFeathers(feathersEarned){
    var xhr = new XMLHttpRequest();
    var apiUrlFiveFeathers = "http://toa-dev.devlab.ac.nz/api/addFeather?amount=5";
    var apiUrlCustomNumber = "http://toa-dev.devlab.ac.nz/api/addFeather?amount=";
    var feathersGroupsOfFive = 0;

    while(feathersEarned >= 5){
        feathersGroupsOfFive++;
        feathersEarned -= 5;
    }
    while(feathersGroupsOfFive > 0){
        xhr = new XMLHttpRequest();
        xhr.open("POST", apiUrlFiveFeathers, true);
        xhr.send();
        console.log(xhr.statusText);
        feathersGroupsOfFive--;
    }
    if(feathersEarned > 0){
        xhr = new XMLHttpRequest();
        apiUrlCustomNumber += feathersEarned;
        xhr.open("POST", apiUrlCustomNumber, true);
        xhr.send();
    }
    return true;
}
function getFeathers(callback){
    var feathers = 0;
    $.ajax({
        type:"POST",
        url:"/api/getFeathers",
        dataType: "jsonp",
        success: function(response){
            feathers = response.data.feathers;

            if (typeof callback == "function")
                callback(feathers)
        },
        failure: function(){
            alert("Failed to contact server, please try again or refresh the page");
        }
    });
    return feathers;
}
function removeFeathers(numberOfFeathers) {
    var success;
    $.ajax({
        type: "POST",
        url: "/api/removeFeather?amount=" + numberOfFeathers,
        dataType: "jsonp",
        success: function(){
            success = true;
        },
        failure: function () {
            success = false;
        }
    });
}
function addScore($gameScore){
    $.ajax({
        type: "POST",
        url: "/api/saveGameData?game_score=" + $gameScore,
        dataType: "jsonp",
        success: function(response){
            console.log( response);
        },
        failure: function (response) {
            console.log( response);
        }
    });
}
function getCurrentScore() {
    $.ajax({
        type: "POST",
        url: "/api/usersGames" + $gameScore,
        dataType: "jsonp",
        success: function (response) {
            console.log(response);
        },
        failure: function (response) {
            console.log(response);
        }
    });
}