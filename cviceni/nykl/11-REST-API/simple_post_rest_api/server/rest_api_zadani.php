<?php

// Jednoduche REST API, ktere veskere akce provadi vyuzitim metody POST.
// Data jsou prijimana a odesilana jako plaintext JSON.
// Odpovedi pouzivaji HTTP status kody.
// Kazdy pozadavek obsahuje atribut 'action', ktery urcuje, jaka akce se ma provest.
// Akce jsou: get_config, save_value.
// Prichozi data musi obsahovat atributy 'mac', 'action'. Volitelne (pro save_value): 'datetime', 'dht_data'.

// URL REST API
// http://localhost/....../simple_post_rest_api/server/rest_api.php


// Dostupne akce
const ACTION_GET_CONFIG = "get_config";
const ACTION_SAVE_DHT_DATA = "save_dht_data";


// Povinne atributy v prijatych datech
const ATTR_MAC = "mac_address";
const ATTR_ACTION = "action";
// volitelne atributy
const ATTR_DATETIME = "datetime";
const ATTR_DHT_DATA = "dht_data";



/////////////////////////////////////////////////////////////////////////
/////////  Povoleni CORS (Cross-origin resource sharing)  /////////
/////////////////////////////////////////////////////////////////////////

/**
 * Povoleno CORS.
 * CORS (Cross-origin Resource Sharing) je v informatice mechanismus umožňující sdílení zdrojů
 * (např. fontů, JavaScriptového kódu, atd.) webové stránky pro aplikaci na jiné doméně.
 * Toto je zejména použito při AJAX požadavcích pomocí XMLHttpRequestu.
 * Mezi-doménové volání by jinak bylo zakázáno webovým prohlížečem kvůli omezení same-origin policy.
 * CORS definuje způsob, pomocí kterého se prohlížeč a dotazovaný server dohodnou na tom,
 * zda mezi-doménové volání bude povoleno.
 * Takto lze docílit sdílení zdrojů a zároveň zachovat bezpečnost aplikace.
 * Zdroj: wikipedia.org
 */
function sendCORSHeaders(){
    // Povoleni vsech zdroju pozadavku (nedoporuceno pro produkci!!)
    // lze omezit na povoleni pozadavku pouze z urcitych domen
    header("Access-Control-Allow-Origin: *");
    // Povolene HTTP metody pozadavku
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    // Povolene HTTP hlavicky pozadavku
    header("Access-Control-Allow-Headers: Content-Type");

    // Specialni "preflight OPTIONS request" byva nekdy posilan pred kazdym pozadavkem do API
    // Obvykle ho posila prohlizec.
    // Toto je pro nej spravna odpoved.
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // jak dlouho bude klient cachovat odpoved pro preflight OPTIONS request [86400s=24h]
        header("Access-Control-Max-Age: 86400");
        // vracim prazdny plain-text
        header("Content-Length: 0");
        header("Content-Type: text/plain");
        // koncim skript (pro preflight nebude nic dalsiho vypisovat)
        exit;
    }
    // rizeni cache pro ostatni metody
    else {
        // pokud neni specifikovano, tak pouzito defaultni nastaveni klienta
        // zadna cache
//        header('Cache-Control: no-cache');
        // zvolene trvani ulozeni cache u klienta [3600s=1h]
//        header( 'Cache-Control: public, max-age=3600' );
    }
}

/////////////////////////////////////////////////////////////////////////
/////////  KONEC: Povoleni CORS (Cross-origin resource sharing)  /////////
/////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////
//// Hlavni zpracovani pozadavku

// povoleni CORS
sendCORSHeaders();

// povoluji pouze pozadavky s metodou POST, jinak vratim chybu 405 Method Not Allowed
// TODO - pouzijte $_SERVER['REQUEST_METHOD']

//if(){
//    http_response_code(405); // Method Not Allowed
//    echo json_encode(array("error" => "Only POST method is allowed."));
//    exit();
//}


// Nacteni prijatych dat od klienta jako plaintext JSON, jinak vratim chybu 400 Bad Request
// TODO - pouzijte 'php://input' pro nacteni prijatych dat (raw HTTP request body stream) jako soubor

//$inputPlaintextJson =
//$input = json_decode($inputPlaintextJson, true); // prevod JSON na asociativni pole
//if(json_last_error() !== JSON_ERROR_NONE){
//    // chyba pri dekodovani JSON
//    http_response_code(400); // Bad Request
//    echo json_encode(array("status"=>"error", "message"=>"Invalid JSON format."));
//    exit();
//}


// Kontrola povinnych atributu ATTR_MAC a ATTR_ACTION, jinak vratim chybu 406 Not Acceptable
// TODO - zkontrolujte, zda jsou v prijatych datech nastaveny povinne atribut

//if(){
//    http_response_code(406); // Not Acceptable
//    echo json_encode(array("status"=>"error", "message"=>"Missing required attributes."));
//    exit();
//}


////////////////////////////////////////////////////////////////////////////////
/// Jednotlive akce Simple POST REST API

// ziskani hodnot povinnych atributu
$mac = $input[ATTR_MAC];
// akce je case-insensitive
$action = strtolower($input[ATTR_ACTION]);

/// akce Ziskani konfigurace
if($action === ACTION_GET_CONFIG){
    // ziskani konfigurace

    // TODO FUTURE - zde by nasledovalo nacteni konfigurace z databaze nebo jineho uloziste

    // pro ukazku vratim pevnou konfiguraci
    $config = array(
        "sampling_interval_sec" => 10,
        "threshold_temp_c" => 25.0,
        "threshold_humidity_percent" => 60.0
    );

    // odeslani odpovedi
    http_response_code(200); // OK
    echo json_encode(array("status"=>"success", "config"=>$config));
    exit();
}

/// akce Ulozeni hodnoty
elseif($action === ACTION_SAVE_DHT_DATA){
    // ulozeni hodnoty - pro ukazku pouze vypisi prijata data
    $datetime = isset($input[ATTR_DATETIME]) ? $input[ATTR_DATETIME] : null;
    $dht_data = isset($input[ATTR_DHT_DATA]) ? $input[ATTR_DHT_DATA] : null;


    // pokud nejsou data pro ulozeni, vratim chybu 422 Unprocessable Entity
    // TODO - doplnte kontrolu, zda jsou atributy datetime a dht_data nastaveny a vypiste chybu 422 Unprocessable Entity


    // TODO FUTURE - zde by nasledovalo ulozeni dat do databaze nebo jineho uloziste
    $tmpText = " ";
    foreach($dht_data as $key => $value){
        $tmpText .= "$key: $value; ";
    }

    // odeslani odpovedi
    $tmpMsgText = "Data received and processed.". $tmpText;

    // TODO - doplnte odeslani odpovedi s HTTP kodem 200 OK
    // TODO - data odpovedi maji klice 'status' a 'message'


    exit();
}

/// pokud akce neni znama, tak vratim chybu 400 Bad Request
else {
    http_response_code(400); // Bad Request
    echo json_encode(array("status"=>"error", "message"=>"Unknown action."));
    exit();
}
