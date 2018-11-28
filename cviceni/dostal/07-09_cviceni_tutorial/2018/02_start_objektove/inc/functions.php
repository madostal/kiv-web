<?php
/**
 * Deklarace funkci
 */

    /**
     * Zpracuje php soubor a vysledek vrati do stringu.
     *
     * @param $filename
     * @param array $params
     * @return string
     */
    function phpWrapperFromFile($filename, $params = array())
    {
        // z pole mi udela promenne
        extract($params);

        ob_start();

        if (file_exists($filename) && !is_dir($filename))
        {
            include($filename);
        }
        else {
            echo "Požadovaný soubor neexistuje!!! $filename";
        }

        // nacte to z outputu
        $obsah = ob_get_clean();
        return $obsah;
    }

    function printr($array) {
        echo "<hr/><pre>";
        print_r($array);
        echo "</pre><hr/>";
    }