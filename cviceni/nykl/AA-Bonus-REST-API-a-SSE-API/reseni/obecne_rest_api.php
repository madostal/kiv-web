<?php
//// Klasicke REST API

// zakladni nastaveni
require_once("settings.inc.php");
// zakladni funkce
require_once("base_functions.inc.php");
// prace s databazi
require_once("MyDatabase.class.php");

// poslu uzivateli hlavicky kvuli CORS
sendCORSHeaders();

// vytvorim databazi
$db = new MyDatabase();


////////////////////////////////////////////////////////////////////////
///////////  Zpracovani vstupu  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////

// METHOD - velka pismena
$method = strtoupper($_SERVER["REQUEST_METHOD"]);
// ENDPOINT
$endpoint = getEndpointFromFriendlyURL(OBECNE_REST_API_URL_PREFIX);

////////////////////////////////////////////////////////

// nastaveni pro zvoleny endpoint v obecnem REST API
$endpointSettings = false;
// parametry z URL adresy
$urlParams = false;
// hodnota PK z URL adresy
$urlPKValue = false;

// mam endpoint?
if($endpoint !== false){
    // nactu parametry z URL
    $urlParams = getParametersFromFriendlyURL($endpoint);
    // je v URL pritomen PK?
    // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
    $urlPKValue = (!empty($urlParams[0])) ? $urlParams[0] : false;
    // defaultne bude endpoint malymi pismeny
    $endpoint = strtolower($endpoint);
    // naleznu pro nej nastaveni v obecnem REST API
    foreach(REST_API_ENDPOINTS_SETTINGS as $tmpSett){
        if($endpoint == $tmpSett["endpoint"]){
            $endpointSettings = $tmpSett;
            break;
        }
    }
}

////////////////////////////////////////////////////////////////////////
///////////  KONEC: Zpracovani vstupu  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////
//var_dump($_SERVER["REQUEST_URI"]);
//var_dump($method);
//var_dump($endpoint);
//var_dump($urlPKValue);
//var_dump($urlParams);
//die;

// info, jestli byl pozadavek v REST API vykonan
$isEndpointSupported = false;
$isMethodSupported = false;


////////////////////////////////////////////////////////////////////////
///////////  Vlastni endpoint - vypis info o REST API  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////

