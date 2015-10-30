<?php set_include_path
('./functions' . PATH_SEPARATOR . './includes');
?>
<?php
require_once 'getUser.php';
require_once 'processGame.php';
?>
<html>
<?php include 'gameHead.php'; ?>

<body id="bodyGame">
<div data-role="page" id="game" data-theme="a">
    <?php
    include 'gameHeader.php';
    include 'imageCall.php';
    include 'gameSection.php';
    ?>
</div>
</body>
<?php
include 'gameScript.php';
include 'functionalScripts.php';
?>
</html>