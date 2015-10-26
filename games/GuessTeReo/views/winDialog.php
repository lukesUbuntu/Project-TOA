<?php
//MUST CHANGE GAMEPROGRESS WHEN USER CLICKS MENU BUTTON
include('../controllers/processGameStatus.php');
include('../functions/getUser.php');
?>
<html>
<head>
    <?php require_once '../includes/head.php' ?>
</head>
<body>
<div data-role="page" id="WonGame">
    <h1>Hangi Successful!</h1>

    <div id="wordGuessed">
        <h2>You guessed it! The word was <?php echo $wordBeingGuessedString; ?></h2>
    </div>

    <div id=PointsEarned">
        <h4>
            Round Completed: <?php echo $roundNumber; ?>
            <br><br>
            Feathers: <?php echo $totalFeathersEarned; ?>
            <br><br>
            Score: <?php echo $gameScore; ?>
            <br><br>
        </h4>
    </div>

    <button id="buttonNewRound" data-role="button" class="btn">Next Round</button>
</div>
</body>

<script>
    $("#buttonNewRound").click(function () {
        window.location.href = '../controllers/processNewRound.php';
    });
</script>
</html>