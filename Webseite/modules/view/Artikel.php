<?php

echo "
<table class=\"table start-artikel\">
    <tr>
        <td>
        <img src='/Onlineshop2/locksmith/webseite/aussehen/vorlagen/Images/call-of-duty.jpg' style=\"width:100%;\">
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
    <tr>
    <tr>
        <td>
            Hersteller:".$row['s_hersteller']."
        </td>
        <td>
            F&uuml;r".$row['s_preis']." €
        </td>
    </tr>
</table>";
?>