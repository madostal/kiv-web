<?php

/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class TemplateBasics {

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     */
    public function getHTMLHeader(string $pageTitle) {
        ?>

        <!doctype html>
        <html>
            <head>
                <meta charset='utf-8'>
                <title><?php echo $pageTitle; ?></title>
                <style>
                    nav { background-color:orange; padding:10px; }
                    nav a { margin: 0px 10px; }
                    footer { padding: 10px; background-color: lightgrey; text-align: center; }
                    .alert { padding: 10px; background-color: lightblue; font-weight: bold; margin-bottom: 20px; border-radius: 10px; }
                </style>
            </head>
            <body>
                <h1>Template: <?php echo $pageTitle; ?></h1>

                <nav>
                    <?php
                        // TODO - vypis menu

                    ?>
                </nav>
                <br>
        <?php
    }
    
    /**
     *  Vrati paticku stranky.
     */
    public function getHTMLFooter(){
        ?>
                <br>
                <footer>Cvičení z KIV/WEB</footer>
            <body>
        </html>

        <?php
    }
        
}

?>