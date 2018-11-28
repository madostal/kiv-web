<?php


class baseController {

    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function render($obsah, $pages = null) {

        // vypsat sablonu pres twig
        echo $this->twig->render("sablona1.htm", array("obsah" => $obsah, "pages" => $pages));
    }
}