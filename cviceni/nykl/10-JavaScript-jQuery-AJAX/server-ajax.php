<?php
///////////////////////////////////////////////////////////////////////////
///////////  PHP reagujici na AJAX volani              ////////////////////
///////////  Secte 2 cisla v POST/GET a soucet vrati   ////////////////////
///////////////////////////////////////////////////////////////////////////

// pozor: povolim pristup z libovolne domeny - Cross-origin Resource Sharing (CORS)
header('Access-Control-Allow-Origin: *');

// promenna pro slozeni vystupniho textu
$result = "";

// mam v POST nebo GET pozadovana data?
if(isset($_REQUEST["vstup_a"]) && isset($_REQUEST["vstup_b"])){
    // mam data - sectu je
    $suma = floatval($_REQUEST["vstup_a"]) + floatval($_REQUEST["vstup_b"]);
    // bude ve vystupu
    $result .= $suma;
} else {
    // nemam data - vypisu chybu
    $result .= "NEMAM VSTUPNI DATA";
}

// z ukazkovych duvodu vynutim cekani [s]
$tmpNum = mt_rand(1,5);
sleep($tmpNum);

// vypsani vysledku do stranky
echo $result;

?>
