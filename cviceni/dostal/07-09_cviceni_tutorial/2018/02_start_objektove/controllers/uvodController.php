<?php


class uvodController extends baseController {

    public function indexAction($params) {

        $html = phpWrapperFromFile("controllers/uvod.php", $params);
        //echo $html;

        // chci dostat pages do render
        $pages = $params["pages"];

        //extract($params);
        //echo "a: $a, b: $b";


        // vypsat sablonu
        $this->render($html, $pages);
    }
}