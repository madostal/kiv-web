<?php

//// Ukazka funkce, kterou lze vyuzit pro vlastni automatickou registraci trid,
//// tj. aby nemuselo byt stale opakovano require ci include.

// automaticka registrace pozadovanych trid
spl_autoload_register(function ($className){
    // zde by byl nacten prispusny soubor s danou tridou
    echo "Nacitam tridu: $className <br>";
    // TODO - samotne nacteni (require) prislusneho souboru
    exit;
});

// existujici trida - funkce autoload registrace nebude pouzita
$tmp = new ExistujiciTrida();
// neexistujici trida - bude pouzita vlastni funkce autoload registrace
$tmp = new NeexistujiciTrida();

/**
 * Class ExistujiciTrida
 */
class ExistujiciTrida {

    /**
     * ExistujiciTrida constructor.
     */
    public function __construct()
    {
        echo "Init: Existujici trida<br>";
    }
}

?>

