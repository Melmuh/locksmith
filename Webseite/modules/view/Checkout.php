<?php
$endpreis = 0;
$spielestring = "";
echo "<h2>Bestellübersicht</h2>";

echo "<form action=\"?vielen=dank\" method=\"POST\">

<fieldset>Zahlungsmethode wählen:<br>
    <input type=\"radio\" id=\"kk\" name=\"Zahlmethode\" value=\"0\" checked=\"checked\">
    <label for=\"kk\"> Kreditkarte (+0.00€)</label> <br>
    <input type=\"text\" name=\"nr\" placeholder=\"Kartennummer\">
    <input type=\"text\" name=\"nr2\" placeholder=\"Prüfziffer\"><br>
    <input type=\"radio\" id=\"pp\" name=\"Zahlmethode\" value=\"2.5\">
    <label for=\"pp\"> PayPal (+2.50€)</label> <br>
    <input type=\"radio\" id=\"su\" name=\"Zahlmethode\" value=\"2.5\">
    <label for=\"su\"> Paysafecard (+2.50€)</label> <br>
    <input type=\"radio\" id=\"su\" name=\"Zahlmethode\" value=\"2.5\">
    <label for=\"su\"> SEPA Lastschriftmandat</label> 
</fieldset>
<hr>
";

?>