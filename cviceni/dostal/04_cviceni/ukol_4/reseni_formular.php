<?php

    $zvirata = file_get_contents("zvirata.txt");

    // PHP_EOL - konec radky dle daneho systemu
    $zvirata_pole = explode(PHP_EOL, $zvirata);

    // kontrolni vypis
    print_r($zvirata_pole);

    // vypis pole
    echo "<h2>Výpis pole</h2>";
    if ($zvirata_pole != null)
        foreach ($zvirata_pole as $zvire)
        {
            echo "$zvire <br/>";
        }

    // vypis do selectu
    echo "<select>";
        if ($zvirata_pole != null)
        foreach ($zvirata_pole as $zvire)
        {
            echo "<option>$zvire</option>";
        }
    echo "</select>";
?>