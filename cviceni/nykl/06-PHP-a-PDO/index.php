<?php 
// stranka s funkci rozcestniku

// nactu zakladni nastaveni
include("settings.inc.php");

// mam spravnou hodnotu na vstupu nebo nastavim default
if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
    $pageId = $_GET["page"]; // nastavim pozadovane
} else {
    $pageId = WEB_PAGE_DEFAULT_KEY; // default
}

// vypisu zvolenou stranku
include(WEB_PAGES[$pageId]);

?>