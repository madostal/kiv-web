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
const DIRECTORY_CONTROLLERS = "Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "Views";

/** Dostupne webove stranky. */
const WEB_PAGES = array(
    "uvod" => array("file_name" => "IntroductionController.class.php",
                    "class_name" => "IntroductionController",
                    "title" => "Úvodní stránka"),
    // TODO - doplnit spravu uzivatelu
);

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvod";

?>