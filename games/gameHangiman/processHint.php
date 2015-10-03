<?php
header ("Content-Type:text/xml");
include 'noMacron.php';
include 'getUserInfo.php';
$objMacron = new noMacron();

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
    $lettersGuessedArray = preg_split('//u',$row[6], -1, PREG_SPLIT_NO_EMPTY); //ensures Maori characters are properly encoded within string
    $wordBeingGuessed = preg_split('//u',$row[7], -1, PREG_SPLIT_NO_EMPTY); //ensures Maori characters are properly encoded within string
    $gameProgress = $row[8];
}*/

$gameScore += 5;
$currentPage = '#game';

//create list of letters in word that aren't guessed, select random letter from list
$listOfApplicableHints = array();
foreach($wordBeingGuessed as $letterInWord) {
    $letterInWord = $objMacron->removeMacron($letterInWord);
    if(!in_array($letterInWord, $listOfApplicableHints) && !in_array($letterInWord, $lettersGuessedArray)){
        array_push($listOfApplicableHints, $letterInWord);
    }
}

//Chooses letter from array
$chosenLetter = $listOfApplicableHints[mt_rand(0, count($listOfApplicableHints)-1)];
array_push($lettersGuessedArray, $chosenLetter);
$gameWin = true;
$wordToDisplay = "";
foreach($wordBeingGuessed as $letterInWord) {
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

if(!$gameWin == false){
    $gameProgress = 'won';
    $totalFeathersEarned++;
}




$lettersGuessedString = join($lettersGuessedArray);


$sql = "UPDATE in_progress SET `gameScore` = $gameScore, `livesRemaining` = $livesRemaining, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `lettersGuessed` = '$lettersGuessedString', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordToDisplay' WHERE `userID` = $id";
mysqli_query($con,$sql);

mysqli_close($con);

$success =  true;

$json = json_encode(array(
    'success' => $success,
    'gameScore' => $gameScore,
    'livesRemaining' => $livesRemaining,
    'lettersGuessed' => $lettersGuessedString,
    'wordToDisplay' => $wordToDisplay,
    'gameProgress' => $gameProgress,
    'lettersGuessedString' => $lettersGuessedString));
//set response to send back check for callback

echo isset($_GET['callback'])
    ? "{$_GET['callback']}($json)"
    : $json;

 ?>