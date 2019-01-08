<?php

    echo "<h2>Ihr Warenkorb:</h2>";

    if($korbanzahl > 0)
    {
        echo "<form action=\"\" method=\"GET\"><input type=\"submit\" name=\"bestellen\" value=\"Zur Kasse\" class=\"checkout btn btn-outline-dark\"></form>";
    }
    else{
        echo "Es befindet sich kein Artikel in Ihrem Warenkorb.";
    }
?>