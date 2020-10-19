<?php
//////////////////////////////////////////////////////////////////
/////////////////  Globalni nastaveni aplikace ///////////////////
//////////////////////////////////////////////////////////////////

//// Pripojeni k databazi ////

/** Adresa serveru. */
define("DB_SERVER",""); // https://students.kiv.zcu.cz
/** Nazev databaze. */
define("DB_NAME","");
/** Uzivatel databaze. */
define("DB_USER","");
/** Heslo uzivatele databaze */
define("DB_PASS","");


//// Nazvy tabulek v DB ////

/** Tabulka s pohadkami. */
define("TABLE_INTRODUCTION", "");
/** Tabulka s uzivateli. */
define("TABLE_USER", "");


//// Dostupne stranky webu ////

/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "app\Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "app\Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "app\Views";

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvod";

/** Dostupne webove stranky. */
const WEB_PAGES = array(
    //// Uvodni stranka ////
    "uvod" => array(
        "title" => "Úvodní stránka",

        //// kontroler
        "file_name" => "IntroductionController.class.php",
        "class_name" => "IntroductionController",
    ),
    //// KONEC: Uvodni stranka ////

    //// Sprava uzivatelu ////
    // TODO - doplnit spravu uzivatelu

    //// KONEC: Sprava uzivatelu ////
);

?>
