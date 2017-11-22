<?php
    //echo "Ahoj Tutorál <br/>";

    // šablona přes twig
    // nacist Twig pres autoloader - pokud nainstalovano pres Composer
    require_once 'vendor/autoload.php';
    // presun do render

    // include souboru s funkcemi
    include_once("inc/functions.php");

    // nacteni parametru page
    if (isset($_REQUEST["page"]))
        $page = $_REQUEST["page"];
    else
        $page = "home";

    // testovaci vypis
    //echo "page: $page <br/>";

    // pages - povolene stranky
    $pages = array();
    $pages["home"] = "Homepage";
    $pages["kontakt"] = "Kontakt";


    // include stranky s obsahem
    if (array_key_exists($page, $pages)) {
        // provede include a vysledek vrati do promenne obsah
        $params = array();
        $params["a"] = 5;
        $params["b"] = 3;
        //$obsah = phpWrapperFromFile("controllers/$page.php", $params);

        // include primo do stranky = string homeController
        include_once("controllers/baseController.php");
        $objekt = $page."Controller";
        include("controllers/$objekt.php");

        // vytvorim napr. $homeController
        $$objekt = new $objekt;
        $$objekt->indexAction($params); // vypise vystup
    }


