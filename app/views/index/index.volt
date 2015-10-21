<div class="row">
            <div class="col-md-12">
                <div class="tabbable" id="tabs-315995">
                    <ul class="nav nav-tabs" id="navtabs">
                        <li class="active">
                            <a href="#panel-417568" data-toggle="tab">Games</a>
                        </li>
                        <li>
                            <a href="#panel-635371" data-toggle="tab">Scoreboard</a>
                        </li>
                    </ul>

                    <!--
                    <ul class="nav nav-tabs-right">
                        <li>
                            <h4 id="scoreTabs">
                                Score: XXXX <?php // echo ""; ?>
                            </h4>
                        </li>
                        <li>
                            <h4 id="scoreTabs">
                                Feathers: XXX <?php // echo "$totalFeathersEarned"; ?>
                            </h4>
                        </li>
                    </ul>
                    -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-417568">


                            {% for game in Games %}
                            <div class="row" id="gameRowTop">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <img alt="" src="http://lorempixel.com/140/140/" class="img-thumbnail pull-right">
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1">

                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <dl>
                                        <dt>
                                        <h4>
                                            <span>{{ game.name }}</span>
                                        </h4></dt>
                                        <dd>
                                            {{ game.description }}
                                        </dd>
                                    </dl>
                                    <div class="text">
                                        <button class="btn btn-success"><a href="/games/{{ game.path() }}">Play Now</a></button>
                                    </div>
                                </div>
                            </div>

                            {% endfor  %}


                        </div>

                            <!--Scoreboard Section-->
                            <div class="tab-pane" id="panel-635371">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Score</th>
                                            <th>Most Played</th>
                                            <th>Rank</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {% for score in ScoreBoard %}
                                        <tr>
                                            <td>{{ score.Users.username }}</td>
                                            <td>{{ score.game_score }}</td>
                                            <td>{{score.Game.name}}</td>
                                            <td>1</td>
                                        </tr>
                                        {% endfor  %}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
