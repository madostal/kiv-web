<doctype>
<head>
    <meta charset="utf-8" />
</head>
<body>
<?php

    echo "Hello world!";

    echo "<h1>Cykly</h1>";

    // for
    echo "<h2>Cyklus FOR</h2>";
    for ($i = 1; $i <= 10; $i ++)
    {
        echo "$i <br/>";
    }

    // foreach
    echo "<h2>Foreach</h2>";

    $pole = array("pneumatika", "výfuk", "čelní sklo");

    foreach ($pole as $item) {
        echo $item."<br/>";
    }

?>
</body>
</html>
