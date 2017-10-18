<?php
    // mam k dispozici promennou a v POST?
    if (isset($_POST["a"]))
        $a = $_POST["a"];       // ANO, pouziju
    else
        $a = 1;                 // NE, nastavim defaultni hodnotu

    if (isset($_POST["b"]))
        $b = $_POST["b"];
    else
        $b = 2;

    if (isset($a) && isset($b))
    {
        $c = $a + $b;
        echo "Soucet $a + $b = $c <br/>";
    }
?>

<!-- formular pro odeslani hodnot promennych a a b-->
<form method="post" action="c_post.php">
    A: <input type="text" name="a" value="1" />
    B: <input type="text" name="b" value="2" />
    <input type="submit" value="secti"/>
</form>
