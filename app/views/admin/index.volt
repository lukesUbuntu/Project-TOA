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
            <div class="dash-unit">
                <dtitle>User Profile</dtitle>
                <hr>
                <div class="thumbnail">
                    <img src="http://www.prepbootstrap.com/Content/images/shared/single-page-admin/face80x80.jpg" alt="Marcel Newman" class="img-circle">
                </div><!-- /thumbnail -->
                <h1></h1>

                <h3> {{ User.gamerTag }}</h3>
                <br>
                <div class="info-user">
                    <span aria-hidden="true" class="li_user fs1"></span>
                    <span aria-hidden="true" class="li_settings fs1"></span>
                    <span aria-hidden="true" class="li_mail fs1"></span>
                    <a href="/Index/logout"><span aria-hidden="true" class="li_key fs1"></span></a>
                </div>
            </div>
        </div>


    </div><!-- /row -->


</div> <!-- /container -->
<div id="footerwrap">
    <footer class="clearfix"></footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <p>{{ image("images/logo_big.png") }}</p>
                <p><h1>TOA - Project</h1></p>
            </div>

        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /footerwrap -->

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
        !-->