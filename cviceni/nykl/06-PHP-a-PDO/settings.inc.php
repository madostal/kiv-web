<?php
////////////// Soubor obsahujici zakladni nastaveni /////////////

// databaze
    define("DB_SERVER","");
    define("DB_NAME","");
    define("DB_USER","");
    define("DB_PASS","");


// stranky webu (ostatni nebudou dostupne)
    $phpExtension = ".php"; // pripona

    define("WEB_PAGES", [
        'log' => "login".$phpExtension,
        'reg' => "user-registration".$phpExtension,
        'upd' => "user-update".$phpExtension,
        'mng' => "user-management".$phpExtension
    ]);

    define("WEB_PAGE_DEFAULT_KEY", 'log');

?>