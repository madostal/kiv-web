<?php
// soubor obsahujici zakladni nastaveni

global $db_server, $db_name, $db_user, $db_pass;
global $web_pagesExtension, $web_pages;

// databaze
    $db_server = "";
    $db_name = "";
    $db_user = "";
    $db_pass = "";
    

// stranky webu (ostatni nebudou dostupne)
    $web_pagesExtension = ".php";
    $web_pages[0] = "login";
    $web_pages[1] = "user-registration";
    $web_pages[2] = "user-update";
    $web_pages[3] = "user-management";


?>