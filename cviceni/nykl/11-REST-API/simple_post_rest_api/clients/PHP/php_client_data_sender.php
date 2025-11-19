<html lang="cs">
<head><meta charset="UTF-8"></head>
<body>
<?php
/// Ukazka odeslani POST pozadavku na REST API pomoci cURL v PHP.
/// CURL musi byt v PHP povoleno (v php.ini musi byt nacteny modul 'curl').
/// Ve Wampserveru je povoleno defaultne, popr. v systemtray ikone Wampserveru:
/// Wampserver icon -> PHP -> PHP extensions -> php_curl (zaskrtnout/odskrtnout)


/// Zobrazeni tohoto skriptu
/// http://localhost/....../simple_post_rest_api/clients/PHP/php_client_data_sender.php

/// !!! URL, kam posilam - nutne upravit, kam se maji pozadavky posilat !!!
// nutnem musi byt HTTPS, ale na localhostu nemusi fungovat,
// proto je dale v kodu kontrola vypnuta.
//$url = "https://localhost/....../simple_post_rest_api/server/rest_api.php";


echo "Odesilam na: <b>$url</b><br><br>";

# testovaci mac adresa
const MAC = "php-test-mac-020";
echo "My MAC address: " . MAC ."<br>";

### pracovni konstanty
# akce pro ulozeni dat
const ACTION_SAVE_DHT_DATA = "save_dht_data";
# cekani mezi odesilanim dat v sekundach
const SLEEP_BETWEEN_SENDING_DATA_SEC = 5;


/////////////  Funkce pro odeslani dat do REST API pomoci cURL  //////////////////

/**
 * Pouzije cURL, posle data na danou URL a vrati vysledek cteni z dane URL.
 * @param string $url
 * @param array|string $data  Bud asociativni pole, nebo jen cisty JSON.
 * @return bool|string
 */
function httpPost(string $url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 2);
    // pokud mam poslat pole, tak musim pripravit odesilany string
    if(is_array($data)){
        // posilam pole dat
        // Pouziva funkci http_build_query() vynucujici application/x-www-form-urlencoded.
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    } else {
        // posilam data jako cisty JSON
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // na localhostu vypnu kontrolu SSL
    $hostname = $_SERVER["HTTP_HOST"];
    if($hostname=="localhost") {
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    }
    // vykonani cURL
    $response = curl_exec($curl);
    // nedoslo k preteceni timeoutu?
    if ($error_number = curl_errno($curl)) {
        if (in_array($error_number, array(CURLE_OPERATION_TIMEDOUT, CURLE_OPERATION_TIMEOUTED))) {
            print "curl timed out";
        }
    }
    // uzavru cURL
    curl_close($curl);

    return $response;
}

/////////////  KONEC: Funkce pro odeslani dat do REST API pomoci cURL  //////////////////


## (Nekonecna) testovaci smycka s odesilanim nahodnych dat do REST API.
## Vyzdy vygeneruje nahodne hodnoty (teplota, vlhkost) a prida akci a aktualni datetime.
## Po odeslani spi 5 sekund a pak odesle dalsi data.
// pocet cyklu
$tmpCount = 3;
while($tmpCount-- > 0) {

    // generuji data (teplota, vlhkost)
    $dhtData = array(
        "temperature" => rand(200, 300) / 10, // nahodna teplota 20.0 - 30.0
        "humidity" => rand(300, 900) / 10      // nahodna vlhkost 30.0 - 90.0
    );

    // priprava dat pro odeslani
    $dataToSend = array(
            "mac_address" => MAC,
            "action" => ACTION_SAVE_DHT_DATA,
            "datetime" => date("Y-m-d H:i:s"),
            "dht_data" => $dhtData,
    );

    // prevod dat na plaintext JSON
    // TAKTO SPRAVNE PRO REST API
    $jsonTextToSend = json_encode($dataToSend);

    // alternativne pro API vlastniho typu:
    // odeslu JSON v atributu 'json_data'
    //$data = ['json_data' => $jsonText];
    // namisto JSON odesilam vsechno jako POST atributy
    //$data = json_decode($jsonText, true);


    // odeslani dat
    echo "<hr>Odesílám plaintext JSON:<br><pre>";
    print_r($jsonTextToSend);
    echo "</pre>";

    $response = httpPost($url, $jsonTextToSend);

    echo "Přijmutý text:<br><pre>";
    echo $response;
    echo "</pre>";

    echo "<hr>Data extrahovaná z JSON:<br><pre>";
    $data = json_decode($response, true);
    var_dump($data);
    echo "</pre>";


    echo "<hr><hr>Spím " . SLEEP_BETWEEN_SENDING_DATA_SEC . " sekund...<br>";
    // vynutim vypsani uzivateli
    ob_flush();
    flush();
    // pauza 5 sekund
    sleep(SLEEP_BETWEEN_SENDING_DATA_SEC);
}


?>
</body>
</html>
