<?php

// pripojim nastaveni
require_once("settings.inc.php");

/** Dostupne typy odpovedi serveru. */
class RESPONSE_TYPE {
    const TEXT = 1;
    const JSON = 2;
}

/**
 * HTTP status odpovedi serveru.
 * Hodnoty number odpovidaji specifikaci.
 */
class RESPONSE_STATUS {
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
    // https://en.wikipedia.org/wiki/List_of_HTTP_status_codes

    // oznameni uspechu
    const R_200 = ["number" => 200, "text" => "OK"];
    const R_201 = ["number" => 201, "text" => "CREATED"];

    // oznameni klientovy chyby (spatna data, URL apod.)
    const R_404 = ["number" => 404, "text" => "NOT FOUND"];
    const R_405 = ["number" => 405, "text" => "METHOD NOT ALLOWED"];
    const R_406 = ["number" => 406, "text" => "Not Acceptable"];
    const R_422 = ["number" => 422, "text" => "Unprocessable Entity"];
}

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

/////////////////////////////////////////////////////////////////////////
/////////  KONEC: Povoleni CORS (Cross-origin resource sharing)  /////////
/////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
/////////  Odesilani odpovedi klientovi (klasicky pro REST API)  /////////
/////////////////////////////////////////////////////////////////////////

/**
 * Odesle odpoved ze serveru klientovi (klasicky pro REST API).
 * @param array|string $data    Pole dat. (def.=[])
 * @param int $type     Typ odpovedi. (def.=RESPONSE_TYPE::TEXT)
 * @param array $status Status odpovedi. (def.=RESPONSE_STATUS::R_200)
 */
function sendResponse($data, $type = RESPONSE_TYPE::TEXT, $status=RESPONSE_STATUS::R_200){

    //// doplneni hlavicky odpovedi
    // typ dat odpovedi
    if(RESPONSE_TYPE::JSON) {
        header("Content-Type: application/json");
    }
    // defaltne text
    else{
        header("Content-Type: text/plain");
    }

    // HTTP status odpovedi
    header("HTTP/1.1 ". $status['number'] ." ". $status["text"]);

    //// vypis dat dle typu
    // mam data a typ JSON?
    if (!empty($data) && $type == RESPONSE_TYPE::JSON) {
        echo json_encode($data);
    }
    // typ JSON, ale nemam data?
    else if($type == RESPONSE_TYPE::JSON){
        echo "{}";
    }
    // defaultne jsou data text
    else {
        echo $data;
    }

}

/////////////////////////////////////////////////////////////////////////
/////////  KONEC: Odesilani odpovedi klientovi (klasicky pro REST API)  /////////
/////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
/////////  SSE komunikace  ////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

/**
 * Inicializace SSE odpovedi.
 */
function sseInit(){
    // povoleni Cross-Origin requests
    // "*" nahradit povolenymi URL adresami klientu
    header("Access-Control-Allow-Origin: *");
    // Povolene HTTP metody pozadavku
    header("Access-Control-Allow-Methods: GET, OPTIONS");

    // Specialni "preflight OPTIONS request" byva nekdy posilan pred kazdym pozadavkem do API
    // Obvykle ho posila prohlizec.
    // Toto je pro nej spravna odpoved.
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // jak dlouho bude klient cachovat odpoved pro preflight OPTIONS request [86400s=24h]
        header("Access-Control-Max-Age: 86400");
        // vracim prazdny plain-text
        header("Content-Length: 0");
        header("Content-Type: text/event-stream ");
        // koncim skript (pro preflight nebude nic dalsiho vypisovat)
        exit;
    }

    // nastaveni Streamu dat pro SSE - kontinualni text
    header('Content-Type: text/event-stream');
    // bez cache
    header('Cache-Control: no-cache');
    // obvykle chceme omezit "overhead" zpusobeny opakovanym zakladanim a rusenim spojeni kvuli mnoha HTTP pozadavkum
    header('Connection: keep-alive');


    // pokud to klient umoznuje, tak po vypadku spojeni provede re-connect.
    // napr. po vyprseni "max. execution time" (viz php.ini).
    // pokud navic klient umoznuje serveru rici, za jak dlouho se ma opet pripojit,
    // tak se to standardne provede nasledujicim vypisem [ms]
    // echo "retry: 1000\n\n";

    // re-connect provede za dany pocet ms (s *1000)
    $tmpSec = SSE_CLIENT_RETRY_SEC * 1000;
    echo "retry: $tmpSec\n\n";

    // odeslu okamzite
    ob_flush();
    flush();
}

/**
 * Odesle SSE data klientovi (okamzite).
 * @param array|string $data    Data k odeslani
 * @param RESPONSE_TYPE $type   Typ dat. (def.=RESPONSE_TYPE::TEXT)
 */
