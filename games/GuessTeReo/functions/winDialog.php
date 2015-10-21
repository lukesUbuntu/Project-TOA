<?php
    //To add checkUser to see if their logged in
    include('securityCheck.php');
    require_once('../includes/header.php');
?>

<body>
    <div role="dialog" class="ui-dialog-contain ui-overlay-shadow ui-corner-all">
        <div data-role="header" data-theme="b" role="banner" class="ui-header ui-bar-b"
             <h1 class="ui-title" role="heading" aria-level="1">Correct</h1>
        </div>

        <div role="main" class="ui-content">
            <h1>You guessed it!!</h1>
            <p>
                You have earned the following
                Feathers: <?php echo $totalFeathersEarned; ?>
                Score Points: <?php echo $gameScore; ?>
            </p>
            <p>"Maori Word to go here" means <?php echo $wordBeingGuessedString;?></p>
            <a href="" data-rel="back" id="newRound" class="ui-btn ui-shadow ui-corner-all ui-btn-a">Next Round</a>
            <a href="../scoreboard.php" data-rel="back" class="ui-btn ui-shadow ui-corner-all ui-btn-a">Scoreboard</a>
            <a href="../../../index.php" data-rel="back" class="ui-btn ui-shadow ui-corner-all ui-btn-a">Quit</a>
        </div
<script>
    $("#newRound").click(function(){
        window.location.href='nextRound.php';
    });
</script>-->