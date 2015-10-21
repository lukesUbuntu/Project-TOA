<?php
include('getUserInfo.php');

$roundNumber++;
$wordBeingGuessed = getWordFromDatabase();
$lettersGuessed = "- ";
$gameProgress = "active";
$wordToDisplay = "";

$wordSpacesString = createBlankWordString($wordBeingGuessed);

$con = mysqli_connect("127.0.0.1","guessTeReo","myadmin123","guessTeReo");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$con -> set_charset("utf8");
$sql = "UPDATE in_progress SET `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordSpacesString' WHERE `userID` = $id";

mysqli_query($con,$sql);
mysqli_close($con);

header ("Location: ../index.php");

function getWordFromDatabase(){
    $json = file_get_contents('http://toa-dev.devlab.ac.nz/api/words');
    $objWords = json_decode($json);
    $wordArray = $objWords->data;

    $word=$wordArray[array_rand($wordArray)]->mri_word;

    return $word;
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