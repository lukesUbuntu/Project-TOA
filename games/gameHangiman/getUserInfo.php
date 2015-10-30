<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 21/09/2015
 * Time: 3:25 PM
 */

/*
 *
 * Gets the user data from the database for any page that needs the data.
 * If the user doesn't have a database record in the case of a new user, 'addUserInDatabase' will be called beforehand
 *
 */
if (session_id() == "")
    session_start();
$id = $_SESSION['user_id'];

if($id == ""){
    return header ("Location: /");
}

$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
$con -> set_charset("utf8");
if (mysqli_connect_errno())
{
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Check if user exists in game database
if (session_id() == "")
    session_start();

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM in_progress WHERE userID = $id";

$result=mysqli_query($con,$sql);


if(mysqli_num_rows($result) == 0){
    require_once('addUserInDatabase.php');
    createUser($id, 'no');
    $result=mysqli_query($con,$sql);
}

$row = mysqli_fetch_row($result);
$gameScore = $row[1];
$livesRemaining = $row[2];
$totalFeathersEarned = $row[3];
$roundNumber = $row[4];
$incorrectGuesses = $row[5];
$lettersGuessed = $row[6];
$lettersGuessedArray = preg_split('//u',$row[6], -1, PREG_SPLIT_NO_EMPTY); //ensures Maori characters are properly encoded within string
$wordBeingGuessed = preg_split('//u',$row[7], -1, PREG_SPLIT_NO_EMPTY);//ensures Maori characters are properly encoded within string
$wordBeingGuessedString = $row[7];

$gameProgress = $row[8];
$wordToDisplay = $row[9];

$wordDescription = $row[10];
$englishWord = $row[11];

mysqli_close($con);
?>