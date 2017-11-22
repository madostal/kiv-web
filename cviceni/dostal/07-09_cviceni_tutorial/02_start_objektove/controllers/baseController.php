<?php

class baseController {
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function indexAction($params) {
        return "missing indexAction method";
    }

    public function makeUrl() {
        return "tady bude URL";
    }

    public function render($obsah, $menu ="") {
        // pres twig
        echo $this->twig->render('sablona1.htm', array('obsah' => $obsah));

        // pres mini-sablonu, pokud twig nefungje
        /*
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
        */
    }
}