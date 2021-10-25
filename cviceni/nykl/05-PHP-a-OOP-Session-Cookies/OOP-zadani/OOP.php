<?php

// pripojim vsechny tridy, tj. soubory zacinajici na C
foreach (glob("C*.php") as $obj){
    require_once $obj;
    echo "Připojuji $obj<br>";
}

//////////////  Vykreslitelne tvary  ///////////////////////////////
echo "<hr>Vykreslitelné tvary:<br>";

/** @var IDrawable[] $shapes  Pole vykreslitelnych tvaru. */
$shapes = [];
//$shapes[] = new CPoint("Bod",5,4);
//$shapes[] = new CLine("Čára",5,4, 10, 0.5);
//$shapes[] = new CCircle("Kruh",6,5, 15);
//$shapes[] = new CSquare("Čtverec",6,5, "blue", 10);
//$shapes[] = new CRectangle("Obdélník",6,5, "blue", 10, 5);

// projdu tvary a volam jejich metodu pro vykresleni
foreach ($shapes as $shape){
    $shape->draw();
    echo "<br>";
}

//////////////  KONEC: Vykreslitelne tvary  ///////////////////////////////

//////////////  Tvary s plochou (ctyruhelniky)  ///////////////////////////////
echo "<hr>Čtyřúhelníky:<br>";

/** @var ATetragon[] $areas */
$areas = [];
//$areas[] = new CSquare("Čtverec-A",6,5, "blue", 10);
//$areas[] = new CRectangle("Obdélník-A",6,5, "blue", 10, 5);
//$areas[] = new CSquare("Čtverec-B",6,5, "blue", 5);
//$areas[] = new CRectangle("Obdélník-B",6,5, "blue", 5, 2);
// lze, funguje a nehlasi chybu (chyba nastane az pri pristupu na atribut color, ktery CCircle nema)
//$areas[] = new CCircle("Kruh-A",6,5, 6);

// projdu ctyruhelniky a volam jejich metodu pro vykresleni a pro vypis plochy
foreach ($areas as $area) {
    $area->draw();
    echo "- area: ".$area->getArea()." m<sup>2</sup>";
    echo "<br>";
}

//////////////  KONEC: Tvary s plochou (ctyruhelniky)  ///////////////////////////////

?>
