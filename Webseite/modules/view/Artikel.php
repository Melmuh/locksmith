<?php

echo "
<div class=\"card\" style=\"width: 19rem; float:left;\">
    <div class=\"card-body\">
        <h2 class=\"card-title\">
            ".$row['s_name']."
        </h2>
        <p>";
        $image = base64_encode($row['s_bild']);

        echo "<img src=\"data:image/jpeg;base64, ".$image."\" style=\"width:100%;\">
        </p>
        <p class=\"card-text\">
            Hersteller: ".$row['s_hersteller']."
        </p>
        <p class=\"card-text\">
            F&uuml;r ".$row['s_preis']."€
        </p>
        <a href=\"?spiel=".$row['s_name']."\" class=\"btn btn-primary\">
            Kaufen
        </a>
    </div>
</div>";
?>