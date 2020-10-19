<?php
//////////////////////////////////////////////////////////////
////////////// HTML Zaklad vsech stranek webu ////////////////
//////////////////////////////////////////////////////////////

/**
 * Trida pro vypis hlavicky a paticky HTML stranky.
 */
class ZakladHTML {

    /**
     *  Vytvoreni hlavicky stranky.
     *  @param string $title Nazev stranky.
     */
    public static function createHeader($title=""){
        ?>
        <!doctype html>
        <html lang="cs">
            <head>
                <meta charset="utf-8">
                <title><?= $title ?></title>
                <style>
                    body { background-color: orange; }
                    h1 { text-align: center; }
                    nav { background-color: darkblue; margin-bottom: 10px; padding: 15px; color:lightgray; text-align: center; }
                    nav a { color: aliceblue; padding: 5px; }
                    footer { background-color: lightgrey; margin-top: 30px; text-align: center; padding: 15px; }
                </style>
            </head>
            <body>
                <div class="content">
                    <h1><?= $title ?></h1>
                    <nav>Menu:
                        <a href="index.php?page=login">Login/Logout</a> |
                        <a href="index.php?page=registrace">Registrace</a> |
                        <a href="index.php?page=uprava">Sprava osobních údajů</a> |
                        <a href="index.php?page=management">Sprava uživatelů</a>
                    </nav>
                    <div>
        <?php
    }

    /**
     *  Vytvoreni paticky.
     */
    public static function createFooter(){
        ?>
                    </div>
                </div>
                <footer>
                    &copy; <?= date("Y-m-d") ?> KIV/WEB
                </footer>
            </body>
        </html>
        <?php
    }

}
?>
