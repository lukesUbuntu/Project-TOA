<?php
include('functions/getUser.php');
include('controllers/processGameStatus.php')
?>

<html>
<head>
    <?php
    require_once 'includes/head.php';
    ?>
    <script src="models/gameAPI.js"></script>
</head>
<body>
<div data-role="page" id="game" class="ui-content">
    <?php
    require_once 'includes/header.php';
    require_once 'includes/imageSection.php';
    require_once 'includes/keyboard.php';
    ?>
</div>
<script type="text/javascript" src="models/gameAPI.js"></script>
</body>
</html>

<script>
    var id = <?php echo $id; ?>;
    var gameScore = <?php echo $gameScore; ?>;
    var lettersGuessed = '<?php echo "$lettersGuessed"; ?>';
    var wordToDisplay = '<?php echo $wordToDisplay; ?>';
    var gameProgress = '<?php echo "$gameProgress"; ?>';

    $(document).ready(function () {
        updateGameScreen();
    });
    $("#buttonHint").click(function () {
        getFeathers(function (response) {
            if (response < 5) {
                alert("You don't have enough feathers to perform this action. Hints cost 5 feathers.");
            } else {
                if (confirm("Hints cost 5 feathers, and will leave you with " + (response - 5) + " feathers. Are you sure?")) {
                    processHint();
                }
            }
        })
    });
    $(".keyboardKey").click(function () {
        var $keyLetter = $(this).text();
        $.ajax({
            type: "POST",
            cache: false,
            url: "controller/processInput.php",
            data: //Must include user login
            {
                "id": id,
                "letter": $keyLetter
            },
            dataType: "jsonp",
            success: function (response) {
                if (response.success == true) {
                    gameScore = response.gameScore;
                    livesRemaining = response.livesRemaining;
                    incorrectGuesses = response.incorrectGuesses;
                    lettersGuessed = response.lettersGuessed;
                    wordToDisplay = response.wordToDisplay;
                    gameProgress = response.gameProgress;
                    updateGameScreen();
                }
            },
            failure: function () {
                alert("Failed to contact server, please try again");
            }
        });
    });
    $("#buttonQuit").click(function () {
        if (confirm("Are you sure you want to forfeit the game?")) {
            window.location.href = 'views/gameoverDialog.php';
        }
    });
    function processHint() {
        removeFeathers(5);
        $.ajax({
            type: "POST",
            cache: false,
            url: "controller/processHint.php",
            data: //Must include user login
            {
                "id": id
            },
            dataType: "jsonp",
            success: function (response) {
                if (response.success == true) {
                    gameScore = response.gameScore;
                    lettersGuessed = response.lettersGuessed;
                    wordToDisplay = response.wordToDisplay;
                    currentPage = response.currentPage;
                    gameProgress = response.gameProgress;
                    updateGameScreen();
                }
            },
            failure: function () {
                alert("Failed to contact server, please try again");
            }
        });
    }
    function updateGameScreen() {
        if (lettersGuessed.length > 0) {
            for (var i = 0; i < lettersGuessed.length; i++) {
                letterToMark = lettersGuessed.charAt(i);
                $("span:contains('" + letterToMark + "')").css("background-color", "black");
            }
        }
        $("#Score").text("Score: " + gameScore);
        $("#WordToGuess").text(wordToDisplay);
        if (gameProgress == 'won') {
            window.location.href = 'views/winDialog.php';
        }
        else if (gameProgress == 'lost') {
            window.location.href = 'controllers/processLose.php';
        }
        else if (gameProgress == 'gameover') {
            window.location.href = 'views/gameoverDialog.php';
        }
    }
</script>