<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 15/09/2015
 * Time: 4:18 PM
 */

$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//check Login, get ID
$id = $_POST["id"];

$con -> set_charset("utf8");
$sql = "UPDATE in_progress SET `gameProgress` = 'no' WHERE `in_progress`.`userID` = $id";

if (mysqli_query($con,$sql) === TRUE) {
    $success = true;
}
mysqli_close($con);

$json = json_encode(array(
    'success' => $success
));
echo isset($_GET['callback'])
    ? "{$_GET['callback']}($json)"
    : $json;


?>