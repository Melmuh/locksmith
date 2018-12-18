<?php

echo "<br><br>Artikel hinzufügen:<br>";
echo "<form action=\"\" method=\"POST\">
<br><input type=\"text\" name=\"s_name\" placeholder=\"Spieletitel\" required><br><br>
<input type=\"text\" name=\"s_hersteller\" placeholder=\"Hersteller\" required><br><br>
<input type=\"number\" name=\"s_preis\" placeholder=\"69.99\" min=\"0.01\" max=\"99.99\" step=\"0.01\" data-number-to-fixed=\"2\" data-number-stepfactor=\"100\" required> €<br><br>
<textarea name=\"s_text\" placeholder=\"Beschreibung\" cols=\"30\" rows=\"10\" required></textarea><br><br>
<input type=\"submit\" name=\"arthin\" value=\"Artikel hinzufügen\">
</form><br><br><br>";

?>