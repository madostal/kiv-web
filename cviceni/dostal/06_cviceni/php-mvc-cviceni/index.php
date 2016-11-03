<?php

    // funkce by mela byt idealne v samostatnem souboru spolu s dalsimi fcemi
    function phpWrapperFromFile($filename)
    {
        ob_start();

        if (file_exists($filename) && !is_dir($filename))
        {
            include($filename);
        }

        // nacte to z outputu
        $obsah = ob_get_clean();
        return $obsah;
    }


    // parametr stranky
    $page = @$_REQUEST["page"];
    $subpage = @$_REQUEST["subpage"];

    // default je uvod
    if ($page == "")
        $page = "uvod";

    // echo "page je: $page ";

    // volba obsahu dle parametru = volba skriptu, ktery zpracuje stranku
    if ($page == "uvod")
        $filename = "obsah/uvod.inc.php";
    else if ($page == "kontakt")
        $filename = "obsah/kontakt.inc.php";
    else
        $filename = "obsah/404.inc.php";

    // dalsi moznost - vzdy musim kontrolovat vstup a sam skladat URL k souboru pro include
    //if (in_array($page, array("uvod", "kontakt")))
    //    $filename = "obsah/$page.inc.php";

    // nactu obsah
    //echo "filenme: $filename";
    //$obsah = file_get_contents($filename);
    $obsah = phpWrapperFromFile($filename);
    //echo $obsah;

    // pages - pro navigaci
    $pages = array();
    $pages["uvod"] = "Úvod";
    $pages["kontakt"] = "Kontakt";

    // menu
    $menu = "";
    $menu .= "<ul>";

        if ($pages != null)
            foreach ($pages as $key => $title)
            {
                if ($page == $key) $active_pom = "class='active'";
                else $active_pom = "";

                $menu .= "<li $active_pom><a href='index.php?page=$key'>$title</a></li>";
            }
    $menu .= "</ul>";

    // nacist twig - kopie z dokumentace
    require_once 'twig-master/lib/Twig/Autoloader.php';
    Twig_Autoloader::register();

    // cesta k adresari se sablonama - od index.php
    $loader = new Twig_Loader_Filesystem('sablony');
    $twig = new Twig_Environment($loader); // takhle je to bez cache

    // nacist danou sablonu z adresare
    $template = $twig->loadTemplate('sablona1.htm');

    // render vrati data pro vypis nebo display je vypise
    // v poli jsou data pro vlozeni do sablony
    $template_params = array();
    $template_params["menu"] = $menu;
    $template_params["obsah"] = $obsah;
    $template_params["nadpis1"] = "Nadpis stránky";
    echo $template->render($template_params);