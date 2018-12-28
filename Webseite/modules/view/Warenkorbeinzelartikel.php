<?php


    echo "<form method=\"POST\" action=\"\">".$spielename."
    <input type=\"number\" name=\"neuanzahl\" value=\"".$row['s_menge']."\" min=\"1\" max=\"".$restanzahl."\">
    <input type=\"hidden\" name=\"wid\" value=\"".$row['w_id']."\">
    <input type=\"submit\" name=\"update\" value=\"Speichern\">
    <input type=\"submit\" value=\"Löschen\" name=\"del\" class=\"btn-outline-dark\">
    </form>";


?>