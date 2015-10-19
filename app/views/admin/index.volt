<!-- NAVIGATION MENU -->

<div class="navbar-nav navbar-inverse navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>


        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a width="300 px" class="navbar-brand" href="/">{{ image("images/logo.png") }}</a></li>
                <li><h2>TOA Project</h2></li>
                <li><a href="/Index/logout"><span aria-hidden="true" class="li_key fs1"></span></a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">

    <!-- FIRST ROW OF BLOCKS -->
    <div class="row">

        <!-- USER PROFILE BLOCK -->
        <div class="col-sm-3 col-lg-3">
            <a href="admin/words">Words</a>
        </div>


    </div><!-- /row -->


</div> <!-- /container -->


        <!--
        {{ javascript_include("js/vendor/lineandbars.js") }}

        {{ javascript_include("js/vendor/dash-charts.js") }}
        {{ javascript_include("js/vendor/gauge.js") }}

        <!-- NOTY JAVASCRIPT -->

        {{ javascript_include("js/vendor/noty/jquery.noty.js") }}
        {{ javascript_include("js/vendor/noty/layouts/top.js") }}
        {{ javascript_include("js/vendor/noty/layouts/topLeft.js") }}
        {{ javascript_include("js/vendor/noty/layouts/topRight.js") }}
        {{ javascript_include("js/vendor/noty/layouts/topCenter.js") }}

        <!-- You can add more layouts if you want -->
        {{ javascript_include("js/vendor/noty/themes/default.js") }}

        {{ javascript_include("js/vendor/jquery.flexslider.js")}}
