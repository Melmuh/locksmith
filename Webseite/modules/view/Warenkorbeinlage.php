<?php

echo "<form method=\"POST\" action=\"\"><input type=\"number\" name=\"artanzahl\" value=\"1\" min=\"1\" max=\"".$restanzahl."\">
        <input type=\"hidden\" name=\"sid\" value=\"".$row['s_id']."\">
        <input type=\"submit\" name=\"korblegen\" value=\"In den Warenkorb legen\" class=\"btn-outline-dark\">
        </form>";
echo $row['s_id'];


?>