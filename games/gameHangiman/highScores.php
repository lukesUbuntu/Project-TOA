<?php
/**
 * Created by PhpStorm.
 * User: 21300082
 * Date: 22/09/2015
 * Time: 11:06 PM
 */
//include('checkGameStatus.php');
include('getUserInfo.php');
?>
<html>
<head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <link href = "css/main.css" rel = "stylesheet" type = "text/css">
    <script src="models/APICalls.js"></script>

    <title>Hangiman</title>
</head>

<body>

<div data-role="page" id="WonGame">
    <h1>High Scores</h1>
    <div id="HighScores">
        <table id="HighScoresTable">
            <thead align="left">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>
<div class="modal" hidden="true"></div>
</body>
<script>
    $( document).ready(function(){
        for( i=1; i<=20; i++) {
            $("#HighScoresTable").find('tbody')
                .append($('<tr>')
                    .append($('<td>').text(i))
                    .append($('<td>').text("Example name"))
                    .append($('<td>').text("504"))
                )
        }
    });
</script>
</html>