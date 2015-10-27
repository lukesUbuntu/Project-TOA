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
    <h1>Game Instructions</h1>

    <div id=PointsEarned">
        <h4>
            <p>test</p>
            <br><br>

            <p>test</p>

            <p>test</p>
        </h4>
    </div>

    <button id="buttonNewRound" data-role="button" class="btn">Go Back</button>
</div>
</body>

<script>
    $("#buttonNewRound").click(function () {
        window.location.href = '../index.php';
    });
</script>
</html>