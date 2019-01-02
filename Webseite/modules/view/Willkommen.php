<?php

echo "<div class=\"text-center\"><h2 class=\"ueberschrift\">Willkommen bei locksmith!</h2> 
Dein PC-Gaming Online-Shop des Vertrauens. 
Von gut bist böse, von klein bis groß - hier findet jeder sein Herzensstück!</div>";

echo "<div class=\"willkommen\"> Hallo, ".$vorname."!</div>";

echo "<form  method=\"POST\" action=\"\" class=\"willkommen\">

Nicht ".$vorname." ? <input type=\"submit\" name=\"logout\" value=\"Logout\" class=\"btn-outline-dark\">

</form>";

if(!isset($_GET['mein']))
{
    echo "<a href=\"?mein=bereich\">Mein Bereich</a>";
}




?>