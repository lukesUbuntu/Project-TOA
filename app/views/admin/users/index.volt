<div align="center">
    <h1>List Users</h1>
</div>


<table>
    <tr>
        <td align="left" style="width:120px;">
            <label for="mri_word">User ID</label>
        </td>
        <td align="right">

        </td>
        <td align="right" style="width:120px;">
            <label for="mri_word">Email</label>
        </td>
        <td align="right">

        </td>
        <td align="right">
            [Edit]
        </td>
    </tr>
    {% for user in Users %}
        <tr>
            <td align="" style="width:120px;">

            </td>
            <td align="">
                {{  user.id }}
            </td>
            <td align="" style="width:120px;">
            </td>
            <td align="">
                {{  user.email }}
            </td>
            <td align="right">
                [Edit]

                {% if user.admin == "true" %}
                    Admin Account
                {% endif  %}
            </td>
        </tr>
    {% endfor  %}
</table>
