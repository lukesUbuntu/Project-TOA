<?php

if (session_id() == "")
    session_start();

$id = $_SESSION['user_id'];

if ($id == "") {
    header("Location: ../../index.php");
}


$con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
$con->set_charset("utf8");
if (mysqli_connect_errno()) {
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Check if user exists in game database


$sql = "SELECT * FROM game_session WHERE userID = $id";

$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) == 0) {
    require_once('createUser.php');
    createUser($id, 'no');
    $result = mysqli_query($con, $sql);
}

$row = mysqli_fetch_assoc($result);


/*
 * (
    [0] => 29
    [1] => 0
    [2] => 3
    [3] => 0
    [4] => 2
    [5] => 7
    [6] => -
    [7] => ""
    [8] => ""
    [9] => _ _ _ _ _ _
)

 */
//$json = json_decode(file_get_contents("http://toa.devlab.ac.nz/api/words?img_src1&img_src2&limit=1"));

$gameScore = $row['gameScore'];
$livesRemaining = $row['livesRemaining'];
$totalFeathersEarned = $row['totalFeathersEarned'];
$roundNumber = $row['roundNumber'];
$incorrectGuesses = $row['incorrectGuesses'];
$lettersGuessed = $row['lettersGuessed'];

$lettersGuessedArray = preg_split('//u', $row['lettersGuessed'], -1, PREG_SPLIT_NO_EMPTY); //ensures Maori characters are properly encoded within string
$wordBeingGuessed = preg_split('//u', $row['wordBeingGuessed'], -1, PREG_SPLIT_NO_EMPTY);//ensures Maori characters are properly encoded within string
//$wordBeingGuessed = $json->mri_word;
$wordBeingGuessedString = $row['wordBeingGuessed'];
//$wordBeingGuessedString = $json->eng_word;

$gameProgress = $row['gameProgress'];
$wordToDisplay = $row['wordToDisplay'];
$currentImage = $row['currentImage'];
//print_r($row);exit;

mysqli_close($con);
?>