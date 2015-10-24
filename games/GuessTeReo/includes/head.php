<head>
    <meta name="viewport" charset="UTF-8" content="width=device-width,
    initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="lib/jquery-1.11.3.min.js"></script>

    <script src="lib/jquery-ui.min.js"></script>

    <script src="lib/jquery.mobile-1.4.5.min.js"></script>
    <script src="lib/jquery.ui.touch-punch.min.js"></script>

    <link href="src/css/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet"/>
    <link href="src/css/jquery.mobile.theme-1.4.5.min.css" rel="stylesheet" />

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="src/JS/APICalls.js"></script>

    <!--<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>-->




    <script>
        //global
        window.winWord = null;
        window.hintWord = null;

        //set words
        $(document).ready(function () {
            $.getJSON('/api/words', function (wordList) {
                console.log('wordList', wordList);

                $.each(wordList.data, function (index, key) {
                    //console.log('id',index);
                    //console.log('words',key.mri_word);
                    window.winWord = key.mri_word;
                    //window.hintWord = key.eng_word;
                });

                console.log("window.winWord set to :", window.winWord);
                console.log("window.engWord set to :", window.hintWord);
                //throw Error("testing")
            })
        });

    </script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="src/JS/keyboard.js"></script>
    <link href="src/css/style.css" rel="stylesheet">
</head>