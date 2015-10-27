<?php
if (session_id() == "")
    session_start();
$id = $_SESSION['user_id'];

if ($id == "") {
    return header("Location: /");
}

$con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "SELECT `gameProgress` FROM game_session WHERE userID = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);
$gameProgress = $row[0];
mysqli_close($con);

$runningPage = basename($_SERVER['PHP_SELF']);

/*
if($runningPage != 'game.php'){
    switch ($gameProgress){
        case "":
            $.mobile.changePage( $("#pg2"), "slide", true, true);
            break;
    }
}*/
if ($gameProgress == "active" && $runningPage != 'game.php') {
    header("Location: game.php");
}

if ($gameProgress == "won" && $runningPage != 'winDialog.php') {
    header("Location: winDialog.php");
}

if ($gameProgress == "lost" && $runningPage != 'gameoverDialog.php') {
    header("Location: gameoverDialog.php");
}

if ($gameProgress == "no" && $runningPage != 'index.php') {
    header("Location: index.php");
}

if ($gameProgress == "gameover" && $runningPage != 'gameoverDialog.php') {
    header("Location: gameoverDialog.php");
}
?>

