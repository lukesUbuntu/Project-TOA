<?php

require ('getUser.php');
$word = getWordFromDatabase();

$roundNumber++;
$wordBeingGuessed = $word->mri_word;
$incorrectGuesses = 7;
$lettersGuessed = "- ";
$gameProgress = "running";
$wordToDisplay = "";
$currentImage = $word->img_src1;

$wordSpacesString = createBlankWordString($wordBeingGuessed);

$con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$con->set_charset("utf8");
$sql = "UPDATE game_session SET  `livesRemaining` = $livesRemaining, `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber, `incorrectGuesses` = $incorrectGuesses, `lettersGuessed` = '$lettersGuessed', `wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress', `wordToDisplay` = '$wordSpacesString', `currentImage` = '$currentImage' WHERE `userID` = $id";

mysqli_query($con, $sql);
mysqli_close($con);

header("Location: game.php");

function getWordFromDatabase()
{
    $json = file_get_contents('http://toa.devlab.ac.nz/api/words?img_src1&limit=1');
    $objWords = json_decode($json);
    //$wordArray = $objWords->data;
    //$word = $wordArray[array_rand($wordArray)]->mri_word;
    //$imageSrc = $json->img_src1;
    return $objWords->data[0];
}

function createBlankWordString($wordBeingGuessed)
{
    $stringToDisplay = "";;
    $wordLength = mb_strlen($wordBeingGuessed);
    $wordArray = preg_split('//u', $wordBeingGuessed, -1, PREG_SPLIT_NO_EMPTY);


    foreach ($wordArray as $letter) {
        switch ($letter) {
            case " ":
                $stringToDisplay .= "  ";
                break;
            case "-":
                $stringToDisplay .= "- ";
                break;
            default:
                $stringToDisplay .= "_ ";
        }
    }
    return $stringToDisplay;
}

?>