<?php 
//////////// Testovaci PHP skript pro overeni spravne funkcnosti serveru /////////////

// vypis pozdravu
echo "!! Hello word !!<br><br>";

// vytvorim pole znaku
$pole = array("Z", "C", "U", "-", "K","I","V");

// projdu pole a vypisu ho
foreach($pole as $p){
    echo $p."_";
}

?>