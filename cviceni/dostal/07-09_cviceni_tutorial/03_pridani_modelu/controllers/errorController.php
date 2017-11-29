<?php

class errorController extends baseController
{

    /**
     * @return string - output html
     */
    public function indexAction($params)
    {
        // bud primo
        //echo "404";

        // nebo
        $this->render("404");
    }

}