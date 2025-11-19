<?php
// FullREST API bez pouziti .htaccess souboru.
// Zpracovava URL adresy, ktere vypadaji nasledovne:
// https://localhost/.../fullrest_api_example/fullrest_api.php/endpoint/


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
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
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

// primo povolim CORS
sendCORSHeaders();

/////////////////////////////////////////////////////////////////////////
/////////  KONEC: Povoleni CORS (Cross-origin resource sharing)  /////////
/////////////////////////////////////////////////////////////////////////


// TODO - studenti - doplne celou spodni cast
// TODO - vyuzijte $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'] a $_SERVER['SCRIPT_NAME']






// defaultni odpoved bude s HTTP statusem 200 OK
// vypisu jenom testovaci zpravu s prijatymi daty
http_response_code(200);
echo json_encode(
    array(
        "msg" => "FullREST API without .htaccess working!",
        "method" => $method,
        "uri" => $uri,
        "path_parts" => $pathParts,
        "endpoint" => $endpoint,
        "resource_id" => $resourceId,
        "input_data" => $inputData,
    )
);

