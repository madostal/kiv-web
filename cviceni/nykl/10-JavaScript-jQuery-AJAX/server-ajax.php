<?php
///////////////////////////////////////////////////////////////////////////
///////////  PHP reagujici na AJAX volani              ////////////////////
///////////  Secte 2 cisla v POST/GET a soucet vrati   ////////////////////
///////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
/// Prace s CORS (Cross-origin Resource Sharing)

/**
 * Povoleno CORS.
 * CORS (Cross-origin resource sharing) je v informatice mechanismus umožňující sdílení zdrojů
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
//    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Methods: GET, POST");
    // Povolene HTTP hlavicky pozadavku
//    header("Access-Control-Allow-Headers: Content-Type");

    // Specialni "preflight OPTIONS request" byva nekdy posilan pred kazdym pozadavkem do API
    // Obvykle ho posila prohlizec.
    // Toto je pro nej spravna odpoved.
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        // jak dlouho bude klient cachovat odpoved na preflight OPTIONS request [3600s=1h]
        header("Access-Control-Max-Age: 3600");
        // vracim prazdny plain-text
        header("Content-Length: 0");
        header("Content-Type: text/plain");
        exit;
    }
}

// zavolam danou funkci
sendCORSHeaders();


///////////////////////////////////////////////////////////////////////////////
/// Zpracovani pozadavku

// promenna pro slozeni vystupniho textu
$result = "";

// mam v POST nebo GET pozadovana data?
if(isset($_REQUEST["vstup_a"]) && isset($_REQUEST["vstup_b"])){
    // mam data - sectu je
    $suma = floatval($_REQUEST["vstup_a"]) + floatval($_REQUEST["vstup_b"]);
    // bude ve vystupu
    $result .= $suma;
} else {
    // nemam data - vypisu chybu
    $result .= "NEMAM VSTUPNI DATA";
}

// z ukazkovych duvodu vynutim cekani [s]
$tmpNum = mt_rand(1,5);
sleep($tmpNum);

// vypsani vysledku do stranky
echo $result;

?>
