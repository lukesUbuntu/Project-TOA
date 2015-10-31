<html>
<head>
    <meta name="viewport" charset="UTF-8"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="src/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <title>Te Reo Adventures</title>
</head>
<body>
<div data-role="page" data-theme="b">
    <h1 id="indexTitle">Te Reo Adventures</h1>
    <button id="buttonStart" data-role="button" class="btn">Start Game</button>
    <button id="buttonInstruct" data-role="button" class="btn">Instructions</button>
    <button id="buttonExit" data-role="button" class="btn">Quit Game</button>
</div>
</body>
<script>
    $(document).ready(function () {
        if (confirm("This game isn't implement click yes to quit"))
        $("#buttonStart").click(function () {
            if (confirm("This game isn't implement click yes to quit"))
            window.location.href = '/';
        });
        $("#buttonInstruct").click(function () {
            if (confirm("To be implemented, click yes to quit"))
            window.location.href = '/';
        });
        $("#buttonExit").click(function () {
            window.location.href = '/';
        });
    });
</script>
</html>