<?php


class kontaktController extends baseController {

    public function indexAction($params) {

        $html = phpWrapperFromFile("controllers/kontakt.php", $params);
        //echo $html;

        // chci dostat pages do render
        $pages = $params["pages"];

        // vypsat sablonu
        $this->render($html, $pages);
    }
}