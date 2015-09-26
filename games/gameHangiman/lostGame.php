<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 22/09/2015
 * Time: 11:06 PM
 */
//MUST CHANGE GAMEPROGRESS WHEN USER CLICKS MENU BUTTON
//include('checkGameStatus.php');
include('getUserInfo.php');
?>
<html>
<head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href = "css/main.css" rel = "stylesheet" type = "text/css">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <title>Hangiman</title>
</head>

<body>
<div data-role="page" id="WonGame">
    <h1>Game Over</h1>
    <div id="wordGuessed">
        <h2>The word was: <?php echo $wordBeingGuessedString; ?></h2>
    </div>

    <div id=PointsEarned">
        <h4>
            Final Score: <?php echo $gameScore; ?>
            <br><br>
            Feathers Earned: <?php echo $totalFeathersEarned; ?>
            <br><br>
        </h4>
    </div>

    <button id="ButtonHighScores" data-role="button" class="btn" >View High Scores</button>
	<br>
    <button id="ButtonMenu" data-role="button" class="btn" >Back to Main Menu</button>
</div>
</body>

<script>
    $("#ButtonHighScores").click(function(){
        alert("To be implemented");
    });
    $("#ButtonMenu").click(function(){
        window.location.href='resetProgress.php';
    });
</script>
</html>