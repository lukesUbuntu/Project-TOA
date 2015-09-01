<?php

include("Plugin.php");

$plugins = new Module\Plugin();

if (isset($_GET) && $_GET['game'])
    $plugins->runGame( $_GET['game']);