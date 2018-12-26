<?php

    echo "
<table class=\"table table-dark\">
    <thead>
        <tr>
            <th scope=\"col\">Spieltitel</th>
            <th scope=\"col\">Hersteller</th>
            <th scope=\"col\">Preis</th>
        </tr>
    </thead>
    </tbody>
        <form action=\"\" method=\"POST\">
            <tr>
                <input type=\"hidden\" value=\"".$row['s_id']."\" name=\"s_id\">
                <th scope=\"row\"><input type=\"text\" value=\"".$row['s_name']."\" name=\"s_name\">
                </th>
                <td>
                <input type=\"text\" value=\"".$row['s_hersteller']."\" name=\"s_hersteller\">
                </td>
                <td>
                <input type=\"number\" name=\"s_preis\" value=\"".$row['s_preis']."\" min=\"0.01\" max=\"99.99\" step=\"0.01\" data-number-to-fixed=\"2\" data-number-stepfactor=\"100\">
                </td>
            </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan=\"3\" scope=\"col\">Beschreibung</th>
        </tr>
    </thead>
    <tbody>
            <tr style=\"width:100%;\">
                <td colspan=\"3\">
                <input type=\"text\" value=\"".$row['s_text']."\" name=\"s_text\" style=\"width:100%;\" >
                </td>
            </tr>
    </table>
        <input type=\"submit\" name=\"artaend\" value=\"Änderung speichern\" class=\"btn-outline-dark\">
        <input type=\"submit\" name=\"artdel\" value=\"Artikel löschen\" class=\"btn-outline-dark\">
</form>
";

?>