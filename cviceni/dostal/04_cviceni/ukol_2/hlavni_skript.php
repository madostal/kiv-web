<doctype>
<head>
    <meta charset="utf-8" />
</head>
<body>
<?php

    echo "<h1>Ukázka include - hlavni skript:</h1>";

    $a = 10;
    $b = 5;

    // vlozim soubor a provedu skript
    include ("vlozeny_skript.php");

    // vypis hodnoty, kterou jsem spocital ve vlozenem skriptu
    echo "Hodnota c je: $c";

?>
</body>
</html>