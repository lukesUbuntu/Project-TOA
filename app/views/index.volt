<!DOCTYPE html>
<html>
    <head>
        <!--style sheets!-->
        {{ stylesheet_link("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css", false) }}
        {{ stylesheet_link("css/vendor/main.css") }}
        {{ stylesheet_link("css/vendor/font-style.css") }}
        {{ stylesheet_link("css/vendor/flexslider.css") }}


        {{ stylesheet_link("css/styles.css") }}

        {{ assets.outputCss() }}
        <link rel="icon" href="data:;base64,iVBORw0KGgo=">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            body {
                padding-top: 60px;
            }
        </style>
        <!-- Google Fonts call. Font Used Open Sans & Raleway -->
        <link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <title>Project TOA</title>
    </head>
    <body>
        {{ content() }}

        <!-- Placed at the end of the document so the pages load faster -->
        {{ javascript_include("js/vendor/jquery-1.9.1.min.js") }}
        {{ javascript_include("js/vendor/bootstrap.js") }}

        <!-- @todo this will need to be dynamic and load a js set by controller !-->
        {{ assets.outputJs() }}
    </body>
</html>