function sseSendData($data, $type = RESPONSE_TYPE::TEXT, $eventType="message"){
    // pokud je typ JSON, tak prevedu pole na string,
    // jinak prepokladam string a primo data pouziju
    $strData = ($type == RESPONSE_TYPE::JSON) ? json_encode($data) : $data;

    // takto jsou SSE data odesilana klientovi,
    // tj. na radku zacinajicim "data:" a koncicim "\n\n":
    // echo "data: {'items':[]}\n\n"; <-- dve \n

    // pokud maji byt data poslana jako specialni event (defaultni je "message"; neuvadet),
    // tak je vypsan pred daty takto:
    // echo "event: vlastni_nazev_eventu\n";  <-- jedno \n
    // echo "data: {'items':[]}\n\n"; <-- dve \n

    // mam jiny event, nez defaultni?
    if($eventType !== "message"){
        // vypisu event
        echo "event: ". $eventType ."\n";
    }

    // vypisu data
    echo "data: " . $strData . "\n\n";

    // odeslu okamzite
    ob_flush();
    flush();
}

/////////////////////////////////////////////////////////////////////////
/////////  KONEC: SSE komunikace  //////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
/////////  Prace s URL a API  //////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

/**
 * Ziska endpoint z URL adresy, tj. za nazvem API.
 * URL: /ENDPOINT/param1/param2/../
 * @param string $urlPrefix  Cast URL pred endpointem (obvykle dano konfiguraci).
 * @return string|bool       Bud nazev endpointu z URL, nebo false.
 */
function getEndpointFromFriendlyURL(string $urlPrefix){
    // ziskam kompletni REQUEST_URI a odstranim pripadnou cast s GET parametry
    // pozn.: REQUEST_URI je cast za nazvem domeny, napr.: /rest_api/endpoint/?a=b
    $currentURL = explode("?", $_SERVER["REQUEST_URI"])[0];

    // URL musi na dany prefix zacinat
    if(startsWith($currentURL,$urlPrefix)){
        // odstranim prefix z URL
        $sufix = str_replace($urlPrefix, "", $currentURL);
        // rozdelim dle lomitek a vratim prvni v poli
        return explode("/", $sufix)[0];
    }
    return false;
}

/**
 * Nacte parametry z URL adresy, tj. za danym endpointem.
 * URL: /ENDPOINT/param1/param2/../
 * @param string $endpoint  Nazev endpointu v URL.
 * @return array|bool       Bud pole parametru z URL, nebo false.
 */
function getParametersFromFriendlyURL($endpoint){
    // ziskam kompletni URI a odstranim pripadnou cast s GET parametry
    $currentURL = explode("?", $_SERVER["REQUEST_URI"])[0];
    // je v URL pritom endpoint? - beru jen jako to, co zbylo v URL
    $tmpSep = "/". $endpoint ."/";
    $parts = explode($tmpSep, $currentURL);

    // prvni v poli je cast pred endpointem, a zbytek pripadne parametry oddelene "/"
    if(count($parts) > 1){
        // zbytek rozdelim dle lomitek a vysledne pole vratim
        return explode("/", $parts[1]);
    }
    return false;
}

////////////////////////////////////////////////////////////

/**
 * Posklada a poskytne informace o REST API.
 * Informace slozeny z konstant REST_API_ENDPOINTS a REST_API_OWN_ENDPOINTS_INFO.
 * @return array
 */
function getRestAPIInfo(): array {
    // defaultne zadne info neni
    $tmpRes = [];
    // z info o obecnem REST API vymazu nazvy tabulek a nazvy sloupcu s PK
    // klice nastavim dle endpointu
    foreach (REST_API_ENDPOINTS_SETTINGS as $sett) {
        unset($sett["table"]);
        unset($sett["pk_column"]);
        $tmpRes[$sett["endpoint"]] = $sett;
    }
    // z info o vlastnich castech API prebiju puvodni casti info o obecnem API
    foreach (REST_API_OWN_ENDPOINTS_INFO as $sett) {
        // vytahnu nazev endpointu
        $tmpEndpoint = $sett["endpoint"];
        // mam v seznamu dany endpoint?
        if (!array_key_exists($tmpEndpoint, $tmpRes)) {
            // nemam dany endpoint - vytvorim pod nej prazdne pole
            $tmpRes[$tmpEndpoint] = [];
        }
        // projdu zbytek v info a prepisu s nim pripadne hodnoty z obecne casti API
        foreach ($sett as $key => $value) {
            $tmpRes[$tmpEndpoint][$key] = $value;
        }
    }
    return $tmpRes;
}

/////////////////////////////////////////////////////////////////////////
/////////  KONEC: Prace s URL a API  //////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////
/// Pomocne funkce

/**
 * Zacina string na dany startString?
 * @param $string
 * @param $startString
 * @return bool
 */
function startsWith($string, $startString) {
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

/**
 * Prevede DateTime na DB format 'Y-m-d H:i:s'.
 * @param DateTime $datetime
 * @return string
 */
function datetimeDBFormat($datetime){
    return $datetime->format('Y-m-d H:i:s');
}

/**
 * Soucasny DateTime vypsany ve formatu pro databazi 'Y-m-d H:i:s'.
 * @return string
 */
function currentDatetimeInDBFormat(){
    return datetimeDBFormat(new DateTime());
}
