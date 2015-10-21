<!--style needs to be moved!-->
<style>
    tr td {
        margin-top: 15px;
    }
</style>
<div align="center">
    <h1>Listing Games</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <span class="btn btn-success">Add</span>
        </div>
        <div class="col-lg-8">
            <table id="usersLists">
                <thead>
                <tr  >
                    <th width="10%">Game ID</th>
                    <th width="30%">Game Name</th>

                </tr>
                </thead>
                {% for game in Games %}
                    <tr>

                        <td>
                            {{  game.game_id }}
                        </td>

                        <td>
                            {{  game.name }}
                        </td>
                        <td>
                            <span><br/></span>
                           <span class="btn btn-warning">Edit</span>
                        </td>
                    </tr>
                {% endfor  %}
            </table>
        </div>
    </div>
</div>





