<?php
    require_once 'connect.php';

    $sql = "SELECT `gameProgress` FROM in_progress WHERE userID = $id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($result);
    $gameProgress = $row[0];
    mysqli_close($con);
    $runningPage = basename($_SERVER['PHP_SELF']);

    if($gameProgress == "active" && $runningPage != 'index.php'){
        header ("Location: index.php");
    }
    elseif($gameProgress == "won" && $runningPage != 'wonGame.php'){
        header ("Location: wonDialog.php");
    }
    elseif($gameProgress == "inactive" && $runningPage != 'index.php'){
        header ("Location: ../../index.php");
    }
?>