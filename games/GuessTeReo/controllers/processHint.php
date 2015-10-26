<?php
header("Content-Type:text/xml");
include '../functions/noMacron.php';
include '../functions/getUser.php';
$objMacron = new noMacron();
include '../functions/quickConnect.php';
$gameScore += 5;

//create list of letters in word that aren't guessed, select random letter from list
$listOfApplicableHints = array();
foreach ($wordBeingGuessed as $letterInWord) {
    $letterInWord = $objMacron->removeMacron($letterInWord);
    if (!in_array($letterInWord, $listOfApplicableHints) && !in_array($letterInWord, $lettersGuessedArray)) {
        array_push($listOfApplicableHints, $letterInWord);
    }
}

//Chooses letter from array
$chosenLetter = $listOfApplicableHints[mt_rand(0, count($listOfApplicableHints) - 1)];
array_push($lettersGuessedArray, $chosenLetter);
$gameWin = true;
$wordToDisplay = "";
foreach ($wordBeingGuessed as $letterInWord) {
    $letterExists = false;
    foreach ($lettersGuessedArray as $letterGuessed) {
        if (strcasecmp($objMacron->removeMacron($letterInWord), $letterGuessed) == 0) {
            $wordToDisplay .= "{$letterInWord} ";
            $letterExists = true;
        }
    }
    if (!$letterExists) {
        $wordToDisplay .= "_ ";
        $gameWin = false;
    }
}

if (!$gameWin == false) {
    $gameProgress = 'won';
    $totalFeathersEarned++;
}

$lettersGuessedString = join($lettersGuessedArray);
$sql = "UPDATE game_session SET `gameScore` = $gameScore, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `lettersGuessed` = '$lettersGuessedString', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";
mysqli_query($con, $sql);
mysqli_close($con);
$success = true;

$json = json_encode(array(
    'success' => $success,
    'gameScore' => $gameScore,
    'lettersGuessed' => $lettersGuessedString,
    'wordToDisplay' => $wordToDisplay,
    'gameProgress' => $gameProgress,
    'lettersGuessedString' => $lettersGuessedString));
//set response to send back check for callback

echo isset($_GET['callback'])
    ? "{$_GET['callback']}($json)"
    : $json;
?>