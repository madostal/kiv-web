<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

    echo "pokus s DB <br/><br/>";

    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");
    include_once("inc/db_pdo.class.php");
    include_once("inc/predmety.class.php");

    $predmety = new predmety();
    $predmety->Connect();

    // odkaz na novy predmet
    $novy_predmet_url = "index.php?action=create_prepare";
    echo "<a href=\"$novy_predmet_url\">přidej předmět</a>";

    if (isset($_REQUEST["action"])) {
        $action = $_REQUEST["action"];
    }
    else {
        $action = "show_all";
    }

    if ($action == "create_prepare") {
        // zobrazit form
        echo "<h1>Formulář pro přidání předmětu</h1>";

        echo "<form method=\"post\">";
            echo "<input type='hidden' name='action' value='create_go'>";

            echo "Název předmětu: <input type=\"text\" name=\"nazev\">";
            echo "<input type=\"submit\" value=\"Přidej\">";
        echo "</form>";
    }
    else if ($action == "create_go") {
        // opravdu vytvorit
        echo "<h1>Vytvářím předmět</h1>";

        $item = array();
        $item["nazev"] = $_POST["nazev"];
        //printr($item);

        $ok = $predmety->InsertPredmet($item);
        if ($ok) {
            echo "OK: předmět vytvořen.";
        }
        else {
            echo "Chyba: nepovedlo se .";
        }
    }

    if ($action == "show_all") {
        // nactu predmety
        $data = $predmety->LoadAllPredmety();
        printr($data);
    }

?>
</body>
</html>
