<?php
require_once 'getUser.php';
require_once 'processGame.php';
?>
<html>
<?php include 'includes/gameHead.php'; ?>

<body id="bodyGame">
<div data-role="page" id="game" data-theme="a">
    <?php
    include 'includes/gameHeader.php';
    include 'functions/imageCall.php';
    include 'includes/gameSection.php';
    ?>
</div>
</body>
<?php
include 'includes/gameScript.php';
include 'includes/functionalScripts.php';
?>
</html>