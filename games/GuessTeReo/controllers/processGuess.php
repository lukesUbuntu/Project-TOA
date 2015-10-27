<?php
include '../functions/noMacron.php';
include '../functions/getUser.php';
$objMacron = new noMacron();

header("Content-Type:text/xml");
$con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$inputLetter = $_POST["letter"];

if ($gameProgress == 'active') {
    $currentPage = '#game';
    $success = true;
    //Check input against wordBeingGuessedArray, determines if letter is in word. If it isn't, +1 to incorrectGuesses. Add to lettersGuessedArray. Create string to be displayed on client

    //determines if guessed letter is in word
    //Removes macron
    $gameWin = true;
    if (!in_array($inputLetter, $lettersGuessedArray)) {
        array_push($lettersGuessedArray, $inputLetter);
        if (!in_array($inputLetter, $wordBeingGuessed)) {

        }
        $letterIsInWord = false;
        foreach ($wordBeingGuessed as $letterInWord) {
            if (strcasecmp($objMacron->removeMacron($letterInWord), $inputLetter) == 0) {
                $letterIsInWord = true;
            }
        }
        if ($letterIsInWord) {
            $gameScore += 15;
        } else {
            $gameScore -= 1;
        }
    }
    //Writes word plus missing letters to display on client screen
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

    if ($gameWin == true) {
        $gameProgress = 'won';
        $totalFeathersEarned++;
    }

    $lettersGuessedString = join($lettersGuessedArray);
    $sql = "UPDATE game_session SET `gameScore` = $gameScore, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `lettersGuessed` = '$lettersGuessedString', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";
    mysqli_query($con, $sql);

} else {
    $success = false;
}

mysqli_close($con);

$json = json_encode(array(
    'success' => $success,
    'gameScore' => $gameScore,
    'lettersGuessed' => $lettersGuessedString,
    'wordToDisplay' => $wordToDisplay,
    'gameProgress' => $gameProgress));

//set response to send back check for callback
echo isset($_GET['callback'])
    ? "{$_GET['callback']}($json)"
    : $json;
?>