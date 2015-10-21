
<div align="center">
    <h1>List Words</h1>
</div>


<table id="wordLists" class="display" cellspacing="0" width="80%" >
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
            [Edit]
        </td>
    </tr>
    {% endfor  %}
</table>

