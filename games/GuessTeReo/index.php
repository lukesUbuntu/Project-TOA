<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
set_include_path('includes');
// Functions

//Includes
//require_once 'connect.php';
require_once 'head.php';
require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div data-role="main" class="ui-content">
    <div class="img">
        <a><img src="src/gameImages/img4.jpg" alt="Game Image One" style="width:180px;
                    height:120px;"></a>
        <a><img src="src/gameImages/img2.jpg" alt="Game Image Two" style="width:180px;
                    height:120px;"></a>
        </div>
    <div class="img">
        <a><img src="src/gameImages/img3.jpg" alt="Game Image Three" style="width:180px;
                    height:120px;"></a>
        <a><img src="src/gameImages/img4.jpg" alt="Game Image Four" style="width:180px;
                    height:120px;"></a>
    </div>

    <?php
    require_once 'guessSection.php';
    require_once 'keyboard.php';
    ?>
    </div>
</body>
</html>
