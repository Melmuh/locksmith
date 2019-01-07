<?php

echo "
<table class=\"table start-artikel\">
    <tr>
        <td colspan=\"2\">";

        $image = base64_encode($row['s_bild']);

        echo "<img src=\"data:image/jpeg;base64, ".$image."\" style=\"width:100%;\">
        </td>
    </tr>
    <tr>
        <td colspan=\"2\">
            <h2>
            <a href=\"?spiel=".$row['s_name']."\">
            ".$row['s_name']."
            </a>
            </h2>
        </td>
    </tr>
    <tr>
        <td>
            Hersteller: ".$row['s_hersteller']."
        </td>
        <td>
            F&uuml;r ".$row['s_preis']."€
        </td>
    </tr>
</table>";
?>