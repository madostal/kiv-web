<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
for($i=0; $i<5; $i++) {
    echo "data: The server time is: {$time}\n\n";
    flush();
}

?>
