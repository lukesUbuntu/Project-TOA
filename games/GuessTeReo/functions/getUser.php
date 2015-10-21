<?php
if (session_id() == "")
    session_start();
$id = $_SESSION['user_id'];

if($id == ""){
    return header ("Location: /");
}

$con = mysqli_connect("127.0.0.1","guessTeReo","myadmin123","guessTeReo");
$con -> set_charset("utf8");
if (mysqli_connect_errno())
{
    //echo "Failed to connect to database: " . mysqli_connect_error();
}

//Check if user exists in game database
if (session_id() == "")
    session_start();

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM in_progress WHERE userID = $id";

$result=mysqli_query($con,$sql);


if(mysqli_num_rows($result) == 0){
    require_once('addUser.php');
    createUser($id, 'no');
    $result=mysqli_query($con,$sql);
}

$row = mysqli_fetch_row($result);
$gameScore = $row[1];
$totalFeathersEarned = $row[2];
$roundNumber = $row[3];
$roundNumber = $row[4];
mysqli_close($con);
?>