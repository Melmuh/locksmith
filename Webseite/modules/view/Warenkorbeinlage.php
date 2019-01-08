<?php

echo "<form method=\"POST\" action=\"\" style=\"float:right;\">
        <input type=\"number\" name=\"artanzahl\" value=\"1\" min=\"1\" max=\"".$restanzahl."\">
        <input type=\"hidden\" name=\"sid\" value=\"".$row['s_id']."\">
        <input type=\"hidden\" name=\"sname\" value=\"".$row['s_name']."\">
        <input type=\"submit\" name=\"korblegen\" value=\"In den Warenkorb legen\" class=\"btn btn-outline-dark\">
        </form>";
?>