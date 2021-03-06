<?php
/*
 *
 * This file is called every time the user enters a guess from the keyboard.
 * It takes the letter entered via jQuery, checks against the word being guessed in the database, and returns the string with underlines
 *
 */


include 'noMacron.php';
include 'getUserInfo.php';
$objMacron = new noMacron();

header ("Content-Type:text/xml");
$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
 //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$inputLetter = $_POST["letter"];



if($gameProgress == 'running'){

    $currentPage = '#game';
    $success =  true;
    //Check input against wordBeingGuessedArray, determines if letter is in word. If it isn't, +1 to incorrectGuesses. Add to lettersGuessedArray. Create string to be displayed on client

    //determines if guessed letter is in word
    //Removes macron
    $gameWin = true;
    if(!in_array($inputLetter, $lettersGuessedArray)){
        array_push($lettersGuessedArray, $inputLetter);
        if(!in_array($inputLetter, $wordBeingGuessed)){

        }
        $letterIsInWord = false;
        foreach ($wordBeingGuessed as $letterInWord) {
            if (strcasecmp($objMacron->removeMacron($letterInWord), $inputLetter) == 0) {
                $letterIsInWord = true;

            }
        }
        if($letterIsInWord) {
            $gameScore += 15;
        }else{
            $incorrectGuesses--;
        }
    }
    //Writes word plus missing letters to display on client screen
    $wordToDisplay = "";
    foreach($wordBeingGuessed as $letterInWord){
        $letterExists = false;
        foreach ($lettersGuessedArray as $letterGuessed) {
            if (strcasecmp($objMacron->removeMacron($letterInWord), $letterGuessed) == 0) {
                $wordToDisplay .= "{$letterInWord} ";
                $letterExists = true;
            }
        }
        if(!$letterExists){
            $wordToDisplay .= "_ ";
            $gameWin = false;
        }
    }

    if($gameWin == true){
        $gameProgress = 'won';
        $totalFeathersEarned++;
    }
    else if($incorrectGuesses <= 0){
        $gameProgress = 'lost';
        $livesRemaining--;
        if($livesRemaining <= 0){
            $gameProgress = 'gameover';
        }
    }

    $lettersGuessedString = join($lettersGuessedArray);
    $sql = "UPDATE in_progress SET `gameScore` = $gameScore, `livesRemaining` = $livesRemaining, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `incorrectGuesses` = $incorrectGuesses, `lettersGuessed` = '$lettersGuessedString', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";
    mysqli_query($con,$sql);


}else{
    $success = false;
}

mysqli_close($con);

$json = json_encode(array(
    'success' => $success,
    'gameScore' => $gameScore,
    'livesRemaining' => $livesRemaining,
    'incorrectGuesses' => $incorrectGuesses,
    'lettersGuessed' => $lettersGuessedString,
    'wordToDisplay' => $wordToDisplay,
    'gameProgress' => $gameProgress));

//set response to send back check for callback
echo isset($_GET['callback'])
    ? "{$_GET['callback']}($json)"
    : $json;


 ?>