<?php

    echo "<h1>Cykly</h1>";

    // for
    echo "<h2>Cyklus FOR</h2>";
    for ($i = 1; $i <= 10; $i ++)
    {
        echo "$i <br/>";
    }


    // foreach
    echo "<h2>Cyklus foreach</h2>";
    $auta = array("Škoda", "Jaguar", "Volkswagen");

    if ($auta != null)
    foreach ($auta as $key => $auto)
    {
        echo "$key - $auto <br/>";
    }


    // while - s podmínkou na začátku
    echo "<h2>Cyklus while</h2>";
    $x = 1;

    while($x <= 5) {
        echo "X: $x <br>";
        $x++;
    }

    // do-while - s podmínkou na konci
    echo "<h2>Cyklus do-while</h2>";
    $x = 1;

    do {
        echo "The number is: $x <br>";
        $x++;
    } while ($x <= 5);
?>