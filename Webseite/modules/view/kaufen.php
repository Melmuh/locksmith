<?php

echo "Der Endpreis beträgt nun ".$endpreis."€<br><br>";
echo $bestellung;

echo "<form action=\"?vielen=dank\" method=\"POST\">
<input type=\"checkbox\" id=\"myCheck\" onclick=\"myFunction()\">Ich akzeptiere die <a href=\"webseite/modules/view/AGBs.php\">AGBs!</a><br><br>
<input type=\"hidden\" value=\"".$endpreis."\" name=\"endpreis\">
<input type=\"hidden\" value=\"".$bestellung."\" name=\"bestellung\">
<input id=\"text\" style=\"display:none\" type=\"submit\" name=\"kaufen\" value=\"Jetzt kaufen!\"></form><br>";

?>