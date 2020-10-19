<?php

/**
 * Vstupni bod webove aplikace.
 */
class ApplicationStart {

    /**
     * Inicializace webove aplikace.
     */
    public function __construct()
    {
        // nactu rozhrani kontroleru
        require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
    }

    /**
     * Spusteni webove aplikace.
     */
    public function appStart(){
        // TODO - spusteni cele aplikace
    }
}


?>

