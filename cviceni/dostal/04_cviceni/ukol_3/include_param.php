<doctype>
<head>
        <meta charset="utf-8" />
</head>
<body>
<?php
    // nazev souboru pro include vezmu z GET
    if (isset($_GET["include_filename"])) {
        $include_filename = $_GET["include_filename"];
    }
    else {
        // nazev souboru nemam
        $include_filename = "";
    }


    if ($include_filename == "")
    {
        echo "Není žádný parametr. <a href=\"include_param.php?include_filename=data\">Includni data</a>";
    }
    else {
        echo "Dostal jsem parametr z URL - GET: $include_filename <br/>";

        // cestu si vzdy musim kontrolovat sam a musim presne kontrolovat mozne vstupy
        // nikdy v parametru nesmim predavat cestu
        if ($include_filename == "data")
        {
            echo "Obsah includovaneho souboru: <hr/>";
            include_once("data.inc.php");
            echo "<hr/>";
        }

    }
?>
</body>
</html>
