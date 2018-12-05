<?php
    require_once "vendor/autoload.php";
    $loader = new Twig_Loader_Filesystem("sablony");
    $twig = new Twig_Environment($loader, array());
    // presun do volani render do Controlleru
    //echo $twig->render("sablona1.htm", array("obsah" => $obsah, "pages" => $pages));

    // vlastni funkce
    include "inc/functions.php";

    // konfiguracni soubor
    include "inc/settings.php";

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
    $pages["error"] = "404 stránka nenalezena"; // nazev objektu nesmi zacinat cislem


    //include("controllers/$filename");
    $params = array();
    $params["a"] = 5;
    $params["b"] = 3;
    $params["page"] = $page;
    $params["pages"] = $pages;

    // baseModel
    include_once "models/baseModel.php";
    include_once "models/userModel.php";


    // vytvorim model pro uzivatele
    $user = new userModel();
    $user->Connect();

    // modely do containeru
    $containerModelu = array();
    $containerModelu["user"] = $user;

    //$obsah = phpWrapperFromFile("controllers/$filename", $params);

    // include zakladniho controleru
    include_once("controllers/baseController.php");

    // slozeni jmena controlleru
    // automaticka volba controlleru
    if (array_key_exists($page, $pages)) {
        $ctrl_name = $page."Controller";
    }
    else {
        $ctrl_name = "errorController";
    }

    // include meho controlleru
    $filename_ctrl = "controllers/$ctrl_name.php";

    if (file_exists($filename_ctrl) && !is_dir($filename_ctrl)){
        include_once($filename_ctrl);

        //printr($containerModelu);

        //echo "mam controller, ale nic nedelam";
        // = napr. $uvodController = new uvodController($twig);
        $$ctrl_name = new $ctrl_name($twig, $containerModelu);
        $$ctrl_name->indexAction($params);
    }
    else {
        echo "Chyba: controller jmeno: $ctrl_name, $filename_ctrl NENALEZEN!!!";
    }


