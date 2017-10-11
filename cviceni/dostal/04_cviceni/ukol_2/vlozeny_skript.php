<?php

    // ochrana proti primemu volani tohoto skriptu
    if (isset($a) && isset($b)) {
        // tento skript lze pouze includovat a mel bych tedy mit
        // promenne $a a $b
        $c = $a + $b;
    }
    else
    {
        echo "chyba: tento skript nelze volat primo.";
    }
