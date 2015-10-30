<?php function createUser($id, $gameProgress)
{
    $con = mysqli_connect("127.0.0.1", "guessTeReo", "myadmin123", "guessTeReo");
    $createUserSQL = "INSERT INTO game_session (
    `userID`,
    `gameScore`,
    `livesRemaining`,
    `totalFeathersEarned`,
    `roundNumber`,
    `incorrectGuesses`,
    `lettersGuessed`,
    `wordBeingGuessed`,
    `gameProgress`,
    `currentImage`
    ) VALUES (
    '$id', '0', '3', '0', '1', '7', '', '','', '$gameProgress')";
    mysqli_query($con, $createUserSQL);
    mysqli_close($con);
}

?>