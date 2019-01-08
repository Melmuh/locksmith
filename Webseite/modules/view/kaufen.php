<?php

echo "Der Endpreis beträgt nun ".$endpreis."€ (zzgl. Abwicklungskosten)<br><br>";
// echo $bestellung;

echo "
<input type=\"checkbox\" id=\"myCheck\" onclick=\"myFunction()\">Ich akzeptiere die <a href=\"webseite/modules/view/AGBs.php\">AGBs!</a><br><br>
<input type=\"hidden\" value=\"".$endpreis."\" name=\"endpreis\">
<input type=\"hidden\" value=\"".$bestellung."\" name=\"bestellung\">
<input id=\"text\" style=\"display:none\" type=\"submit\" name=\"kaufen\" value=\"Jetzt zahlungspflichtig bestellen\" class=\"btn btn-outline-dark-kaufen\"></form><br>";

?>