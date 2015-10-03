<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 24/09/2015
 * Time: 1:15 AM
 */
if (session_id() == "")
session_start();

$id = $_SESSION['user_id'];

echo $id;
var_dump($json);
?>