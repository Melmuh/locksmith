<?php


    echo "<form method=\"POST\" action=\"\" style=\"font-weight:bold;\">".$spielename."
    <input type=\"number\" name=\"neuanzahl\" value=\"".htmlspecialchars($row['s_menge'])."\" min=\"1\" max=\"".$restanzahl."\" style=\"text-align:right;margin:1em;\">
    <input type=\"hidden\" name=\"wid\" value=\"".htmlspecialchars($row['w_id'])."\">
    <input type=\"submit\" name=\"update\" value=\"Aktualisieren\" class=\"btn btn-outline-dark\">
    <input type=\"submit\" value=\"Löschen\" name=\"del\" class=\"btn btn-outline-dark\">
    </form>";


?>