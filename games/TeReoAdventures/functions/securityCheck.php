<!--If user isn't logged into the system and tries to directly play from the URL, the user will be forced back to the
login screen to register or login.-->
<?php
    session_start();
    if (!isset($_SESSION['getUser.php'])) {
        header("Location: ../../../index.php");
        die();
    }
?>