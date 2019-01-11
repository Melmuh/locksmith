<?php
$spielpreis = htmlspecialchars($row['s_menge']) * $preis;
echo "<strong>".$spielename."</strong> und das ganze genau <strong>".htmlspecialchars($row['s_menge'])."</strong> x für den Preis von jeweils <strong>".$preis."€!</strong><hr>";
$endpreis = $endpreis + $spielpreis;

$spielestring = $spielestring .= $row['s_name']." (".$row['s_menge']."x), ";
$bestellung = substr($spielestring, 0, -2);

?>