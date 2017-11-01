<?php
    //echo "Ahoj Tutorál <br/>";

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

        // include primo do stranky
        //include("controllers/$page.php");

        // provede include a vysledek vrati do promenne obsah
        $params = array();
        $params["a"] = 5;
        $params["b"] = 3;
        $obsah = phpWrapperFromFile("controllers/$page.php", $params);
    }

    // šablona přes twig
    // nacist Twig pres autoloader - pokud nainstalovano pres Composer
    require_once 'vendor/autoload.php';
    $loader = new Twig_Loader_Filesystem('sablony');
    $twig = new Twig_Environment($loader, array());
    echo $twig->render('sablona1.htm', array('obsah' => $obsah));

    // minišablona
    /*
    echo "<!DOCTYPE html>
    <html>
    <head>
       <meta charset=\"UTF-8\">
    </head>
    <body>";
    echo "<h1>Start šablony</h1>";

    echo $obsah;

    echo "<div>Patička</div>";

    echo "
    </body></html>";
    */