<?php

class baseController {
    // musi byt protected, aby bylo viditelne i napr. do homeController
    protected $twig;
    protected $user;

    /**
     * baseController constructor.
     * @param $twig Twig_Environment
     */
    public function __construct($twig, $containerModelu)
    {
        $this->twig = $twig;

        // udelam pruchod containeru
        if ($containerModelu != null)
            foreach ($containerModelu as $nazev_modelu => $model)
            {
                //printr($nazev_modelu);

                // $this->user = $model; // $model = $user
                $this->$nazev_modelu = $model;
            }
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