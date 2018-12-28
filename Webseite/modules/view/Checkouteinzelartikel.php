<?php
$spielpreis = $row['s_menge'] * $preis;
echo $spielename." und das ganze genau ".$row['s_menge']." mal für den Preis von ".$spielpreis."€! <hr>";
$endpreis = $endpreis + $spielpreis;

?>