<?php
include('getUserInfo.php');
include('checkGameStatus.php')
?>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href = "css/main.css" rel = "stylesheet" type = "text/css">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="models/APICalls.js"></script>

		<title>Hangiman</title>
	</head>
	<body>
	<!--
	<div data-role="page" id="menu">
		<h1>Hangiman</h1>
		<a href="#game" data-role="button">Play Game</a>
		<a href="#instructions" data-role="button">Instructions</a>
		<a href="#highscores" data-role="button">High Scores</a>
	</div>
-->
    <div data-role="page" id="game">
        <div data-role="main">
            <div id="infobar" class="ui-bar ui-bar-a">
                <h4 id="FoodRemaining" style="float: left;">Lives Remaining: X</h4>
                <h4 id="Score" style="float: right;">Score: XXXX</h4>
            </div>


            <div id="Hangi">
                <img id="HangiImage">
            </div>

            <div id="WordToGuess">
                *Word Goes here*
            </div>
            <div id="GameOptions">
                <button id="ButtonHint" data-role="button" data-inline="true" class="btn" data-mini="true">Use Hint (5x Feathers)</button>
                <button id="ButtonForfeit" data-role="button" data-inline="true" class="btn" data-mini="true">Forfeit Game</button>
            </div>
            <div id="Keyboard">
                <div class="KeyboardRow">
                    <span class="KeyboardKey">q</span>
                    <span class="KeyboardKey">w</span>
                    <span class="KeyboardKey">e</span>
                    <span class="KeyboardKey">r</span>
                    <span class="KeyboardKey">t</span>
                    <span class="KeyboardKey">y</span>
                    <span class="KeyboardKey">u</span>
                    <span class="KeyboardKey">i</span>
                    <span class="KeyboardKey">o</span>
                    <span class="KeyboardKey">p</span>
                </div>
                <div class="KeyboardRow">
                    <span class="KeyboardKey">a</span>
                    <span class="KeyboardKey">s</span>
                    <span class="KeyboardKey">d</span>
                    <span class="KeyboardKey">f</span>
                    <span class="KeyboardKey">g</span>
                    <span class="KeyboardKey">h</span>
                    <span class="KeyboardKey">j</span>
                    <span class="KeyboardKey">k</span>
                    <span class="KeyboardKey">l</span>
                </div>
                <div class="KeyboardRow">
                    <span class="KeyboardKey">z</span>
                    <span class="KeyboardKey">x</span>
                    <span class="KeyboardKey">c</span>
                    <span class="KeyboardKey">v</span>
                    <span class="KeyboardKey">b</span>
                    <span class="KeyboardKey">n</span>
                    <span class="KeyboardKey">m</span>
                </div>
            </div>
        </div>

        <div data-role="page" id="LostGame">
            <h1>lost</h1>
        </div>
        <div data-role="page" id="WonGame">
            <h1>won</h1>
        </div>
	</body>

<script>
    <?php
//$gameScore = 3;
 ?>
    var id = <?php echo $id; ?>;
    var gameScore = <?php echo $gameScore; ?>;
    var livesRemaining = <?php echo $livesRemaining; ?>;
    var incorrectGuesses = <?php echo $incorrectGuesses; ?>;
    var lettersGuessed = '<?php echo "$lettersGuessed"; ?>';
    var wordToDisplay = '<?php echo $wordToDisplay; ?>';
    var gameProgress = '<?php echo "$gameProgress"; ?>';

    var hangiAnimateDestroyAndReplaceFoodBasket = new Image();
    var hangiAnimateNewFoodBasket = new Image();
    hangiAnimateDestroyAndReplaceFoodBasket.src = "images/hangiReplace.gif";
    hangiAnimateNewFoodBasket.src = "images/hangiNew.gif";


    $( document).ready(function(){
        updateGameScreen();
        animateBasketNew();
    });
    $("#ButtonHint").click(function(){
        getFeathers(function(response){
            if( response < 5){
                alert("You don't have enough feathers to perform this action. Hints cost 5 feathers.");
            }else {
                if (confirm("Hints cost 5 feathers, and will leave you with " + (response - 5) + " feathers. Are you sure?")) {
                    processHint();
                }
            }
        })
    });
    $(".KeyboardKey").click(function(){
        var $keyLetter = $(this).text();
        $.ajax({
            type:"POST",
            cache:false,
            url:"processInput.php",
            data: //Must include user login
            {
                "id" : id,
                "letter" : $keyLetter
            },
            dataType: "jsonp",
            success: function(response){
                if (response.success == true){
                    if( incorrectGuesses != response.incorrectGuesses ){
                        animateBasketDestroyAndReplace();
                    }
                    gameScore = response.gameScore;
                    livesRemaining = response.livesRemaining;
                    incorrectGuesses = response.incorrectGuesses;
                    lettersGuessed = response.lettersGuessed;
                    wordToDisplay = response.wordToDisplay;
                    gameProgress = response.gameProgress;
                    updateGameScreen();
                }
            },
            failure: function(){
                alert("Failed to contact server, please try again");
            }
        });
    });
    $("#ButtonForfeit").click(function(){
        if(confirm("Are you sure you want to forfeit the game?")){
			window.location.href='lostGame.php';
        }
    });
    function processHint(){
        removeFeathers(5);
        $.ajax({
            type:"POST",
            cache:false,
            url:"processHint.php",
            data: //Must include user login
            {
                "id" : id
            },
            dataType: "jsonp",
            success: function(response){
                if (response.success == true){
                    gameScore = response.gameScore;
                    livesRemaining = response.livesRemaining;
                    lettersGuessed = response.lettersGuessed;
                    wordToDisplay = response.wordToDisplay;
                    currentPage = response.currentPage;
                    gameProgress = response.gameProgress;
                    updateGameScreen();
                }
            },
            failure: function(){
                alert("Failed to contact server, please try again");
            }
        });
    }
    function updateGameScreen(){
        if (lettersGuessed.length > 0){
            for (var i=0; i < lettersGuessed.length; i++) {
                letterToMark = lettersGuessed.charAt(i);
                $("span:contains('" + letterToMark + "')").css("background-color", "black");
            }
        }
        $("#Score").text("Score: " + gameScore);
        $("#FoodRemaining").text("Food Baskets: " + incorrectGuesses);
        $("#WordToGuess").text(wordToDisplay);
        if( gameProgress == 'won'){
            window.location.href='wonGame.php';
        }
        else if( gameProgress == 'lost'){
            window.location.href='lostRound.php';
        }
        else if(gameProgress == 'gameover'){
            window.location.href='lostGame.php';
        }
    }
    function animateBasketNew(){
        console.log("animated");
        $("#HangiImage").attr('src', hangiAnimateNewFoodBasket.src);
    }
    function animateBasketDestroyAndReplace(){
        console.log("animated");
        $("#HangiImage").attr('src', hangiAnimateDestroyAndReplaceFoodBasket.src);
    }

</script>

</html>