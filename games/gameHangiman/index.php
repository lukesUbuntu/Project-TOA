<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 24/08/2015
 * Time: 3:23 PM
 */
?>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link href = "css/main.css" rel = "stylesheet" type = "text/css">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        <!-- jQuery (required) & jQuery UI + theme (optional) -->
        <link href="docs/css/jquery-ui.min.css" rel="stylesheet">
        <script src="docs/js/jquery.min.js"></script>
        <script src="docs/js/jquery-ui.min.js"></script>
        <script src="docs/js/jquery-migrate-1.2.1.min.js"></script>

        <!-- keyboard widget css & script (required) -->
        <link href="css/keyboard.css" rel="stylesheet">
        <script src="js/jquery.keyboard.js"></script>

        <script src="docs/js/bootstrap.min.js"></script>
        <script src="docs/js/demo.js"></script>
        <script src="docs/js/jquery.tipsy.min.js"></script>
        <script src="docs/js/prettify.js"></script> <!-- syntax highlighting -->

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

                <h4 style="float: left;">Paua Remaining: X</h4>
                <h4 style="float: right;">Score: XXXX</h4>

            </div>


            <div id="Hangi">
                <img id="HangiImage" src="images/hangiPlaceholder.gif">
            </div>
            <div id="GameOptions">
                <button data-role="button" data-inline="true" class="btn" data-mini="true">Use Hint (10x Paua)</button>
                <button data-role="button" data-inline="true" class="btn" data-mini="true">Forfeit Game</button>
            </div>
            <div id="WordToGuess">
                _ _ _ _ _ _
            </div>
            <!--
            <div id="Keyboard">
                <div class="KeyboardRow">
                    <span class="KeyboardKey">Q</span>
                    <span class="KeyboardKey">W</span>
                    <span class="KeyboardKey">E</span>
                    <span class="KeyboardKey">R</span>
                    <span class="KeyboardKey">T</span>
                    <span class="KeyboardKey">Y</span>
                    <span class="KeyboardKey">U</span>
                    <span class="KeyboardKey">I</span>
                    <span class="KeyboardKey">O</span>
                    <span class="KeyboardKey">P</span>
                </div>
                <div class="KeyboardRow">
                    <span class="KeyboardKey">A</span>
                    <span class="KeyboardKey">S</span>
                    <span class="KeyboardKey">D</span>
                    <span class="KeyboardKey">F</span>
                    <span class="KeyboardKey">G</span>
                    <span class="KeyboardKey">H</span>
                    <span class="KeyboardKey">J</span>
                    <span class="KeyboardKey">K</span>
                    <span class="KeyboardKey">L</span>
                </div>
                <div class="KeyboardRow">
                    <span class="KeyboardKey">Z</span>
                    <span class="KeyboardKey">X</span>
                    <span class="KeyboardKey">C</span>
                    <span class="KeyboardKey">V</span>
                    <span class="KeyboardKey">B</span>
                    <span class="KeyboardKey">N</span>
                    <span class="KeyboardKey">M</span>
                </div>
            </div>
        </div>
        -->

            <div id="page-wrap">
                <div class="block" id="autocomplete">
                    <input id="text" type="text">
                    <br>
                </div>
            </div>
	</body>

</html>