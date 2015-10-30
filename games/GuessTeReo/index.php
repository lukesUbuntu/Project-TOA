﻿<?php
if (session_id() == "")
   session_start();

include 'getUser.php';
include 'processGame.php';
?>
<html>
<?php
set_include_path ('./includes');
include 'head.php';
?>
<body>
<div data-role="page" data-theme="b">
    <h1 id="indexTitle">Guess Te Reo Māori</h1>
    <button id="buttonStart" data-role="button" class="btn">Start Game</button>
    <button id="buttonInstruct" data-role="button" class="btn">Instructions</button>
    <button id="buttonExit" data-role="button" class="btn">Quit Game</button>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#buttonStart").click(function () {
            window.location.href = 'processNewRound.php';
        });
        $("#buttonInstruct").click(function () {
            window.location.href = 'instructionDialog.php';
        });
        $("#buttonExit").click(function () {
            window.location.href = '/';
        });
    });

</script>