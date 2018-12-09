<?php

$spielhersteller = $pdo->query("SELECT s_hersteller FROM spiele WHERE s_name = ".$_GET['spiel']."")->fetchColumn();

echo $spielhersteller;




?>