<?php


class uvodController extends baseController {

    public function indexAction($params) {
        // chci dostat pages do render
        $pages = $params["pages"];

        //extract($params);
        //echo "a: $a, b: $b";

        // nacist vsechny uzivatele
        $uzivatele = $this->user->LoadAllUsers();

        $params["uzivatele"] = $uzivatele;

        $html = phpWrapperFromFile("controllers/uvod.php", $params);
        //echo $html;

        // vypsat sablonu
        $this->render($html, $pages);
    }
}