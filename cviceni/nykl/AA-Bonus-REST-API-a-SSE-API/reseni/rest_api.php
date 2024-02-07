<?php
//// Klasicke REST API

// zakladni nastaveni
require_once("settings.inc.php");
// zakladni funkce
require_once("base_functions.inc.php");
// prace s databazi
require_once("MyDatabase.class.php");

// poslu uzivateli HTTP hlavicky kvuli CORS
sendCORSHeaders();

// vytvorim databazi
$db = new MyDatabase();

////////////////////////////////////////////////////////////////////////
///////////  Zpracovani vstupu  //////////////////////////////////////
////////////////////////////////////////////////////////////////////////

// METHOD - velka pismena
$method = strtoupper($_SERVER["REQUEST_METHOD"]);
// ENDPOINT - pres vlastni funkci
$endpoint = getEndpointFromFriendlyURL(REST_API_URL_PREFIX);

////////////////////////////////////////////////////////

// parametry z URL adresy
$urlParams = false;
// hodnota PK z URL adresy
$urlPKValue = false;

// mam endpoint?
if($endpoint !== false){
    // defaultne bude endpoint malymi pismeny
    $endpoint = strtolower($endpoint);
    // nactu parametry z URL
    $urlParams = getParametersFromFriendlyURL($endpoint);
    // je v URL pritomen PK?
    // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
    $urlPKValue = (!empty($urlParams[0])) ? $urlParams[0] : false;
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


// ENDPOINT ZAZNAM
if($endpoint == ENDPOINT_ZAZNAM){

//////////////////////////////////////////////////////////////////////////////////////////
///////////  GET - poskytnuti zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // GET - poskytnuti dat - bud vsechny, nebo jeden dle PK
    // URL: [GET] www.site.cz/rest_api/zaznam/           -- seznam vsech.
    // URL: [GET] www.site.cz/rest_api/zaznam/item_PK/   -- jeden konkretni.
    if($method == "GET"){

        // parametry pro hledani v DB
        $where = [];

        // je v URL pritomen PK?
        $needOnlyOneResult = false;
        if(!empty($urlPKValue)){
            // pouziju pro dotaz do DB - nazev sloupce je v nastaveni
            $where["id"] = $urlPKValue;
            // budu vracet jen jednu polozku, ne jejich pole
            $needOnlyOneResult = true;
        }

        // projdu parametry v GET a povolene pouziju pro filtrovani
        foreach($_GET as $key => $value){
            // je parametr pro dany endpoint povolen?
            if(in_array($key, ['nazev','poloha','uc_hw_zarizeni'])) {
                // zaradim do pole s where
                $where[$key] = $value;
            }
        }

        // nactu zaznamy z databaze
        $items = $db->select(TABLE_ZAZNAM, $where);

        // mam zaznamy pro vraceni uzivateli?
        if(!empty($items)){
            // mam zaznamy - bud jen prvni polozka, nebo seznam vsech polozek
            $tmpRes = ($needOnlyOneResult) ? $items[0] : ["zaznamy" => $items];
            // odeslu uzivateli
            sendResponse($tmpRes, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
        } else {
            // nemam zaznamy
            // pokud byl pozadovan je jeden zaznam a nebyl nalezen
            if($needOnlyOneResult){
                // odeslu uzivateli info o nenalezene polozce
                $tmpText = "GET zaznam v <zaznam> nenalezen.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                // odpoved
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);
            }
            // pokud byl pozadovan seznam, tak ho vratim prazdny
            else {
                $tmpRes = ["zaznamy" => []];
                // odeslu uzivateli
                sendResponse($tmpRes, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
            }
        }

    }

//////////////////////////////////////////////////////////////////////////////////////////
///////////  KONEC: GET - poskytnuti zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
///////////  POST - insert zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // POST - ulozeni novych dat - jeden zaznam
    // URL: [POST] www.site.cz/rest_api/zaznam/
    else if($method == "POST"){

        // nactu asociativni pole dat odeslanych na server jako cisty JSON
        $requestData = json_decode(file_get_contents("php://input"), true);

        //// Vytvoreni zaznamu v DB
        // vykonam a primo overim, jestli dotaz probehl, pri chybe je false
        try {
            $tmpRes = $db->insert(TABLE_ZAZNAM, $requestData);
        } catch (PDOException $ex) {
            $tmpRes = false;
        }
        if ($tmpRes === true) {
            // dotaz probehl - vratim i nove ulozene ID
            $newID = $db->getLastInsertId();
            // slozim odpoved
            $tmpText = "POST zaznam v <zaznam> vytvoren.";
            $tmpJson = ["state" => 1, "msg" => $tmpText, "last_insert_id" => $newID];
            // odpoved
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_201);

        } else {
            // dotaz neprobehl
            $tmpText = "POST zaznam v <zaznam> nebyl vytvoren - chybna data.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];

            // odpoved
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
///////////  KONEC: POST - insert zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
///////////  PUT - update zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // PUT - editace dat
    // URL: [PUT] www.site.cz/rest_api/zaznam/          -- povoluji i tuto variantu s PK v datech
    // URL: [PUT] www.site.cz/rest_api/zaznam/item_PK/  -- takto by to melo byt spravne (pokud PK v URL, tak PK v datech nepouzit).
    else if($method == "PUT"){

        // nactu asociativni pole dat odeslanych na server jako cisty JSON
        $requestData = json_decode(file_get_contents("php://input"), true);

        // pokud neni PK v URL, je v datech? (pokud ne, zachova puvodni)
        $pkValue = (empty($urlPKValue) && !empty($requestData["id"]))
            ? $requestData["id"] : $urlPKValue;

        // odstranim sloupec s PK z ukladanych dat (na existenci nezalezi)
        unset($requestData["id"]);

        // nemam PK nebo data pro ulozeni
        if(empty($pkValue) || count($requestData) == 0){
            // nemam ID nebo dalsi data, tj. neni co upravit
            $tmpText = "PUT zaznam v <zaznam> nebyl upraven - nezadan PK, nebo data zaznamu.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_406);
        }
        // mam ID
        else {
            // nactu z DB zaznamy s filtrem dle PK
            $zaznamy = $db->select(TABLE_ZAZNAM, ["id" => $urlPKValue]);
            // mam prave jeden zaznam?
            if(count($zaznamy) != 1){
                // zaznam neexistuje
                $tmpText = "PUT zaznam v <zaznam> nebyl upraven - zaznam v DB neexistuje.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                $tmpJson["help"] = $_SERVER["REQUEST_URI"];
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);

            } else {
                // zkusim ulozit vsechno, co prislo
                // POZOR: chtelo by to osetrit, co ulozit nelze
                // vykonam a primo overim, jestli dotaz probehl, pri chybe je false
                try{
                    $tmpRes = $db->update(TABLE_ZAZNAM, ["id" => $pkValue], $requestData);
                } catch (Exception $ex) {
                    $tmpRes = false;
                }
                if ($tmpRes === true) {
                    // dotaz probehl
                    $tmpText = "PUT zaznam v <zaznam> upraven.";
                    $tmpJson = ["state" => 1, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
                } else {
                    // dotaz neprobehl
                    $tmpText = "PUT zaznam v <zaznam> nebyl upraven - chybna data.";
                    $tmpJson = ["state" => 0, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
                }
            }
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
///////////  KONEC: PUT - update zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
///////////  DELETE - delete zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // DELETE - smazani zaznamu
    // URL: [DELETE] www.site.cz/rest_api/item_name/item_PK/
    else if($method == "DELETE"){
        // je v URL pritomen PK?
        // v URL je za nazvem endpointu, tj. prvni v poli parametru z URL
        if(empty($urlPKValue)){
            // nemam PK
            $tmpText = "DELETE zaznam v <zaznam> nebyl odstranen - nezadan PK zaznamu.";
            $tmpJson = ["state" => 0, "msg" => $tmpText];
            $tmpJson["help"] = $_SERVER["REQUEST_URI"];
            sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_406);
        }
        // mam ID
        else {
            //// existuje zaznam v DB?
            // nactu zaznamy s filtrem dle PK
            $zaznamy = $db->select(TABLE_ZAZNAM, ["id" => $urlPKValue]);

            // mam prave jeden zaznam?
            if(count($zaznamy) != 1){
                // zaznam neexistuje
                $tmpText = "DELETE zaznam v <zaznam> nebyl odstranen - zaznam v DB neexistuje.";
                $tmpJson = ["state" => 0, "msg" => $tmpText];
                $tmpJson["help"] = $_SERVER["REQUEST_URI"];
                sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);

            } else {
                // zaznam existuje - smazu dle PK a primo overim, jestli dotaz probehl
                $tmpRes = $db->delete(TABLE_ZAZNAM, ["id" => $urlPKValue]);
                if ($tmpRes === true) {
                    // dotaz probehl
                    $tmpText = "DELETE zaznam v <zaznam> smazan.";
                    $tmpJson = ["state" => 1, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_200);
                } else {
                    // dotaz neprobehl
                    $tmpText = "DELETE zaznam v <zaznam> nebyl smazan - chybny PK:". $urlPKValue;
                    $tmpJson = ["state" => 0, "msg" => $tmpText];
                    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_422);
                }
            }
        }

    }

//////////////////////////////////////////////////////////////////////////////////////////
///////////  KONEC: DELETE - delete zaznamu  ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // metoda neni podporovana
    else {
        $tmpText = "Nepodporovana metoda. Endpoint: $endpoint, Metoda: $method";
        $tmpJson = ["state" => 0, "msg" => $tmpText];
        sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_405);
    }
}
// endpoint neni podporovan
else {
        // opravdu nepodporavny endpoint
        $tmpText = "Endpoint nenalezen. Endpoint: $endpoint";
        $tmpJson = ["state" => 0, "msg" => $tmpText];
        sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);
}

?>
