<?php
include 'noMacron.php';
include 'getUserInfo.php';
$objMacron = new noMacron();

header ("Content-Type:text/xml");
$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
 //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//check Login, get ID
/*$id = $_POST["id"];

$con -> set_charset("utf8");
$sql = "SELECT * FROM in_progress WHERE userID = $id";

if ($result=mysqli_query($con,$sql)){
 $row = mysqli_fetch_row($result);
    $gameScore = $row[1];
    $livesRemaining = $row[2];
    $totalFeathersEarned = $row[3];
    $roundNumber = $row[4];
    $incorrectGuesses = $row[5];
    $lettersGuessedArray = preg_split('//u',$row[6], -1, PREG_SPLIT_NO_EMPTY); //ensures Maori characters are properly encoded within string
    $wordBeingGuessed = preg_split('//u',$row[7], -1, PREG_SPLIT_NO_EMPTY); //ensures Maori characters are properly encoded within string
    $gameProgress = $row[8];
}*/

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
				$gameScore += 10;
            }
        }
        if(!$letterIsInWord){
            $incorrectGuesses--;
			$gameScore -= 10;
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