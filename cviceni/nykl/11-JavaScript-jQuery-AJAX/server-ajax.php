<?php

$result = ""; // vystup

if(isset($_POST["vstup-1"]) && isset($_POST["vstup-2"]) ){
    $suma = $_POST["vstup-1"]+$_POST["vstup-2"];
    $result .= $suma . " (AJAX)";
} else {
    $result .= "NEMAM VSTUP (AJAX)";
}


echo $result;

?>