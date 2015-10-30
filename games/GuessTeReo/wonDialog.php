?<?php
require_once 'getUser.php';
require_once 'processGame.php';
?>
<html>
<?php include 'includes/head.php' ?>
<body>
<div data-role="page" id="WonGame" data-theme="b">
    <div id="wordGuessed">
        <h1 id="dialogTitle">You done it! The word was <?php echo $wordBeingGuessedString; ?></h1>
    </div>

    <div id=PointsEarned">
        <p id="gameInfo">
            Round Completed: <?php echo $roundNumber; ?>
        </p>
        <p id="gameInfo">
            Feathers: <?php echo $totalFeathersEarned; ?>
        </p>
        <p id="gameInfo">
            Score: <?php echo $gameScore; ?>
        </p>
    </div>
    <button id="buttonNewRound" data-role="button" class="btn">Play Again</button>
    <button id="buttonQuit" data-role="button" class="btn">Go back to Main Menu</button>
</div>
</body>

<script>
    $("#buttonNewRound").click(function () {
        window.location.href = 'processNewRound.php';
    });
    $("#buttonQuit").click(function () {
        window.location.href = 'index.php';
    });
</script>
</html>