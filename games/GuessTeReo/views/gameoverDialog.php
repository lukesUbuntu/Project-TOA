<?php
include('../functions/getUser.php');
include_once('../controllers/processGameStatus.php');
?>
    <html>
    <head>
        <?php require_once '../includes/head.php' ?>
    </head>
    <body>
    <div data-role="page" id="WonGame">
        <h1>Game Over</h1>

        <h2>
            <div id="Word"></div>
        </h2>
        <h3>
            <div id="Rounds"></div>
        </h3>

        <br><br>
        <br>
        <button id="ButtonMenu" data-role="button" class="btn">Back to Main Menu</button>
    </div>
    </body>

    <script>
        var wordBeingGuessed = '<?php echo "$wordBeingGuessedString"; ?>';
        var rounds = <?php echo $roundNumber; ?>;

        $(document).ready(function () {
            $("#Word").text("The word was: " + wordBeingGuessed);
            $("#Rounds").text("You survived " + rounds + " rounds!");
        });
        $("#buttonMenu").click(function () {
            window.location.href = '../index.php';
        });
    </script>
    </html>
<?php
include_once('../controllers/processReset.php');
?>