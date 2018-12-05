<?php


class baseController {

    // musi byt protected, aby bylo viditelne i do homeControlleru
    protected $twig;

    /**
     * @var userModel
     */
    protected $user;

    public function __construct($twig, $containerModelu)
    {
        $this->twig = $twig;

        //echo "_construct baseController";
        //printr($containerModelu);

        if ($containerModelu != null)
            foreach ($containerModelu as $nazev_modelu => $model) {
                $this->$nazev_modelu = $model;
            }
    }

    public function indexAction($params) {
        return "missing indexAction method";
    }

    /**
     * TODO metoda pro generovani URL na webu
     */
    public function makeUrl() {

    }

    public function render($obsah, $pages = null) {

        // vypsat sablonu pres twig
        echo $this->twig->render("sablona1.htm", array("obsah" => $obsah, "pages" => $pages));
    }
}