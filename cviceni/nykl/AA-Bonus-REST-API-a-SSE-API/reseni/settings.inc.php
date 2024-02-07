<?php

// vynuceni vypisu chyb
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// POZOR: synchronizace casu v PHP s casem v databazi
date_default_timezone_set('Europe/Prague');

/////////////////////////////////////////////////////////////////////////
////////  Konfigurace serveru a DB  /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

// nazvy nekterych tabulek v DB
define("TABLE_ZAZNAM", "zaznam");
define("TABLE_UDALOST", "udalost");

//// dle soucasneho serveru zvolim konfiguraci
$serverName = $_SERVER['SERVER_NAME'];
//echo "SERVER NAME: ".$serverName;

// casti URL predstavujici REST API, obecne REST API a SSE API.
$urlPartRestAPI = "rest_api";
$urlPartObecneRestAPI = "obecne_rest_api";
$urlPartSseAPI = "sse_api.php";

// je server localhost? (nebo z Android emulatoru je 10.0.2.2)
if($serverName == "localhost" || $serverName == "10.0.2.2"){
    // DEV - pro lokalni vyvoj
//    $restApiURLPrefix = "/+MOJE_WEBY/++REST_API_zaklad/REST_API_php_vlastni/rest_api/";
    // /aktualni_priklad/rest_api/
    $url = "/++Brackets-kiv-web/AA-Bonus-REST-API-a-SSE-API/reseni/";
    $dbSettings = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'obecne_rest_api'
    ];
}
else {
    // PRODUKCE - pro server -
    // TODO - spravny nazev na serveru!!
    $url = "/++Brackets-kiv-web/AA-Bonus-REST-API-a-SSE-API/reseni/";
    $dbSettings = [
        'host' => 'localhost',
        'username' => '',
        'password' => '',
        'database' => ''
    ];
}
// slozim URL
$restApiURLPrefix = $url . $urlPartRestAPI ."/";
$obecneRestApiURLPrefix = $url . $urlPartObecneRestAPI ."/";
$sseApiURLPrefix = $url . $urlPartSseAPI ."/";

// REST API - Cast URL od konce nazvu domeny po endpoint. (bez endpointu)
define("REST_API_URL_PREFIX", $restApiURLPrefix);
// obecne REST API - Cast URL od konce nazvu domeny po endpoint. (bez endpointu)
define("OBECNE_REST_API_URL_PREFIX", $obecneRestApiURLPrefix);
// SSE API - Cast URL od konce nazvu domeny po endpoint. (bez endpointu)
define("SSE_API_URL_PREFIX", $sseApiURLPrefix);

// Nastaveni pro pripojeni k databazi
define("DATABASE_SETTINGS", $dbSettings);


/////////  Konfigurace pro SSE API  //////////////////

// SSE odpoved je kontinualni, dokud nevyprsi max. doba behu skriptu (maximum execution time)
// pokud je povoleno, tak nastavim max_exec_time (pokud konstanta neexistuje, tak defaultni ze serveru) [s]
// debug: 10, deploy: 60 TODO .....
define("SSE_API_MAX_EXEC_TIME_SEC", 10);
// jak dlouho SSE spi mezi posilanim updatu uzivateli [s]
// debug: 2, deploy: 1
define("SSE_API_AFTER_SEND_SLEEP_TIME_SEC", 1);

// klient muze umoznovat nastaveni sveho timeoutu pro re-connect [s]
// bude posilano v hlavicce (prvni) SSE odpovedi serveru
define("SSE_CLIENT_RETRY_SEC", 5);

/////////////////////////////////////////////////////////////////////////
////////  KONEC: Konfigurace serveru a DB  /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
////////  Konfigurace obecne casti REST API  ////////////////////////////
/////////////////////////////////////////////////////////////////////////

// specialni endpoint pro vypis informaci o REST API (bude novym edpointem)
define("ENDPOINT_INFO", "info");
// specialni endpoint pro zaznam (bude vyuzito pro prekryti casti obecneho REST API a pro SSE API)
define("ENDPOINT_ZAZNAM", "zaznam");
// specialni endpoint pro udalost (bude vyuzito pro SSE API)
define("ENDPOINT_UDALOST", "udalost");


