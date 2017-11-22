<?php

class baseController {

    public function indexAction($params) {
        return "missing indexAction method";
    }

    public function makeUrl() {
        return "tady bude URL";
    }

    public function render($obsah, $menu ="") {
        /*
        // pres twig
        $loader = new Twig_Loader_Filesystem('sablony');
        $twig = new Twig_Environment($loader, array());
        echo $twig->render('sablona1.htm', array('obsah' => $obsah));
        */

        // minišablona
        echo "<!DOCTYPE html>
        <html>
        <head>
           <meta charset=\"UTF-8\">
        </head>
        <body>";
        echo "Menu: $menu";
        echo "<h1>Start šablony</h1>";

        echo $obsah;

        echo "<div>Patička</div>";

        echo "
        </body></html>";
    }
}