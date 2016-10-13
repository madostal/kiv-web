<?php

    // Řádkový komentář

    /*
     * Blokový komentář
     */
    $a = 5;
    $b = 3;

    echo "Hodnota proměnných ab je: $a$b <br/>";
    echo "Hodnota proměnné a je: ".$a."  <br/>";


    $c = $a + $b;
    echo "Hodnota proměnné c = a + b je: <strong>$c</strong><br/>";

    $pole = array();
    $pole["a"] = "a";
    $pole["b"] = "b";

    echo "Výpis celého pole pro testovací účely: <br/>";
    print_r($pole);

    echo "<br/>";

    echo "První metoda - na indexu b je: $pole[b] <br/>";
    echo "Druhá metoda - na indexu b je: ".$pole["b"]."<br/>";
?>