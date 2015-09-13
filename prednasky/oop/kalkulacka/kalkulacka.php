<?php

    class kalkulacka
    {
        public function secti($a, $b)
        {
            return $a + $b;
        }
    }

    $a = 1;
    $b = 2;

    $kalkulacka = new kalkulacka();
    $c = $kalkulacka->secti(1, 2);

    echo "Kolik je $a + $b?";
    echo "Výsledek je: $c";

?>