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

        <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
                <dtitle>Top Game</dtitle>
                <hr>
                <div id="load"></div>
                <h2>Tetris</h2>
            </div>
        </div>

        <!-- DONUT CHART BLOCK
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
                <dtitle>Disk Space</dtitle>
                <hr>
                <div id="space"></div>
                <h2>65%</h2>
            </div>
        </div>
        -->
        <div class="col-sm-3 col-lg-3">

            <!-- LOCAL TIME BLOCK
            <div class="half-unit">
                <dtitle>Top Score</dtitle>
                <hr>
                <div class="clockcenter">
                    <digiclock>10000</digiclock>
                </div>
            </div>
            -->
            <!-- SERVER UPTIME -->
            <div class="half-unit">
                <dtitle>Feathers</dtitle>
                <hr>
                <div class="cont">
                    <p>
                        <bold>
                            <!--
                            feathers goes here from users object
                            !-->
                            {{ User.feathers_earned }}
                        </bold>
                        | feathers.
                    </p>
                </div>
            </div>

        </div>

    </div><!-- /row -->


    <!-- SECOND ROW OF BLOCKS -->
    <div class="row">
        <div class="col-sm-3 col-lg-3">
            <!-- MAIL BLOCK -->
            <div class="dash-unit">
                <dtitle>Top Players - Rank (5)</dtitle>
                <hr>
                <div class="framemail">
                    <div class="window">



                        <ul class="mail">
                            {% for score in ScoreBoard %}
                            <li>
                                <i class="unread"></i>

                                <img class="avatar" src="http://www.prepbootstrap.com/Content/images/shared/single-page-admin/photo01.jpeg" alt="avatar">
                                <p class="message"><strong>{{ score.game_score }}</strong> - {{score.Game.name}} </p>
                                <p class="sender">{{ score.Users.gamerTag }}</p>
                            </li>
                            {% endfor  %}

                            <!--
                            <li>
                                <i class="read"></i>
                                <img class="avatar" src="http://www.prepbootstrap.com/Content/images/shared/single-page-admin/photo02.jpg" alt="avatar">
                                <p class="sender">Dan E.</p>
                                <p class="message"><strong>10000</strong> - Last Played Tetris.</p>

                            </li>
                            <li>
                                <i class="read"></i>
                                <img class="avatar" src="http://www.prepbootstrap.com/Content/images/shared/single-page-admin/photo03.jpg" alt="avatar">
                                <p class="sender">Leonard N.</p>
                                <p class="message"><strong>10000</strong> - Last Played Tetris</p>

                            </li>
                            <li>
                                <i class="read"></i>
                                <img class="avatar" src="http://www.prepbootstrap.com/Content/images/shared/single-page-admin/photo04.jpg" alt="avatar">
                                <p class="sender">Peter B.</p>
                                <p class="message"><strong>10000</strong> - Last Played Tetris</p>

                            </li>
                            !-->
                        </ul>

                    </div>
                </div>
            </div><!-- /dash-unit -->
        </div><!-- /span3 -->

        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
                <dtitle>Game Tetris</dtitle>
                <hr>
                <div class="section-graph">
                    <div id="importantchart"></div>
                    <br>
                    <div class="graph-info">

                        <span class="graph-info-big">Score 634.39</span>
                        <i class="graph-arrow"></i>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
                <dtitle>Game Tetris</dtitle>
                <hr>
                <div class="section-graph">
                    <div id="importantchart"></div>
                    <br>
                    <div class="graph-info">

                        <span class="graph-info-big">Score 634.39</span>
                        <i class="graph-arrow"></i>

                    </div>
                </div>
            </div>
        </div>

    </div><!-- /row -->
        <!-- GAME BLOCK -->

    {% for game in Games %}

    <div class="col-sm-3 col-lg-3">
        <div class="dash-unit">
            <dtitle>{{ game.name }}</dtitle>
            <hr>
            <div class="info-user">
                <span aria-hidden="true" class="li_display fs2"></span>
            </div>
            <br>
            <div class="text">
                <button class="btn btn-success center-block"><a href="/games/{{ game.path() }}">Play Now</a></button>
            </div>

        </div>
    </div>
    {% endfor  %}



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