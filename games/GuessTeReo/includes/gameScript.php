<!--Game script that is used throughout the game, to call the required information to make the game playable-->
<script>
    var id = <?php echo $id; ?>;
    var gameScore = <?php echo $gameScore; ?>;
    var livesRemaining = <?php echo $livesRemaining; ?>;
    var totalFeathersEarned = <?php echo $totalFeathersEarned; ?>;
    var incorrectGuesses = <?php echo $incorrectGuesses; ?>;

    var lettersGuessed = '<?php echo "$lettersGuessed"; ?>';
    var wordToDisplay = '<?php echo $wordToDisplay; ?>';
    var gameProgress = '<?php echo "$gameProgress"; ?>';
    var currentImage = '<?php echo $currentImage?>';
    console.log("lettersGuessed",lettersGuessed);
    console.log("wordToDisplay",wordToDisplay);
    console.log("gameProgress",gameProgress);
    console.log("gameScore",gameScore);
    console.log("imageSrc",currentImage);

    $(document).ready(function () {
        $(".currentImage").attr('src',currentImage);
        updateGameScreen();
    });

    $("#buttonHint").click(function () {
        getFeathers(function (response) {
            if (response < 2) {
                alert("You need 2 feathers to use a hint.");
            } else {
                if (confirm("Are you sure?")) {
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
            url: "processInput.php",
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
                alert("Failed to input key");
            }
        });
    });
    $("#buttonQuit").click(function () {
        if (confirm("Are you sure you want to quit?")) {
            window.location.href = 'lostDialog.php?quit';
        }
    });
    //$("#buttonSubmit").click(function () {
    //if
    //window.location.href = 'wonDialog.php';
    //});

    function processHint() {
        removeFeathers(2);
        $.ajax({
            type: "POST",
            cache: false,
            url: "processHint.php",
            data: {
                "id": id
            },
            dataType: "jsonp",
            success: function (response) {
                if (response.success == true) {
                    gameScore = response.gameScore;
                    livesRemaining = response.livesRemaining;
                    lettersGuessed = response.lettersGuessed;
                    wordToDisplay = response.wordToDisplay;
                    currentPage = response.currentPage;
                    gameProgress = response.gameProgress;
                    updateGameScreen();
                }
            },
            failure: function () {
                alert("Failed to process hint");
            }
        });
    }
    function updateGameScreen() {
        if (lettersGuessed.length > 0) {
            for (var i = 0; i < lettersGuessed.length; i++) {
            }
        }
        $("#Score").text("Score: " + gameScore);
        $("#Feathers").text("Feathers : " +  totalFeathersEarned);
        $("#WordToGuess").text(wordToDisplay);
        if (gameProgress == 'won') {
            window.location.href = 'wonDialog.php';
        }
        else if (gameProgress == 'lost') {
            window.location.href = 'lostDialog.php';
        }
        else if (gameProgress == 'gameover') {
            window.location.href = 'lostDialog.php';
        }
    }
</script>