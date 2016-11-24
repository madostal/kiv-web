<?php 
// hlavni kontroler

/////// NASTAVENI ///////////
    // vynucený výpis všech chyb serveru
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);
/////////////////////////////

/////// data pro sablonu /////////    
$data = array();
//////////////////////////////////

/////// sprava prihlaseni uzivatele /////////    
include("prihlaseni.class.php"); // patricna trida
$pr = new Prihlaseni;
$vypis = ""; // kontrolni vypisy

// reaguje na odeslani formularu
if(isset($_POST["prihlaseni"])){
    $vypis .= "Přihlášení: ";
    $vypis .= $pr->prihlasUzivatele($_POST["login"])? "v pořádku" : "nezdařilo se";
} elseif (isset($_POST["odhlaseni"])) {
    $vypis .= "Odhlášení: ";
    $vypis .= $pr->odhlasUzivatele() ? "v pořádku" : "nezdařilo se";
}
    
// je uzivatel prihlasen ?
$uzivatel = $pr->kontrolaPrihlaseni(); // ziskam jmeno uzivatele
// pridam uzivatele k datum
$data["uzivatel"] = $uzivatel;
// ulozim vypis k datum
$data["prihlaseni"] = $vypis;
//////////////////////////////////////////////

/////// Nacteni kontroleru pro pozadovany web /////////////
$dostupne = array("uvod", "obchod"); // dostupne stranky webu

// mohu zobrazit pozadovany web?
if(isset($_GET["web"]) && in_array($_GET["web"],$dostupne)){ // mohu
    $zobrazim = $_GET["web"];      
} else { // nemohu - zobrazim uvod
    $zobrazim = $dostupne[0]; // prvni je defaultni
}
// nactu kontroler zobrazovane stranky
include($zobrazim.".class.php");

// vykonani funkci zobrazovane stranky
if($zobrazim=="uvod"){
    $web = new Uvod;
    $data = array_merge($data, $web->vratData());
} elseif($zobrazim=="obchod"){
    $web = new Obchod;
    $data = array_merge($data, $web->vratData($uzivatel));
}
/////////////////////////////////////////////////

/////////// vytvoreni vzhledu - php sablona ///////////
include 'sablony/sablona.class.php';
Sablona::zobraz($data); // funkce pro vykresleni sablony

///////////////////////////////////////////////////////

/////////// vytvoreni vzhledu - TWIG sablona  ////////////////////
/*
// nacist twig - kopie z dokumentace
require_once 'twig-master/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

// cesta k adresari se sablonama - od index.php
$loader = new Twig_Loader_Filesystem('sablony-twig');
$twig = new Twig_Environment($loader); // takhle je to bez cache

// nacist danou sablonu z adresare
$template = $twig->loadTemplate('sablona.twig');

///// vypsani vysledku
echo $template->render($data);
*/
/////////////////////////////////////////////////////

/////////// vytvoreni vzhledu - php wrapper ///////////
/*include "wrapper.class.php";
$vystup = Wrapper::phpWrapperFromFile("sablony/sablona.wrap.php"); // vypis sablony
echo $vystup;
*/
///////////////////////////////////////////////////////

?>
