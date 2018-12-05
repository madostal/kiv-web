<?php

    $soucet = $a + $b;
    echo "Úvodní text: $a + $b = $soucet";
    echo "<br/><br/>";


    //printr($uzivatele);

    if ($uzivatele != null) {
        echo "<table>";
            echo "<tr><th>Jmeno</th><th>Prijmeni</th></tr>";

        foreach ($uzivatele as $uzivatel) {
            echo "<tr><td>$uzivatel[jmeno]</td><td>$uzivatel[prijmeni]</td></tr>";
        }


        echo "</table>";
    }

    echo "<br/><br/>";