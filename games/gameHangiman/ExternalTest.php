<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 24/09/2015
 * Time: 1:15 AM
 */
$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id = 5;
$con -> set_charset("utf8");
$sql = "SELECT * FROM in_progress WHERE userID = $id";
//Check if user exists in game database

$result=mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);
$gameScore = $row[1];
echo $gameScore;
?>