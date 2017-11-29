<?php
    //echo "Ahoj Tutorál <br/>";

    // šablona přes twig
    // nacist Twig pres autoloader - pokud nainstalovano pres Composer
    require_once 'vendor/autoload.php';
    $loader = new Twig_Loader_Filesystem('sablony');
    $twig = new Twig_Environment($loader, array());
    // presun volani render do Controlleru metody render
    //echo $twig->render('sablona1.htm', array('obsah' => $obsah));

    // include souboru s funkcemi
    include_once("inc/functions.php");

    // nacist konfiguraci
    include_once("inc/settings.php");

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
    $pages["error"] = "Error 404";

    // pokud stranka neni povolena, vrat 404 controller
    if (!array_key_exists($page, $pages)) {
        $page = "error";
    }

    // include stranky s obsahem
    if (array_key_exists($page, $pages)) {
        // provede include a vysledek vrati do promenne obsah
        $params = array();
        $params["a"] = 5;
        $params["b"] = 3;
        //$obsah = phpWrapperFromFile("controllers/$page.php", $params);

        // nactu vsechny objekty modelu, ktere budu potrebovat
        include_once ("models/baseModel.php");
        include_once ("models/userModel.php");

        // vytvorim pouze model pro uzivatele
        $user = new userModel();
        $user->Connect(); // pripoji k DB

        // pridat modely do containeru
        $containerModelu = array();
        $containerModelu["user"] = $user;

        // otestovani pristupu k DB
        //$uzivatele = $user->DBSelectAll("uzivatele", "*", "");
        //printr($uzivatele);

        // include primo do stranky = string homeController
        include_once("controllers/baseController.php");
        $objekt = $page."Controller";
        include("controllers/$objekt.php");

        // vytvorim napr. $homeController a poslu twig jako zavislost
        $$objekt = new $objekt($twig, $containerModelu);
        $$objekt->indexAction($params); // vypise vystup
    }


