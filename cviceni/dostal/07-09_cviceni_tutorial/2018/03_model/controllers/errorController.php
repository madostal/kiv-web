<?php


class errorController extends baseController {

    public function indexAction($params) {

        $html = phpWrapperFromFile("controllers/error.php", $params);
        //echo $html;

        // chci dostat pages do render
        $pages = $params["pages"];

        // vypsat sablonu
        $this->render($html, $pages);
    }
}