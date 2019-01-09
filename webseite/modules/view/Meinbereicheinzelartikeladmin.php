<?php

    echo  "<strong>Besteller:</strong> ".$row['n_vorname']." ".$row['n_name']."<br><strong>Wohnhaft in:</strong> ".$row['n_str']." ".$row['n_nr']." ".$row['n_ort']."<br><strong>Bankdaten: </strong>"
    .$row['n_bank']."<br>".$row['n_iban']." ".$row['n_bic']."<br>Hat am <strong>"
    .$row['k_datum']."</strong> um <strong>".$row['k_zeit']." Uhr</strong> für <strong>".$row['k_preis']."€</strong> das Spiel: <strong>".$row['k_spiele']."</strong> bestellt.<hr>";
?>