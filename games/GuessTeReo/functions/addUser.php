<?php
    function createUser($id, $gameProgress)
    {
        $con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
        $createUserSQL = "INSERT INTO in_progress (`userID`,`gameScore`,`totalFeathersEarned`,`wordBeingGuessed`,
                          `roundNumber`,`gameProgress`) VALUES ('$id', '0', '', '0', '1', '$gameProgress')";
        mysqli_query($con, $createUserSQL);
        mysqli_close($con);
    }
?>