<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 21/09/2015
 * Time: 3:29 PM
 */
function createUser($gameProgress){
    $id = 7;
    $con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
    $createUserSQL = "INSERT INTO in_progress (
     `userID`,
    `gameScore`,
    `livesRemaining`,
    `totalFeathersEarned`,
    `roundNumber`,
    `incorrectGuesses`,
    `lettersGuessed`,
    `wordBeingGuessed`,
    `gameProgress`
    ) VALUES (
    '$id', '0', '3', '0', '1', '7', '', '', '$gameProgress')";
    mysqli_query($con,$createUserSQL);
    mysqli_close($con);
}
