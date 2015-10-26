<?php
include('../functions/getUser.php');
$gameScore = "";
$totalFeathersEarned = 0;
$roundNumber = 0;
$lettersGuessed = "";
$wordBeingGuessed = "";
$gameProgress = "no";
$wordToDisplay = "";

$con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
$sql = "UPDATE game_session SET `gameScore` = $gameScore, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `lettersGuessed` = '$lettersGuessed', `wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";
$result = mysqli_query($con, $sql);
mysqli_close($con);

?>