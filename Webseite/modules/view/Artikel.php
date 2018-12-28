<?php

echo "
<div class=\"card\" style=\"width: 19rem; float:left;\">
    <img src='/Onlineshop2/locksmith/webseite/aussehen/vorlagen/Images/call-of-duty.jpg' style=\"width:100%;\" class=\"card-img-top\">
    <div class=\"card-body\">
        <h2 class=\"card-title\">
            ".$row['s_name']."
        </h2>
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