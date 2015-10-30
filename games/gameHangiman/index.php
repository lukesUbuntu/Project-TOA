<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 23/09/2015
 * Time: 4:44 PM
 */
include('checkGameStatus.php');
include('getUserInfo.php');
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href = "css/main.css" rel = "stylesheet" type = "text/css">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <title>Hangiman</title>
</head>
<body>
<div data-role="page" id="WonGame">
    <h1>Hangi-Man</h1>
    <button id="ButtonStartGame" data-role="button" class="btn" >Start Game</button>
	<button id="ButtonExitGame" data-role="button" class="btn" >Quit Game</button>
</div>

</body>
</html>

<script>
    $("#ButtonStartGame").click(function(){
        window.location.href='startNewRound.php';
    });
	$("#ButtonExitGame").click(function(){
        window.location.href='/';
    });
</script>