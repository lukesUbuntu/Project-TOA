<!--style needs to be moved!-->
<style>
    tr td {
        margin-top: 15px;
    }
</style>
<div align="center">
    <h1>Listing Users</h1>
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
                    <th width="10%">UserID</th>
                    <th width="30%">Username</th>
                    <th>email</th>
                    <th>Attachments</th>
                    <th>Action</th>
                </tr>
                </thead>
                {% for user in Users %}
                    <tr>

                        <td>
                            {{  user.id }}
                        </td>

                        <td>
                            {{  user.username }}
                        </td>
                        <td>
                            {{  user.email }}
                        </td>
                        <td>
                            {% if user.admin == "true" %}
                                [x]
                            {% endif  %}
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






