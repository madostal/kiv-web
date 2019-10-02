<!doctype html>
<?php
/**
 * Vypise rekurzivne obsah promenne typu pole.
 *
 * @param array $vstup  Vstupni pole.
 * @return string
 */
function vypis($vstup){
    // hlavicka tabulky
    $text= "<table border><tr><td>key</td><td>value</td></tr>";
    // obsah tabulky
    foreach($vstup as $key => $value){
        $text .= "<tr><td>".$key."</td><td>";
        // bud jen vypis nebo rekurze
        $text .= (is_array($value)) ? vypis($value) : $value;
        $text .= "</td></tr>";
    }
    // ukonceni tabulky
    $text.= "</table>";
    return $text;
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Přijatá data z formuláře</title>
    </head>
    <body>
        <h1>Přijatá data z formuláře</h1>
        
        <div>
            <strong>Post:</strong><br>
            <?php
                // vypsani dat, ktera byla odeslana metodou POST
                echo vypis($_POST);
            ?>
        </div>
        
        <div>
            <strong>Get:</strong> <br>
            <?php
                // vypsani dat, ktera byla odeslana metodou GET
                echo vypis($_GET);
            ?>
        </div>
        
    </body>
</html>