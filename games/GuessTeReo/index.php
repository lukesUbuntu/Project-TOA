<?php
set_include_path('.\includes');
// Functions

//Includes
//require_once 'connect.php';
require 'head.php';
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div data-role="header">
    <a href="../../index.php" class="button">Home</a>
    <a href="includes/scoreboard.php" class="button">Scoreboard</a>
</div>

<div data-role="main" class="ui-content">
    <div class="img">
        <a><img src="testImages/img4.jpg" alt="Game Image One" style="width:180px;
                    height:120px;"></a>
        <a><img src="testImages/img2.jpg" alt="Game Image Two" style="width:180px;
                    height:120px;"></a>
        </div>
    <div class="img">
        <a><img src="testImages/img3.jpg" alt="Game Image Three" style="width:180px;
                    height:120px;"></a>
        <a><img src="testImages/img4.jpg" alt="Game Image Four" style="width:180px;
                    height:120px;"></a>
    </div>

    <div id="guessWord">
        <input id="write" type="text">
    </div>

    <div id="keyboardContainer">
        <button id="gameInput" type="button">p</button>
        <button id="gameInput" type="button">h</button>
        <button id="gameInput" type="button">k</button>
        <button id="gameInput" type="button">m</button>
        <button id="gameInput" type="button">n</button>

        <button id="gameInput" type="button">a</button>
        <button id="gameInput" type="button">e</button>
        <button id="gameInput" type="button">i</button>
        <button id="gameInput" type="button">o</button>
        <button id="gameInput" type="button">u</button>

        <button id="gameInput" type="button">ā</button>
        <button id="gameInput" type="button">ē</button>
        <button id="gameInput" type="button">ī</button>
        <button id="gameInput" type="button">ō</button>
        <button id="gameInput" type="button">ū</button>

        <button id="gameInput" type="button">Ng</button>
        <button id="gameInput" type="button">r</button>
        <button id="gameInput" type="button">t</button>
        <button id="gameInput" type="button">w</button>
        <button id="gameInput" type="button">Wh</button>

        <div id="specialButtons">
            <button class="delete" type="button">Delete</button>
            <button class="space" type="button">Space</button>
            <button class="return" type="button">✅</button>
        </div>
    </div>
</div>
</body>
</html>
