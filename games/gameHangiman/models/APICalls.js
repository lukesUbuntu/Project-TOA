/**
 * Created by 21300082 on 2/10/2015.
 */
function addFeathers(feathersEarned){
alert("function call success");
    var xhr = new XMLHttpRequest();
    var apiUrlFiveFeathers = "http://toa-dev.devlab.ac.nz/api/addFeather?amount=5";
    var apiUrlCustomNumber = "http://toa-dev.devlab.ac.nz/api/addFeather?amount=";
    var feathersGroupsOfFive = 0;

    while(feathersEarned > 5){
        feathersGroupsOfFive++;
        feathersEarned -= 5;
    }
    while(feathersGroupsOfFive > 0){
        xhr.open("POST", apiUrlFiveFeathers, true);
        xhr.send();
        console.log(xhr.statusText);
        feathersGroupsOfFive--;
    }
    if(feathersEarned > 0){
        apiUrlCustomNumber += feathersEarned;
        xhr.open("POST", apiUrlCustomNumber, true);
        xhr.send();
    }
    return true;
}

function removeFeathers(numberOfFeathers){
    alert("function call success");
    var xhr = new XMLHttpRequest();
    var apiUrlFiveFeathers = "http://toa-dev.devlab.ac.nz/api/removeFeather?amount=5";
    var apiUrlCustomNumber = "http://toa-dev.devlab.ac.nz/api/removeFeather?amount=";
    var feathersGroupsOfFive = 0;

    while(feathersEarned > 5){
        feathersGroupsOfFive++;
        feathersEarned -= 5;
    }
    while(feathersGroupsOfFive > 0){
        xhr.open("POST", apiUrlFiveFeathers, true);
        xhr.send();
        console.log(xhr.statusText);
        feathersGroupsOfFive--;
    }
    if(feathersEarned > 0) {
        apiUrlCustomNumber += feathersEarned;
        xhr.open("POST", apiUrlCustomNumber, true);
        xhr.send();
    }
}