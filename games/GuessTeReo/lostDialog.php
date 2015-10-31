<?php


require_once 'getUser.php';

//require_once 'processGame.php';

?>
<html>
<?php include 'includes/head.php' ?>
<body>
<div data-role="page" id="WonGame" data-theme="b">
    <div id="wordGuessed">
        <h1 id="dialogTitle">You lost, The word was <?php echo $wordBeingGuessedString; ?></h1>
    </div>

    <div id=dialogContainer>
        <p id="gameInfo">
            Total Feathers: <?php echo $totalFeathersEarned; ?>
        </p>
        <p id="gameInfo">
            Total Score: <?php echo $gameScore; ?>
        </p>
    </div>

    <button id="buttonNewRound" data-role="button" class="btn">Play Again</button>
    <button id="buttonQuit1" data-role="button" class="btn">Go back to Main Menu</button>
</div>
</body>

<script>
    $("#buttonNewRound").click(function () {
        window.location.href = 'processNewRound.php';
    });
    $("#buttonQuit1").click(function () {
        window.location.href = 'index.php';
    });
</script>
</html>