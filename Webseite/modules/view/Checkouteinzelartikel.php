<?php
$spielpreis = $row['s_menge'] * $preis;
echo $spielename." und das ganze genau ".$row['s_menge']." mal für den Preis von ".$spielpreis."€! <hr>";
$endpreis = $endpreis + $spielpreis;

$spielestring = $spielestring .= $row['s_id']." (".$row['s_menge']."x), ";
$bestellung = substr($spielestring, 0, -2);

?>