<!DOCTYPE html>
<html>
    <head>

        {{ stylesheet_link("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css", false) }}
        {{ stylesheet_link("css/login.css") }}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>TOA</title>
    </head>
    <body>
        {{ content() }}
        <!--scripts !-->
        {{ javascript_include("js/jquery-1.9.1.min.js") }}
        <!-- @todo this will need to be dynamic and load a js set by controller !-->
        {{ javascript_include("js/login.js") }}
    </body>
</html>
