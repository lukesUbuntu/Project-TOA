<?php
    include('getUser.php');

    $roundNumber++;
    $wordBeingGuessed = getWordFromDatabase();
    $gameProgress = "active";
    $wordToDisplay++;


    $con = mysqli_connect("127.0.0.1","toa","toa123","guessTeReo");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to database: " . mysqli_connect_error();
    }

    $con -> set_charset("utf8");
    $sql = "UPDATE game_session SET `totalFeathersEarned` = $totalFeathersEarned, `roundNumber` = $roundNumber,
`wordBeingGuessed` = '$wordBeingGuessed', `gameProgress` = '$gameProgress' WHERE `userID` = $id";

    mysqli_query($con,$sql);
    mysqli_close($con);

    header ("Location: index.php");

    function getWordFromDatabase(){
        $json = file_get_contents('http://toa-dev.devlab.ac.nz/api/words');
        $objWords = json_decode($json);
        $wordArray = $objWords->data;

        $word=$wordArray[array_rand($wordArray)]->mri_word;
        return $word;
    }
?>