<?php

$result = ""; // vystup

if(isset($_POST["vstup-1"]) && isset($_POST["vstup-2"]) ){
    $suma = $_POST["vstup-1"]+$_POST["vstup-2"];
    $result .= $suma . " (AJAX)";
    // simulace chyby - pri vysledku 999
    if($suma == 999){
        // nekonecna smycka
        while(true){
            // nedela nic
        }
    }
} else {
    $result .= "NEMAM VSTUP (AJAX)";
}


echo $result;

?>