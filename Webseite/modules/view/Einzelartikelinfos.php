
<?php

echo "
<div class=\"card einzelartikel\">
    <div class=\"card-body\">
        <div class=\"card-title\">
            <h2>
            ".$row['s_name']."
            </h2>
            <p>";
            $image = base64_encode($row['s_bild']);

            echo "<img src=\"data:image/jpeg;base64, ".$image."\" style=\"width:100%; height:auto;\">
            </p>
        </div>
        <p class=\"first-letter\">".htmlspecialchars($row['s_text'])."</p>
        <p>Entwickler: ".htmlspecialchars($row['s_hersteller'])."</p>
        <p style=\"font-weight:bold;\">Preis: ".htmlspecialchars($row['s_preis'])." €</p>
    </div>
</div>";
?>