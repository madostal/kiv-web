<doctype>
<head>
        <meta charset="utf-8" />
</head>
<body>
<?php

    if (isset($_GET["a"]))
        $a = $_GET["a"];

    if (isset($_GET["b"]))
        $b = $_GET["b"];

    if (isset($a) && isset($b)) {

        $c = $a + $b;
        echo "součet je: $c";
    }
    else {
        echo "Chybí proměnná a nebo b. Zkus odkaz:";
        echo "<a href=\"kalkulacka.php?a=5&b=3\">sečti 5 + 3</a>";
    }

?>
</body>
</html>

