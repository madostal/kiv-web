<?php

class kontaktController extends baseController{

    /**
     * @param $params array - vstupní parametry
     * @return string - output html
     */
    public function indexAction($params) {
        // puvodne
        // extract($params);
        //return "Homepage - a: $a, b: $b";

        // html si nactu z nejake mini-sablony
        $html = "Kontakt ahoj";
        //return $html;

        // vypis cele stranky
        $this->render($html);
    }
}