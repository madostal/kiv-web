<?php 
// controller
/////// NASTAVENI ///////////
    // vynucený výpis všech chyb serveru
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);
/////////////////////////////

/////// sprava prihlaseni uzivatele /////////    

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

//////////////////////////////////////////////

/////// funkce smerovace stranek /////////////
$data = array();   // data pro vypsani na webu

$dostupne = array("uvod", "kosik"); // dostupne stranky webu
$zobrazim = $dostupne[0]; // prvni je defaultni

// mohu zobrazit pozadovany web?
if(isset($_GET["web"]) && in_array($_GET["web"],$dostupne)){
     $zobrazim = $_GET["web"];      
}
include($zobrazim.".php"); // nactu funkce zobrazovane stranky

// vykonani funkci zobrazovane stranky
if($zobrazim=="uvod"){
    $web = new Uvod;
    $data = $web->vratData();
} elseif($zobrazim=="kosik"){
    $web = new Kosik;
    $data = $web->vratData($glob_uzivatel);
}
$data["uzivatel"] = $glob_uzivatel; // pridam uzivatele

/////////////////////////////////////////////////

/////////// vytvoreni vzhledu - php sablona ///////////

include 'sablona.class.php';
Sablona::zobraz($data); // funkce pro vykresleni sablony

///////////////////////////////////////////////////////

/////////// vytvoreni vzhledu - TWIG sablona  ////////////////////
/*
// nacist twig - kopie z dokumentace
require_once 'twig-master/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

// cesta k adresari se sablonama - od index.php
$loader = new Twig_Loader_Filesystem('sablony-vysl');
$twig = new Twig_Environment($loader); // takhle je to bez cache

// nacist danou sablonu z adresare
$template = $twig->loadTemplate('sablona.tpl');


///// vypsani vysledku
echo $template->render($data);
*/
/////////////////////////////////////////////////////

?>