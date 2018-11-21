<?php
    // vlastni funkce
    include "inc/functions.php";

    // nacteni parametru z URL
    if (isset($_REQUEST["page"])) {
        $page = $_REQUEST["page"];
    }
    else {
        $page = "uvod";
    }

    // struktura stranek
    $pages = array();
    $pages["uvod"] = "Úvod";
    $pages["kontakt"] = "Kontakt";

    // automaticka volba controlleru
    if (array_key_exists($page, $pages)) {
        $filename = "$page.php";
    }
    else $filename = "uvod.php";
    /*
    if ($page == "uvod")
        $filename = "uvod.php";
    else if ($page == "kontakt")
        $filename = "kontakt.php";
    */

    //include("controllers/$filename");
    $params = array();
    $params["a"] = 5;
    $params["b"] = 3;
    $params["page"] = $page;
    $obsah = phpWrapperFromFile("controllers/$filename", $params);

    require_once "vendor/autoload.php";
    $loader = new Twig_Loader_Filesystem("sablony");
    $twig = new Twig_Environment($loader, array());
    echo $twig->render("sablona1.htm", array("obsah" => $obsah, "pages" => $pages));
