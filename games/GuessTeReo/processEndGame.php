<?php
$con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST["id"];

$con->set_charset("utf8");
$sql = "UPDATE game_session SET `gameProgress` = 'no' WHERE `game_session`.`userID` = $id";

if (mysqli_query($con, $sql) === TRUE) {
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