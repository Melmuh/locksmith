<?php

    echo "<form action=\"\" method=\"POST\">
    <input type=\"hidden\" value=\"".$row['s_id']."\" name=\"s_id\">
    <input type=\"text\" value=\"".$row['s_name']."\" name=\"s_name\">
    <input type=\"text\" value=\"".$row['s_hersteller']."\" name=\"s_hersteller\">
    <input type=\"number\" name=\"s_preis\" value=\"".$row['s_preis']."\" min=\"0.01\" max=\"99.99\" step=\"0.01\" data-number-to-fixed=\"2\" data-number-stepfactor=\"100\"> €
    <input type=\"text\" value=\"".$row['s_text']."\" name=\"s_text\">
    <input type=\"submit\" name=\"artaend\" value=\"Änderung speichern\">
    <input type=\"submit\" name=\"artdel\" value=\"Artikel löschen\">
    </form>";

?>