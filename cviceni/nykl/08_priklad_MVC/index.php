<?php 
// controller

//// sprava prihlaseni uzivatele    
include("prihlaseni.class.php");
    $pr = new Prihlaseni;
    $vypis = ""; // kontrolni vypisy

    // reaguje na odeslani formularu
    if(isset($_POST["prihlaseni"])){
        $vypis .= "Přihlášení: ";
        $vypis .= $pr->prihlasUzivatele($_POST["login"],"neni");
    } elseif (isset($_POST["odhlaseni"])) {
        $vypis .= "Odhlášení: ";
        $vypis .= $pr->odhlasUzivatele();
    }

// je uzivatel prihlasen ?
$glob_uzivatel = $pr->kontrolaPrihlaseni(); // toto se bude propagovat do includovaneho souboru, pokud jim neni objekt.

$dostupne = array("uvod", "kosik"); // dostupne stranky webu
$zobrazim = $dostupne[0]; // prvni de defaultni

// kontrola zmeny webu
if(isset($_GET["web"]) && in_array($_GET["web"],$dostupne)){
    $zobrazim = $_GET["web"];    
}

include($zobrazim.".php");

?>