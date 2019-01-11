<table class="reg">
    <form method="POST" action="index.php">
    <tr>
        <td>
            <select name="n_anrede" size="1"><option value="frau">Frau</option><option value="herr">Herr</option></select>
        </td>
        <td>
            <input type="text" name="n_vorname" placeholder="Vorname" required>
        </td>
        <td>
            <input type="text" name="n_name" placeholder="Name" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" name="n_str" placeholder="Straße" required>
        </td>   
        <td>
            <input type="text" name="n_nr" placeholder="Hausnummer" required>
        </td>
        <td>
            <input type="text" name="n_ort" placeholder="PLZ, Ort" required>
        </td>
    </tr>
    <tr>    
        <td>
            <input type="text" name="n_bank" placeholder="Geldinsitut" required>
        </td>
    </tr>
    <tr>
        <td>
            <input type="text" name="n_iban" placeholder="IBAN" required>
        </td>
        <td>
            <input type="text" name="n_bic" placeholder="BIC (Erforderlich bei Auslandsinsitut)">
        </td>
    </tr>
    <tr>
        <td>
            <input type="email" name="n_email" placeholder="E-Mail" required>
        </td>
        <td>
            <input type="password" name="n_pass" placeholder="Passwort" required>
        </td>
        <td>
            <input type="submit" name="registrieren" value="Jetzt registrieren" class="btn-outline-dark" required>
        </td>
    </tr>
</form>
</table>