//// Specialni endpoint pro info o REST API s metodou GET
if($endpoint == ENDPOINT_INFO) {

    // defaultne endpoint i metoda podporovany
    $isEndpointSupported = true;
    $isMethodSupported = true;

    ///////////////////////////////////////////////////////////////////////////////////

    // GET - poskytnuti dat - informace o REST API
    // URL: [GET] www.site.cz/rest_api/info/
    if($method == "GET") {
        // defaultne vracim info o API - slozeni je v zakladnich funkcich
        $tmpRes = getRestAPIInfo();
        // odeslu uzivateli
        sendResponse($tmpRes, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
    }

    ////////////////////////////////////////////////////////////////////////////////////

    // metoda neni podporovana
    else {
        $isMethodSupported = false;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////
///////////  KONEC: Vlastni endpoint - vypis info o REST API  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
///////////  Prekriti casti obecneho REST API  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////

//sendResponse(["param"=>$urlParams, "pk"=>$urlPKValue], RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
//die;

// vlastni prekryti nekterych casti obecneho REST API
// metoda dosud nebyla obslouzena a mam pole s nastavenim z obecneho REST API pro dany endpoint
if(!$isMethodSupported && !empty($endpointSettings)) {

    // defaultne jsou endpoint i metoda podporovany
    $isEndpointSupported = true;
    $isMethodSupported = true;

    // podminka dle endpointu a soucasne i dle metody

    // prekriti cteni zaznamu z DB
    // GET - poskytnuti dat - bud vsechny, nebo jeden dle PK
    // URL: [GET] www.site.cz/rest_api/ENDPOINT_ZAZNAM/           -- seznam vsech.
    // URL: [GET] www.site.cz/rest_api/ENDPOINT_ZAZNAM/item_PK/   -- jeden konkretni.
    if ($endpoint == ENDPOINT_ZAZNAM && $method == "GET") {

        //////////////////////////////////////////////////////////////////////////////////////
        // prejato z obecneho REST API

        // NOVE JEN ZDE: pridani parametru pro vyhledavani
        $tmpSearchColumns = ["uc_hw_zarizeni", "nazev", "poloha"];

        // parametry pro hledani v DB
        $where = [];

        // je v URL pritomen PK?
        // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
        $needOnlyOneResult = false;
        if(!empty($urlPKValue)){
            // pouziju pro dotaz do DB - nazev sloupce je v nastaveni
            $where[$endpointSettings['pk_column']] = $urlPKValue;
            // budu vracet jen jednu polozku, ne jejich pole
            $needOnlyOneResult = true;
        }

        // projdu parametry v GET a povolene pouziju pro filtrovani
        foreach($_GET as $key => $value){
            // je parametr pro dany endpoint povolen?
            // JEN ZDE: pridavam vlastni pamarametry
            if(in_array($key, $tmpSearchColumns)) {
                // zaradim do pole s where
                $where[$key] = $value;
            }
        }

        //// NOVE JEN ZDE: smazane zaznamy nechci
        $where["je_smazany"] = 0;

        // nactu zaznamy z databaze
        $items = $db->select($endpointSettings['table'], $where);

        //// NOVE JEN ZDE: upravim jednotlive zaznamy
        foreach(array_keys($items) as $key){
            //// DateTime chci v ISO formatu pro Android
            // Pozor, format ATOM a ISO se lisi o ":" na konci a Android OffsetDateTime umi jen s dvojteckou
            // ATOM: 2023-08-07T10:33:17+02:00
            //  ISO: 2023-08-07T10:33:17+0200
            $items[$key]["datum_upravy"] =  (new DateTime($items[$key]["datum_upravy"]))->format(DateTime::ATOM);
        }
        ////////

        // mam zaznamy pro vraceni uzivateli?
        if(!empty($items)){
            // mam zaznamy - bud jen prvni polozka, nebo seznam vsech polozek
            $tmpRes = ($needOnlyOneResult) ? $items[0] : ["items" => $items];
        } else {
            // nemam zaznamy - bud jen prazdna polozka, nebo prazdny seznam polozek
            $tmpRes = ($needOnlyOneResult) ? [] : ["items" => []];
        }

        // odeslu uzivateli
        sendResponse($tmpRes, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);

        //////////////////////////////////////////////////////////////////////////////////////
    }

    // DELETE - smazani zaznamu
    // URL: [DELETE] www.site.cz/rest_api/item_name/item_PK/
    else if($endpoint == ENDPOINT_ZAZNAM && $method == "DELETE"){

        //////////////////////////////////////////////////////////////////////////////////////
        // prejato z obecneho REST API

        // je v URL pritomen PK?
        // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
        if(empty($urlPKValue)){
            // nemam PK
            $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> nebyl odstranen - nezadan PK zaznamu.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];
            $tmpJson["help"] = $_SERVER["REQUEST_URI"];
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_406);
        }
        // mam ID
        else {
            //// existuje zaznam v DB?
            // nactu zaznamy s filtrem dle PK, nesmi byt smazane
            $tmpParams = [$endpointSettings["pk_column"] => $urlPKValue, "je_smazany" => 0];
            $zaznamy = $db->select($endpointSettings['table'], $tmpParams);

            // mam prave jeden zaznam?
            if(count($zaznamy) != 1){
                // zaznam neexistuje
                $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> nebyl odstranen - zaznam v DB neexistuje.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                $tmpJson["help"] = $_SERVER["REQUEST_URI"];
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);

            } else {
                // zaznam existuje - smazu dle PK a primo overim, jestli dotaz probehl
                // zde nemazu, ale nastavuju je_smazany=true
                //$tmpRes = $db->delete(TABLE_ZAZNAM, ["id" => $urlPKValue]);

                // provedu upravu v DB
                $tmpUpdateParams = ["je_smazany" => 1, "datum_upravy" => currentDatetimeInDBFormat()];
                try{
                    $tmpRes = $db->update($endpointSettings["table"], [$endpointSettings["pk_column"] => $urlPKValue], $tmpUpdateParams);
                } catch (Exception $ex) {
                    $tmpRes = false;
                }

                if ($tmpRes === true) {
                    // dotaz probehl
                    $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> smazan.";
                    $tmpJson = ["state" => 1, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
                } else {
                    // dotaz neprobehl
                    $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> nebyl smazan - chybny PK:". $urlPKValue;
                    $tmpJson = ["state" => 0, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
                }
            }
        }

    }

    /////////////////////////////////////////////////////////////////////
    // doplneni noveho endpointu nad zaznamem pro upravu mnozstvi

    // specialne pro URL: ZAZNAM/{pk}/MNOZSTVI/
    // provede upravu mnozstvi u daneho zaznamu +/- zaslana hodnota
    else if($endpoint == ENDPOINT_ZAZNAM && $method == "PUT"
        && $urlPKValue !== false && count($urlParams) >= 2 && strtolower($urlParams[1]) == "mnozstvi"
    ){

        // nactu asociativni pole dat odeslanych na server jako cisty JSON
        $requestData = json_decode(file_get_contents("php://input"), true);

        // pokud neni PK v URL, je v datech? (pokud ne, zachova puvodni)
//        $pkValue = (empty($urlPKValue) && $requestData[$endpointSettings["pk_column"]])
//            ? $requestData[$endpointSettings["pk_column"]] : $urlPKValue;
        $pkValue = $urlPKValue;

        // nemam PK nebo v datech neni hodnota mnozstvi pro upravu zaznamu?
        if(empty($pkValue) || !isset($requestData["mnozstvi"])){
            // nemam ID nebo dalsi data, tj. neni co upravit
            $tmpText = "PUT zaznam v <". $endpointSettings['endpoint'] ."> nebyl upraven - nezadan PK, nebo data zaznamu.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_406);
        }
        // mam ID
        else {
            // nactu z DB zaznamy s filtrem dle PK
            $zaznamy = $db->select($endpointSettings["table"], [$endpointSettings["pk_column"] => $urlPKValue]);
            // mam prave jeden zaznam?
            if(count($zaznamy) != 1){
                // zaznam neexistuje
                $tmpText = "PUT zaznam v <". $endpointSettings['endpoint'] ."> nebyl upraven - zaznam v DB neexistuje.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                $tmpJson["help"] = $_SERVER["REQUEST_URI"];
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);

            } else {
                // upraveni zaznamu - ziskam puvodni hodnotu mnozstvi
                $mnozstviOriginalValue = $zaznamy[0]["mnozstvi"];
                // o kolik ma byt upraveno mnozstvi u zaznamu?
                $mnozstviUpdateValue = intval($requestData["mnozstvi"]);
                // pripravim data pro ulozeni
                $updateData = [
                    "mnozstvi" => $mnozstviOriginalValue + $mnozstviUpdateValue,
                    "datum_upravy" => currentDatetimeInDBFormat()
                ];

                // zkusim ulozit vsechno, co prislo
                // POZOR: chtelo by to osetrit, co ulozit nelze
                // vykonam a primo overim, jestli dotaz probehl, pri chybe je false
                try{
                    $tmpRes = $db->update($endpointSettings["table"], [$endpointSettings["pk_column"] => $pkValue], $updateData);
                } catch (Exception $ex) {
                    $tmpRes = false;
                }
                if ($tmpRes === true) {
                    // dotaz probehl
                    $tmpText = "PUT mnozstvi u zaznamu v <" . $endpointSettings['endpoint'] . "> upraveno.";
                    $tmpJson = ["state" => 1, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
                } else {
                    // dotaz neprobehl
                    $tmpText = "PUT mnozstvi u zaznamu v <" . $endpointSettings['endpoint'] . "> nebylo upraveno - chybna data.";
                    $tmpJson = ["state" => 0, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
                }
            }
        }
    }

    /////////////////////////////////////////////////////////////////////

    // metoda neni podporovana
    else {
        $isMethodSupported = false;
    }
}

////////////////////////////////////////////////////////////////////////
///////////  KONEC: Prekriti casti obecneho REST API  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
///////////  Obecna cast REST API  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////

// ENDPOINTY z obecneho REST API
// musi byt konfigurace a metoda dosud nebyla obslouzena
if(!empty($endpointSettings[$method]) && !$isMethodSupported){

    // defaultne endpoint i metoda podporovany
    $isEndpointSupported = true;
    $isMethodSupported = true;

    ////////////////////////////////////////////////////////////////////////////////////
    //// GET - poskytnuti zaznamu

    // GET - poskytnuti dat - bud vsechny, nebo jeden dle PK
    // URL: [GET] www.site.cz/rest_api/item_name/           -- seznam vsech.
    // URL: [GET] www.site.cz/rest_api/item_name/item_PK/   -- jeden konkretni.
    if($method == "GET"){

        // parametry pro hledani v DB
        $where = [];

        // je v URL pritomen PK?
        // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
        $needOnlyOneResult = false;
        if(!empty($urlPKValue)){
            // pouziju pro dotaz do DB - nazev sloupce je v nastaveni
            $where[$endpointSettings['pk_column']] = $urlPKValue;
            // budu vracet jen jednu polozku, ne jejich pole
            $needOnlyOneResult = true;
        }

        // projdu parametry v GET a povolene pouziju pro filtrovani
        foreach($_GET as $key => $value){
            // je parametr pro dany endpoint povolen?
            if(in_array($key, $endpointSettings["search_columns"])) {
                // zaradim do pole s where
                $where[$key] = $value;
            }
        }

        // nactu zaznamy z databaze
        $items = $db->select($endpointSettings['table'], $where);

        // mam zaznamy pro vraceni uzivateli?
        if(!empty($items)){
            // mam zaznamy - bud jen prvni polozka, nebo seznam vsech polozek
            $tmpRes = ($needOnlyOneResult) ? $items[0] : ["items" => $items];
            // odeslu uzivateli
            sendResponse($tmpRes, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
        } else {
            // nemam zaznamy
            // pokud byl pozadovan je jeden zaznam a nebyl nalezen
            if($needOnlyOneResult){
                // odeslu uzivateli info o nenalezene polozce
                $tmpText = "GET zaznam v <". $endpointSettings['endpoint'] ."> nenalezen.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                // odpoved
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);
            }
            // pokud byl pozadovan seznam, tak ho vratim prazdny
            else {
                $tmpRes = ["items" => []];
                // odeslu uzivateli
                sendResponse($tmpRes, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
            }
        }

    }

    ////////////////////////////////////////////////////////////////////////////////////
    //// POST - insert zaznamu

    // POST - ulozeni novych dat - jeden zaznam
    // URL: [POST] www.site.cz/rest_api/item_name/
    else if($method == "POST"){

        // nactu asociativni pole dat odeslanych na server jako cisty JSON
        $requestData = json_decode(file_get_contents("php://input"), true);

        //// Vytvoreni zaznamu v DB
        // vykonam a primo overim, jestli dotaz probehl, pri chybe je false
        try {
            $tmpRes = $db->insert($endpointSettings['table'], $requestData);
        } catch (Exception $ex) {
            $tmpRes = false;
        }
        if ($tmpRes === true) {
            // dotaz probehl - vratim i nove ulozene ID
            $newID = $db->getLastInsertId();
            // slozim odpoved
            $tmpText = "POST zaznam v <". $endpointSettings['endpoint'] ."> vytvoren.";
            $tmpJson = ["state" => 1, "msg" => $tmpText, "last_insert_id" => $newID];
            // odpoved
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_201);

        } else {
            // dotaz neprobehl
            $tmpText = "POST zaznam v <". $endpointSettings['endpoint'] ."> nebyl vytvoren - chybna data.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];

            // odpoved
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////
    //// PUT - update zaznamu

    // PUT - editace dat
    // URL: [PUT] www.site.cz/rest_api/item_name/          -- povoluji i tuto variantu s PK v datech
    // URL: [PUT] www.site.cz/rest_api/item_name/item_PK/  -- takto by to melo byt spravne (pokud PK v URL, tak PK v datech nepouzit).
    else if($method == "PUT"){

        // nactu asociativni pole dat odeslanych na server jako cisty JSON
        $requestData = json_decode(file_get_contents("php://input"), true);

        // pokud neni PK v URL, je v datech? (pokud ne, zachova puvodni)
        $pkValue = (empty($urlPKValue) && $requestData[$endpointSettings["pk_column"]])
            ? $requestData[$endpointSettings["pk_column"]] : $urlPKValue;

        // odstranim sloupec s PK z ukladanych dat (na existenci nezalezi)
        unset($requestData[$endpointSettings["pk_column"]]);


        // nemam PK nebo data pro ulozeni
        if(empty($pkValue) || count($requestData) == 0){
            // nemam ID nebo dalsi data, tj. neni co upravit
            $tmpText = "PUT zaznam v <". $endpointSettings['endpoint'] ."> nebyl upraven - nezadan PK, nebo data zaznamu.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_406);
        }
        // mam ID
        else {
            // nactu z DB zaznamy s filtrem dle PK
            $zaznamy = $db->select($endpointSettings["table"], [$endpointSettings["pk_column"] => $urlPKValue]);
            // mam prave jeden zaznam?
            if(count($zaznamy) != 1){
                // zaznam neexistuje
                $tmpText = "PUT zaznam v <". $endpointSettings['endpoint'] ."> nebyl upraven - zaznam v DB neexistuje.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                $tmpJson["help"] = $_SERVER["REQUEST_URI"];
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);

            } else {
                // zkusim ulozit vsechno, co prislo
                // POZOR: chtelo by to osetrit, co ulozit nelze
                // vykonam a primo overim, jestli dotaz probehl, pri chybe je false
                try{
                    $tmpRes = $db->update($endpointSettings["table"], [$endpointSettings["pk_column"] => $pkValue], $requestData);
                } catch (Exception $ex) {
                    $tmpRes = false;
                }
                if ($tmpRes === true) {
                    // dotaz probehl
                    $tmpText = "PUT zaznam v <" . $endpointSettings['endpoint'] . "> upraven.";
                    $tmpJson = ["state" => 1, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
                } else {
                    // dotaz neprobehl
                    $tmpText = "PUT zaznam v <" . $endpointSettings['endpoint'] . "> nebyl upraven - chybna data.";
                    $tmpJson = ["state" => 0, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
                }
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////
    //// DELETE - delete zaznamu

    // DELETE - smazani zaznamu
    // URL: [DELETE] www.site.cz/rest_api/item_name/item_PK/
    else if($method == "DELETE"){
        // je v URL pritomen PK?
        // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
        if(empty($urlPKValue)){
            // nemam PK
            $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> nebyl odstranen - nezadan PK zaznamu.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];
            $tmpJson["help"] = $_SERVER["REQUEST_URI"];
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_406);
        }
        // mam ID
        else {
            //// existuje zaznam v DB?
            // nactu zaznamy s filtrem dle PK
            $zaznamy = $db->select($endpointSettings["table"], [$endpointSettings["pk_column"] => $urlPKValue]);

            // mam prave jeden zaznam?
            if(count($zaznamy) != 1){
                // zaznam neexistuje
                $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> nebyl odstranen - zaznam v DB neexistuje.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                $tmpJson["help"] = $_SERVER["REQUEST_URI"];
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);

            } else {
                // zaznam existuje - smazu dle PK a primo overim, jestli dotaz probehl
                $tmpRes = $db->delete($endpointSettings["table"], [$endpointSettings["pk_column"] => $urlPKValue]);
                if ($tmpRes === true) {
                    // dotaz probehl
                    $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> smazan.";
                    $tmpJson = ["state" => 1, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
                } else {
                    // dotaz neprobehl
                    $tmpText = "DELETE zaznam v <". $endpointSettings['endpoint'] ."> nebyl smazan - chybny PK:". $urlPKValue;
                    $tmpJson = ["state" => 0, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
                }
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////

    // metoda neni podporovana
    else {
        $isMethodSupported = false;
    }
}

////////////////////////////////////////////////////////////////////////
///////////  KONEC: Obecna cast REST API  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////
///////////  Vypis nepodporovaneho endpointu ci metody v REST API  //////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

// ENDPOINT nebo metoda nebyly nalezeny
// nebo v pripade obecneho REST API nemusi byt povolena dana metoda
if(!$isEndpointSupported || !$isMethodSupported) {
    // pouze nedporovana metoda?
    if($isEndpointSupported && !$isMethodSupported){
        $tmpText = "Nepodporovana metoda. Endpoint: $endpoint, Metoda: $method";
        $tmpJson = ["state" => 0, "msg" => $tmpText];
        sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_405);
    } else {
        // opravdu nepodporavny endpoint
        $tmpText = "Endpoint nenalezen. Endpoint: $endpoint";
        $tmpJson = ["state" => 0, "msg" => $tmpText];
        sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);
    }
}

//////////////////////////////////////////////////////////////////////////////////////////
///////////  KONEC: Vypis nepodporovaneho endpointu ci metody v REST API  //////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////


?>
