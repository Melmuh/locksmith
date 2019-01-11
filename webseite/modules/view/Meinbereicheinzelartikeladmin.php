<?php

echo "Nutzer-ID: ".htmlspecialchars($row['n_id']).": ".$n_name.", ".htmlspecialchars($row['k_spiele']).", ".htmlspecialchars($row['k_datum']).", ".htmlspecialchars($row['k_zeit']).", ".htmlspecialchars($row['k_preis'])."€<hr>";
?>