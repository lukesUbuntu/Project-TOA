<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 23/09/2015
 * Time: 5:45 PM
 */
include('getUserInfo.php');
$gameScore = 100;
$livesRemaining = 3;
$totalFeathersEarned = 0;
$roundNumber = 0;
$incorrectGuesses = 0;
$lettersGuessed = "";
$wordBeingGuessed = "";
$gameProgress = "no";
$wordToDisplay = "";

$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");

$sql = "UPDATE in_progress SET `gameScore` = $gameScore, `livesRemaining` = $livesRemaining, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `incorrectGuesses` = $incorrectGuesses, `lettersGuessed` = '$lettersGuessed', `wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";

$result=mysqli_query($con,$sql);

mysqli_close($con);

?>