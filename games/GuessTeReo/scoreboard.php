<?php set_include_path('.\includes'); ?>

<div data-role="page">
    <div data-role="header">
        <a href="index.php" class="button">Return to Game</a>
    </div>

    <div data-role="main" class="ui-content">
        <?php
        require_once 'gameScore.php';
        ?>
    </div>
</div>