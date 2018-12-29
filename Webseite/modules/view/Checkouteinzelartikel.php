<?php
$spielpreis = $row['s_menge'] * $preis;
echo $spielename." und das ganze genau ".$row['s_menge']." mal für den Preis von jeweils ".$preis."€! <hr>";
$endpreis = $endpreis + $spielpreis;


// $stm = $pdo->prepare("SELECT s_name FROM spiele WHERE s_id = :s_id");
// $stm->bindParam(":s_id", $row['s_id']);
// $stm->execute();
// $s_name = $stm->fetchColumn();
$spielestring = $spielestring .= $row['s_name']." (".$row['s_menge']."x), ";
$bestellung = substr($spielestring, 0, -2);

?>