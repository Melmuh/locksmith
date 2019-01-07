<?php

echo "<h2>Artikel hinzufügen:</h2>";

echo "<form action=\"\" method=\"POST\" class=\"input-group mb-3\" enctype=\"multipart/form-data\">
<div class=\"input-group-prepend\">
<span class=\"input-group-text\">Spieltitel</span>
<input type=\"text\" name=\"s_name\" placeholder=\"z.B. Warcraft\" class=\"form-control\"  required>
</div>
<div class=\"input-group-prepend\">
<span class=\"input-group-text\">Hersteller</span>
<input type=\"text\" name=\"s_hersteller\" placeholder=\"z.B. Unisoft\" class=\"form-control\" required>
</div>
<div class=\"input-group-prepend\">
<span class=\"input-group-text\">Preis</span>
<input type=\"number\" name=\"s_preis\" placeholder=\"00.00€\" min=\"0.01\" max=\"199.99\" step=\"0.01\" data-number-to-fixed=\"2\" data-number-stepfactor=\"100\" class=\"form-control\" required>
</div>
<div class=\"input-group-prepend\">
<span class=\"input-group-text\">Beschreibung</span>
<textarea name=\"s_text\" placeholder=\"Abenteuer, Rollenspiel\" cols=\"30\" rows=\"10\" class=\"form-control\" required></textarea>
</div>
<div class=\"input-group-prepend\">
<span class=\"input-group-text\">Bild</span>
<input type=\"file\" name=\"image\" id=\"image\">
</div>

<input type=\"submit\" name=\"arthin\" value=\"Artikel hinzufügen\" class=\"btn btn-outline-dark\">

</form>";
echo "<h2 class=\"ueberschrift\">Aktuelle Artikel:</h2>";
?>