<html>
<?php include 'includes/head.php' ?>
<link href = "src/css/style.css" rel = "stylesheet">
<body style="background-color: #22aadd;">
<div data-role="page" id="" data-theme="a">
    <div data-role="header" class="ui-bar ui-bar-b" style="padding-bottom: 23pt;">
        <button id="buttonQuit" data-role="button" data-inline="true" style="float= left">Home</button>
    </div>
    <h1 id="dialogTitle">Game Instructions</h1>

    <div id=dialogContainer">
        <p id="instruct">
            Once you've clicked "Start Game", the game will generate a random Te Reo Maori word. Which you will
            have to guess either using your PC's keyboard or using the keyboard on the game itself.
        </p>

        <p id="instruct">
            Once you've entered the set amount of letters, it will either accept the word bringing up the win dialogue.
            Or will
            do nothing and you will have to keep guessing.
        </p>

        <p id="instruct">
            Use the images to figure out what the Te Reo word could be, but if you get stuck you can always use
            the hint button to show one of the letters for that particular word. This does come at a cost of
            5 feathers, which also be used or earned in different games.
        </p>

        <p id="instruct">
            When the win dialogue does appear, you can either choose to play a new round of the game. Or quit to the
            main menu
        </p>

    </div>
</div>
</body>
<script>
    $("#buttonQuit").click(function () {
        window.location.href = 'index.php';
    });
</script>
</html>