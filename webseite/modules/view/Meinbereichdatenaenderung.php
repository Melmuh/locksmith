<?php

echo "
<table class=\"table table-dark\">
    <thead>
        <tr>
            <th scope=\"col\" style=\"font-weight:200;\">Anrede</th>
            <th scope=\"col\" style=\"font-weight:200;\">Vorname</th>
            <th scope=\"col\" style=\"font-weight:200;\">Name</th>
        </tr>
    </thead>
    </tbody>
        <form action=\"\" method=\"POST\">
            <tr>
                <th scope=\"row\">
                    <select value=\"".$row['n_anrede']."\" name=\"n_anrede\" size=\"1\" style=\"color:#000; font-weight:200\">
                </th>
                <td>
                    <input type=\"text\" value=\"".$row['n_vorname']."\" name=\"n_vorname\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"text\" value=\"".$row['n_name']."\" name=\"n_name\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    <thead>
            <tr>
                <th scope=\"col\" style=\"font-weight:200;\">Straße</th>
                <th scope=\"col\" style=\"font-weight:200;\">Hausnummer</th>
                <th scope=\"col\" style=\"font-weight:200;\">Ort</th>
            </tr>
    </thead>
            <tr>
                <td>
                    <input type=\"text\" value=\"".$row['n_str']."\" name=\"n_str\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"text\" value=\"".$row['n_nr']."\" name=\"n_nr\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"text\" value=\"".$row['n_ort']."\" name=\"n_ort\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    <thead>
            <tr>
                <th scope=\"col\" style=\"font-weight:200;\">Bankinstitut</th>
            </tr>
    </thead>
            <tr>
                <td colspan=\"3\">
                    <input type=\"text\" value=\"".$row['n_bank']."\" name=\"n_bank\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    <thead>
            <tr>
                <th scope=\"col\" style=\"font-weight:200;\">IBAN</th>
            </tr>
    </thead>
            <tr>
                <td colspan=\"3\">
                    <input type=\"text\" value=\"".$row['n_iban']."\" name=\"n_iban\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    <thead>
            <tr>
                <th scope=\"col\" style=\"font-weight:200;\">BIC</th>
            </tr>
    </thead>
            <tr>
                <td colspan=\"3\">
                    <input type=\"text\" value=\"".$row['n_bic']."\" name=\"n_bic\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    <thead>
            <tr>
                <th scope=\"col\" style=\"font-weight:200;\">Email Adresse</th>
                <th scope=\"col\" style=\"font-weight:200;\">Passwort</th>
                <th scope=\"col\" style=\"font-weight:200;\">Passwort bestätigen</th>
            </tr>
    </thead>
            <tr>
                <td>
                    <input type=\"email\" name=\"n_email\" value=\"".$row['n_email']."\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"password\" name=\"n_pass\" value=\"".$row['n_pass']."\" style=\"color:#000; font-weight:200\">
                </td>
                <td>
                    <input type=\"password\" name=\"n_pass2\" value=\"".$row['n_pass2']."\" style=\"color:#000; font-weight:200\">
                </td>
            </tr>
    </tbody>
</table>
    <input type=\"submit\" name=\"dataend\" value=\"Änderung speichern\" class=\"btn btn-outline-dark\">
</form>";

?>