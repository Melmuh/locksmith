<?php

echo "<table class=\"table table-dark\">
<thead>
    <tr>
        <th scope=\"col\" style=\"font-weight:200;\">Vorname</th>
        <th scope=\"col\" style=\"font-weight:200;\">Name</th>
        <th scope=\"col\" style=\"font-weight:200;\">Email Adresse</th>
        <th scope=\"col\" style=\"font-weight:200;\">Passwort</th>
    </tr>
</thead>
    </tbody>
        <form action=\"\" method=\"POST\">
            <tr>
                <th scope=\"row\">
                    <input type=\"text\" value=\"".$row['n_vorname']."\" name=\"n_vorname\" style=\"color:#000; font-weight:200\">
                </th>
                <td>
                    <input type=\"text\" value=\"".$row['n_name']."\" name=\"n_name\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"email\" name=\"n_email\" value=\"".$row['n_email']."\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"password\" name=\"n_pass\" value=\"".$row['n_pass']."\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    </tbody>
</table>
    <input type=\"submit\" name=\"dataend\" value=\"Änderung speichern\" class=\"btn btn-outline-dark\">
        </form>";

?>