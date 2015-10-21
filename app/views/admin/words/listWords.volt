
<div align="center">
    <h1>List Words</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <span class="btn btn-success">Add</span>
        </div>
        <div class="col-lg-8">
            <table id="wordLists" class="display" cellspacing="0" >
                <thead>
                <tr>
                    <th width="10%">Moari Word</th>
                    <th width="30%">English Word</th>
                    <th>Description</th>
                    <th>Attachments</th>
                    <th>Action</th>
                </tr>
                </thead>
                {% for word in WordsList %}
                    <tr>

                        <td align="">
                            {{  word.mri_word }}
                        </td>
                        <td align="">
                            {{  word.eng_word }}
                        </td>
                        <td align="">
                            {{  word.word_desc }}
                        </td>
                        <td align="">
                            <ul>
                                <li>
                                    Audio
                                </li>
                                <li>
                                    Image
                                </li>
                            </ul>
                        </td>
                        <td align="right">
                            <span class="btn btn-success">Edit</span>
                            <span class="btn btn-warning">Delete</span>
                        </td>
                    </tr>
                {% endfor  %}
            </table>
        </div>
    </div>
</div>



