<?php

// Pokud jakykoliv klient (browser, zarizeni) zavola tento skript,
// tak ziska nasledujici data vypsana do stranky jako plaintext JSON.

// slozim odpoved
$ar = array('status'=>123, "pokus"=>"hodnota1");

// vypisu jako JSON - funguje i bez hlavicky udavajici typ obsahu
//header('Content-Type: application/json');
echo json_encode($ar);

?>
