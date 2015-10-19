
<div align="center">
    <h1>List Words</h1>
</div>

<table>
    {% for word in WordsList %}
    <tr>
        <td align="left" style="width:120px;">
            <label for="mri_word">Moari Word</label>
        </td>
        <td align="right">
            {{  word.mri_word }}
        </td>
        <td align="right" style="width:120px;">
            <label for="mri_word">English Word</label>
        </td>
        <td align="right">
            {{  word.eng_word }}
        </td>
        <td align="right">
            [Edit]
        </td>
    </tr>
    {% endfor  %}
</table>

</form>
