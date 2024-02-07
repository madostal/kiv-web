<?php
// nastaveni Streamu dat pro SSE - kontinualni text
header('Content-Type: text/event-stream');
// bez cache
header('Cache-Control: no-cache');
// obvykle chceme omezit "overhead" zpusobeny opakovanym zakladanim a rusenim spojeni kvuli mnoha HTTP pozadavkum
header('Connection: keep-alive');


// postupny vypis dat
for($i=0; $i<10; $i++) {

    $time = date('r');
    echo "data: Datum na serveru je: '$time'\n\n";

    ob_flush();
    flush();

    sleep(1);
}

?>
