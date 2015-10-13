<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 22/09/2015
 * Time: 10:48 PM
 */
if (session_id() == "")
    session_start();
$id = $_SESSION['user_id'];

if($id == ""){
    return header ("Location: /");
}

$con = mysqli_connect("127.0.0.1","toa","toa123","gameHangiman");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "SELECT `gameProgress` FROM in_progress WHERE userID = $id";
$result=mysqli_query($con,$sql);
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
if($gameProgress == "running" && $runningPage != 'game.php'){
    header ("Location: game.php");
}

if($gameProgress == "won" && $runningPage != 'wonGame.php'){
    header ("Location: wonGame.php");
}

if($gameProgress == "lost" && $runningPage != 'lostRound.php'){
    header ("Location: lostRound.php");
}

if($gameProgress == "no" && $runningPage != 'index.php'){
    header ("Location: index.php");
}

if($gameProgress == "gameover" && $runningPage != 'lostGame.php'){
    header ("Location: lostGame.php");
}
?>