//// Nastaveni pro obecne REST API.
// predpona tabulek v DB
$tmpDBTablesPrefix = "";
// Nastaveni jednotlivych endpointu obecneho REST API.
// POZOR: Nastaveni skutecne ovlivni chovani poskytovane obecne casti REST API.
// Kazda tabulka v DB muze mit sve nastaveni pro zprostredkovani CRUD pres obecne REST API.
// Polozka nastaveni:
//[
//    "endpoint" => "zaznam",       // v URL
//    "table" => "zaznam",          // v DB
//    "pk_column" => "unique_code", // sloupec primarniho klice v DB
//    "search_columns" => ["nazev", "poloha"],  // povolene GET parametry hledani pro READ
//    "GET" => true, "POST" => true, "PUT" => true, "DELETE" => true,  // povoleni CRUD
//]
$tmpApiEndpointsSettings = [
    [
        "endpoint" => "role",
        "table" => "role",
        "pk_column" => "id",
        "GET" => true, "POST" => true, "PUT" => true, "DELETE" => true,
    ],
    [
        "endpoint" => "uzivatel",
        "table" => "uzivatel",
        "pk_column" => "id",
        "GET" => true, "POST" => true, "PUT" => true, "DELETE" => true,
    ],
    [
        "endpoint" => "hw_zarizeni",
        "table" => "hw_zarizeni",
        "pk_column" => "unique_code",
        "GET" => true, "POST" => true, "PUT" => true, "DELETE" => true,
    ],
    [
        "endpoint" => ENDPOINT_ZAZNAM,
        "table" => "zaznam",
        "pk_column" => "id",
        "search_columns" => ["nazev"],
        // GET bude prepsano vlastni casti REST API
        "GET" => false, "POST" => true, "PUT" => true, "DELETE" => false,
    ],
    [
        "endpoint" => ENDPOINT_UDALOST,
        "table" => "udalost",
        "pk_column" => "id",
        "GET" => true, "POST" => true, "PUT" => false, "DELETE" => false,
    ],
];
// pokud je, tak pridam tabulkam predponu
if(!empty($tmpDBTablesPrefix)){
    foreach($tmpApiEndpointsSettings as $key=>$sett){
        $sett[$key]['table'] = $tmpDBTablesPrefix . $sett[$key]['table'];
    }
}
// ulozim nastaveni REST API do konstanty
define("REST_API_ENDPOINTS_SETTINGS", $tmpApiEndpointsSettings);


///////////////////////////////////////////////////

//// Vlastni implementace nekterych endpointu ci metod
//// - toto je pouze!! pro vypis informaci o doplnene casti REST API.
// POZOR: Musi spravne popisovat, presne chovani REST API. (nikterak chovani neovlivnuje)
// Polozka obsahuje pouze platne/true hodnoty (neplatne jsou vynechany):
//[
//    "endpoint" => "zaznam",       // v URL
//    "search_columns" => ["nazev", "poloha"],  // GET parametry hledani pro READ
//    "GET" => true, "POST" => true, "PUT" => true, "DELETE" => true,  // povoleni CRUD
//]
$tmpOwnEndpointsInfo = [
    //// Prekriti casti obecneho REST API
    [
        "endpoint" => ENDPOINT_ZAZNAM,
        "search_columns" => ["uc_hw_zarizeni", "nazev", "poloha"],
        "GET" => true, "DELETE" => true
    ],
    [
        "endpoint" => ENDPOINT_ZAZNAM ."/PK/mnozstvi/",
        "PUT" => true
    ],
    //// Zcela vlastni endpointy
    [
        "endpoint" => ENDPOINT_INFO,
        "GET" => true
    ]
];
// ulozim do konstanty
define("REST_API_OWN_ENDPOINTS_INFO", $tmpOwnEndpointsInfo);

/////////////////////////////////////////////////////////////////////////
////////  KONEC: Konfigurace obecne casti REST API  ////////////////////////////
/////////////////////////////////////////////////////////////////////////

