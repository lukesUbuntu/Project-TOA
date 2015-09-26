<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 23/09/2015
 * Time: 12:38 PM
 */
include('getUserInfo.php');

$roundNumber++;
$wordBeingGuessed = "Māori";
$incorrectGuesses = 7;
$lettersGuessed = "";
$gameProgress = "running";
$wordToDisplay = "";
$wordBeingGuessedLength = mb_strlen($wordBeingGuessed);

for($i=1; $i<=$wordBeingGuessedLength; $i++){
    $wordToDisplay .= "_ ";
}
$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$con -> set_charset("utf8");
$sql = "UPDATE in_progress SET  `livesRemaining` = $livesRemaining, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `incorrectGuesses` = $incorrectGuesses, `lettersGuessed` = '$lettersGuessed', `wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";

mysqli_query($con,$sql);
mysqli_close($con);

header ("Location: game.php");
?>
