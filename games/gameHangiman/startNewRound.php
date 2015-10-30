<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 23/09/2015
 * Time: 12:38 PM
 */

/*
 * Clears the game in progress from the database, and starts a new round when called
 */
include('getUserInfo.php');

$roundNumber++;

$wordData = getWordDataFromDatabase();
$wordBeingGuessed = $wordData->mri_word;
$englishWord = $wordData->eng_word;
$wordDescription = $wordData->word_desc;

$incorrectGuesses = 7;
$lettersGuessed = "- ";
$gameProgress = "running";
$wordToDisplay = "";

$wordSpacesString = createBlankWordString($wordBeingGuessed);

$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$con -> set_charset("utf8");
$sql = "UPDATE in_progress SET  `livesRemaining` = $livesRemaining, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `incorrectGuesses` = $incorrectGuesses, `lettersGuessed` = '$lettersGuessed', `wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordSpacesString', `wordDescription` = '$wordDescription', `englishWord` = '$englishWord' WHERE `userID` = $id";

mysqli_query($con,$sql);
mysqli_close($con);

header ("Location: game.php");

function getWordDataFromDatabase(){
    $json = file_get_contents('http://toa-dev.devlab.ac.nz/api/words');
    $objWords = json_decode($json);
    $wordArray = $objWords->data;

    $wordData=$wordArray[array_rand($wordArray)];

    return $wordData;

}

function createBlankWordString($wordBeingGuessed){
    $stringToDisplay = "";;
    $wordLength = mb_strlen($wordBeingGuessed);
    $wordArray = preg_split('//u',$wordBeingGuessed, -1, PREG_SPLIT_NO_EMPTY);


    foreach ($wordArray as $letter) {
        switch($letter){
            case " ":
                $stringToDisplay .= "  ";
                break;
            case "-":
                $stringToDisplay .= "- ";
                break;
            default:
                $stringToDisplay.= "_ ";
        }
    }
    return $stringToDisplay;
}
?>