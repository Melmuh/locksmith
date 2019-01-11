<?php


echo "<div class=\"willkommen\" style=\"font-size:20pt;\"> Willkommen bei Locksmith, ".htmlspecialchars($vorname)."!</div>";

echo "<form  method=\"POST\" action=\"\" class=\"willkommen\">

Nicht ".htmlspecialchars($vorname)." ? <input type=\"submit\" name=\"logout\" value=\"Logout\" class=\"btn btn-outline-dark\">

</form>";

// if(!isset($_GET['mein']))
// {
//     echo "<a href=\"?mein=bereich\">Mein Bereich</a>";
// }




?>