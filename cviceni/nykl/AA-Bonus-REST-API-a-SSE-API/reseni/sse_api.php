<?php
//// SSE API pro Server-Sent Events (aktivne hlida zmeny a poskytuje je klientovi)

// zakladni nastaveni
require_once("settings.inc.php");
// zakladni funkce
require_once("base_functions.inc.php");
// prace s databazi
require_once("MyDatabase.class.php");

// vytvorim databazi
$db = new MyDatabase();


////////////////////////////////////////////////
// SSE API poskytuje reakci pouze na GET metodu

// METHOD
$method = $_SERVER["REQUEST_METHOD"];
// ENDPOINT - pres vlastni funkci
$endpoint = getEndpointFromFriendlyURL(SSE_API_URL_PREFIX);

// SSE odpoved muze bezet delsi cas nez normalni skrypty
// mam danou konfiguraci?
if(defined("SSE_API_MAX_EXEC_TIME_SEC")){
    // Set the maximum execution time (0 for unlimited)
    set_time_limit(SSE_API_MAX_EXEC_TIME_SEC);
}

// povolenou metodou je pouze GET
if($method == "GET"){

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////  Endpoint UDALOST  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    // endpoint UDALOST - poskytuje posledni dostupnou udalost
    if($endpoint == ENDPOINT_UDALOST){
        // id posledni odeslane udalosti
        // (aby se neposilalo vicekrat totez, ale pri reconnect bude posledni poslana znovu)
        $lastSendID = -1;

        // provedu inicializaci SSE komunikace
        sseInit();

        // soustavne kontroluju zmeny v databazi od daneho ID
        // bude ukonceno az vyprsi maximalni doba vykonavani skriptu
        while(true) {

            // nactu pouze posledni udalost z DB (razeno dle id)
            $sql = 'SELECT * FROM ' . TABLE_UDALOST . ' ORDER BY id DESC LIMIT 1';

            // vykonam dotaz a ziskam kompletni odpoved
            $stmt = $db->pdo->prepare($sql);
            $stmt->execute();
            $udalosti = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // mam udalost a ma vetsi ID, nez lastSendID?
            if (isset($udalosti[0]['id']) && $udalosti[0]['id'] > $lastSendID) {
                // odeslu pouze danou udalost
                sseSendData($udalosti[0], RESPONSE_TYPE::JSON);
                // ulozim si jeji ID jako lastSendID
                $lastSendID = $udalosti[0]['id'];
            }

            // spani na kratkou dobu (1s) pro ulehceni zateze CPU
            sleep(SSE_API_AFTER_SEND_SLEEP_TIME_SEC);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////  KONEC: Endpoint UDALOST  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////  Endpoint ZAZNAM  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////

    // endpoint ZAZNAM - soustavne poskytuje zmeny v databazi od daneho casu
    else if($endpoint == ENDPOINT_ZAZNAM){

        // zvoleny typ formatovani datumu - dle typu klienta
        // Pozor, format ATOM a ISO se lisi o ":" na konci a Android OffsetDateTime umi jen s dvojteckou
        // ATOM: 2023-08-07T10:33:17+02:00
        //  ISO: 2023-08-07T10:33:17+0200
        $selectedDTFormat = DateTime::ATOM;
//        $selectedDTFormat = DateTime::ISO8601;

        // inicilizuju SSE spojeni
        sseInit();

        // odeslu specialni event sever_time s casem pripojeni
        // formatovani datumu dle typu klienta
        $tmpStrDT = (new DateTime())->format($selectedDTFormat);
        // odeslani eventu s daty
        sseSendData($tmpStrDT, RESPONSE_TYPE::TEXT, "server_time");

        //////////////////////////////////////////////
        // prace se zaznamy

        // defaultne neni udan zadny cas, a proto je pro jednoduchost pouzit rok 2020
        $lastCheckDT = new DateTime();
        $lastCheckDT->setDate(2020,1,1);

        // mam v pozadavku casovou znacku?
        if(!empty($_GET['last_check'])){
            // mam, prepisu soucasnou defaultni
            // formatovani datumu dle typu klienta
            $lastCheckDT = DateTime::createFromFormat($selectedDTFormat, $_GET["last_check"]);
        }

        // soustavne kontroluju zmeny v databazi od dane casove znacky
        // bude ukonceno az vyprsi maximalni doba vykonavani skriptu
        while(true) {
            // ulozim si cas pred hledanim v DB
            $dtBeforeDBCheck = new DateTime();

            // nactu odpovidajici zaznamy z DB
            $sql = 'SELECT * FROM ' . TABLE_ZAZNAM
                    .' WHERE datum_upravy >= :datum_upravy';

            // omezeni vypisu zaznamu od daneho data
            $params = ['datum_upravy' => datetimeDBFormat($lastCheckDT)];

            // vykonam dotaz a ziskam kompletni odpoved
            $stmt = $db->pdo->prepare($sql);
            $stmt->execute($params);
            $zaznamy = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // upravim jednotlive zaznamy
            foreach (array_keys($zaznamy) as $key) {
                // formatovani datumu dle typu klienta
                $zaznamy[$key]["datum_upravy"] = (new DateTime($zaznamy[$key]["datum_upravy"]))->format($selectedDTFormat);
            }

            // dam zaznamy do dat pro vypsani uzivateli
            $tmpResp = ["items" => $zaznamy];
            // pridam datetime pred ctenim z DB jako datum posledniho cteni
            // formatovani datumu dle typu klienta
            $tmpResp["datetime"] = $dtBeforeDBCheck->format($selectedDTFormat);

            // odeslu nalezene zaznamy
            if (!empty($zaznamy)) {
                sseSendData($tmpResp, RESPONSE_TYPE::JSON);
            }
            else {
                // zaznamy nenalezeny
                // defaultne neposilam nic
                //sseSendData($tmpResp, RESPONSE_TYPE::JSON);
            }

            // posunu casovou znacku na cas pred hledanim v DB
            $lastCheckDT = $dtBeforeDBCheck;

            // spani na kratkou dobu (1s) pro ulehceni zateze CPU
            sleep(SSE_API_AFTER_SEND_SLEEP_TIME_SEC);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////
    /////////////  KONEC: Endpoint ZAZNAM  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////


    else {
        $tmpText = "Endpoint nenalezen.";
        $tmpJson = ["state" => 0, "msg" => $tmpText];
        // klasicka odpoved REST API
        sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_404);
    }

} else {
    $tmpText = "Nepodporovana metoda.";
    $tmpJson = ["state" => 0, "msg" => $tmpText];
    // klasicka odpoved REST API
    sendResponse($tmpJson, RESPONSE_TYPE::JSON, RESPONSE_STATUS::R_405);
}


?>
