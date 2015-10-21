<?php

    class kalkulacka
    {
        public function secti($a, $b)
        {
            return $a + $b;
        }
    }

    $a = 1;
    $b = 3;

    $kalkulacka = new kalkulacka();
    $c = $kalkulacka->secti($a, $b);

    echo "Kolik je $a + $b? ";
    echo "Výsledek je: <b>$c</b>";

?>