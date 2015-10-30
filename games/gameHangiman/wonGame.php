<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 22/09/2015
 * Time: 11:05 PM
 */

/*
 * Win game screen, updates user global score when a new round begins
 */
include('checkGameStatus.php');
include('getUserInfo.php');
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
        <h1>Hangi Successful!</h1>
        <div id="wordGuessed">
            <h3>You guessed it! The word was <?php echo $wordBeingGuessedString; ?></h3>
            <h4>
                Which means: '<?php echo $englishWord;?>'
                <br><br>
                Description: <?php echo $wordDescription;?>
                <br><br>
            </h4>
        </div>

        <div id=PointsEarned">
             <h5>
				Round Completed: <?php echo $roundNumber; ?>
				<br>
                 Feathers: <?php echo $totalFeathersEarned; ?>
                 <br>
                 Score: <div id="Score"></div>
                 <br>
             </h5>
        </div>

    <button id="ButtonNewRound" data-role="button" class="btn">Next Round</button>
    </div>
</body>

<script>
    var gameScore = <?php echo $gameScore; ?>;

    $( document).ready(function(){
        $("#Score").text("Score: " + gameScore);
    })

    $("#ButtonNewRound").click(function(){
        addScore(gameScore);
        window.location.href='startNewRound.php';
    });
</script>
</html>