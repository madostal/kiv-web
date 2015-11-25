<?php 
// controller
/////// NASTAVENI ///////////
    // vynucený výpis všech chyb serveru
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);
/////////////////////////////


/////// funkce smerovace stranek /////////////
include("kosik.php"); // nactu funkce zobrazovane stranky
$web = new Kosik;
$glob_uzivatel = "Zákazník 123";
$data = $web->vratData($glob_uzivatel);

$data["uzivatel"] = $glob_uzivatel; // pridam uzivatele

/////////////////////////////////////////////////

/////////// vytvoreni vzhledu - php sablona ///////////

include 'sablona.class.php';
Sablona::zobraz($data); // funkce pro vykresleni sablony

///////////////////////////////////////////////////////


?>