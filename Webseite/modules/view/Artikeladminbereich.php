<?php

    echo "
<table class=\"table table-dark\">
    <thead>
        <tr>
            <th scope=\"col\" style=\"font-weight:200;\">Spieltitel</th>
            <th scope=\"col\" style=\"font-weight:200;\">Hersteller</th>
            <th scope=\"col\" style=\"font-weight:200;\">Preis</th>
        </tr>
    </thead>
    </tbody>
        <form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">
            <tr>
                <input type=\"hidden\" value=\"".$row['s_id']."\" name=\"s_id\">

                <th scope=\"row\">
                <input type=\"text\" value=\"".$row['s_name']."\" name=\"s_name\" style=\"color:#000; font-weight:200\">
                </th>
                <td>
                <input type=\"text\" value=\"".$row['s_hersteller']."\" name=\"s_hersteller\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                <input type=\"number\" name=\"s_preis\" value=\"".$row['s_preis']."\" min=\"0.01\" max=\"99.99\" step=\"0.01\" data-number-to-fixed=\"2\" data-number-stepfactor=\"100\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan=\"3\" scope=\"col\" style=\"font-weight:200;\">Beschreibung</th>
        </tr>
    </thead>
    <tbody>
            <tr style=\"width:100%;\">
                <td colspan=\"3\">
                    <textarea  name=\"s_text\" style=\"width:100%; height:5em; color:#000;\"> 
                        \"".$row['s_text']."\"
                    </textarea>
                </td>
            </tr>
        </tbody>
    <thead>
        <tr>
            <th colspan=\"3\" scope=\"col\" style=\"font-weight:200;\">Titelbild</th>
        </tr>
    </thead>
    <tbody>
        <tr style=\"width:100%;\">
                <td colspan=\"3\">
                    <input type=\"file\" name=\"image\" id=\"image\" style=\"width:100%; height:auto; color:#000;\"> 
                </td>
            </tr>
        </tbody>

    </table>
        <input type=\"submit\" name=\"artaend\" value=\"Änderung speichern\" class=\"btn btn-outline-dark\">
        <input type=\"submit\" name=\"artdel\" value=\"Artikel löschen\" class=\"btn btn-outline-dark\">
</form>
";

?>