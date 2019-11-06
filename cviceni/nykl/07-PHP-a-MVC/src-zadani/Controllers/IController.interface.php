<?php

/**
 * Rozhrani pro vsechny ovladace (kontrolery).
 */
interface IController {

    /**
     * Zajisti vypsani prislusne stranky.
     *
     * @param string $pageTitle     Nazev stanky.
     * @return string               HTML prislusne stranky.
     */
    public function show(string $pageTitle):string;

}

?>