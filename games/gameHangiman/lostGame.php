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
include_once('checkGameStatus.php');
?>
<html>
<head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href = "css/main.css" rel = "stylesheet" type = "text/css">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="models/APICalls.js"></script>

    <title>Hangiman</title>
</head>

<body>
<div data-role="page" id="WonGame">
    <h1>Game Over</h1>
    <h2><div id="Word"></div></h2>
    <h3><div id="Rounds"></div></h3>
        <h4>
            <div id="Score"></div>
            <br>
            <div id="Feathers"></div>
        </h4>
    <br><br>
    <button id="ButtonHighScores" data-role="button" class="btn" >View High Scores</button>
	<br>
    <button id="ButtonMenu" data-role="button" class="btn" >Back to Main Menu</button>
</div>
</body>

<script>
    var wordBeingGuessed = '<?php echo "$wordBeingGuessedString"; ?>';
    var gameScore = <?php echo $gameScore; ?>;
    var feathersEarned = <?php echo $totalFeathersEarned; ?>;
    var rounds = <?php echo $roundNumber; ?>;

    $( document).ready(function(){
        $("#Word").text("The word was: " + wordBeingGuessed);
        $("#Score").text("Final Score: " + gameScore);
        $("#Feathers").text("Feathers Earned: " + feathersEarned);
        $("#Rounds").text("You survived " + rounds + " rounds!");
        addFeathers(feathersEarned);
        addScore(gameScore);
    });
    $("#ButtonHighScores").click(function(){
        alert("To be implemented");
    });
    $("#ButtonMenu").click(function(){
        window.location.href='index.php';
    });
</script>
</html>
<?php
include_once('resetProgress.php');
?>