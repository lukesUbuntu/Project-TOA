<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>Ngati Toa Rangatira</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    {{ stylesheet_link("css/bootstrap.min.css") }}
    {{ stylesheet_link("css/style.css") }}
    {{ assets.outputCss() }}
</head>
<body>

<div class="container-fluid">
    {% if show_navigation %}
    <div class="row" id="panel-41711">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-static" role="navigation">
                <div class="navbar-header">
                    <a>{{ image("images/ngati-toa.gif") }}</a>

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> <a class="navbar-brand"></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <img src="images/profileImages/profile02.jpg" class="img-circle" alt="">
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <!--Missing three bar thingy mahigy-->

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" id="dropdown" data-toggle="dropdown"
                               style="">{{ User.username }}<strong class="caret"></strong></a>
                            <ul class="dropdown-menu" id="dropdown-menu">
                                <li>
                                    <a id="menuStyle" href="includes/editProfile.php">Edit Profile</a>
                                </li>
                                {% if Admin %}
                                    <li>
                                        <a id="menuStyle" href="/admin">Admin Mode</a>
                                    </li>
                                {% endif %}
                                <li>
                                    <a id="menuStyle" href="/Index/logout">Sign Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    {% endif %}

    <div class="row" id="bodyContainer">
        {{ content() }}
    </div>


<!-- Placed at the end of the document so the pages load faster -->
{{ javascript_include("js/vendor/jquery-1.9.1.min.js") }}
{{ javascript_include("js/vendor/bootstrap.js") }}
{{ javascript_include("js/scripts.js") }}
<!-- @todo this will need to be dynamic and load a js set by controller !-->
{{ assets.outputJs() }}

</body>
</html>