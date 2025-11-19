# musi se nainstalovat requests -
# sudo apt install python3-requests
# nebo: python -m pip install requests
import requests
import json
# pomocne
import time
import random

# aktualni URL, kde se nachazi API gate
# api_url = " http://localhost/....../simple_post_rest_api/server/rest_api.php"


# testovaci mac adresa
mac = "python-test-mac-001"
print("My MAC address: " + mac)

### pracovni konstanty
# akce pro ulozeni dat
ACTION_SAVE_DHT_DATA = "save_dht_data"
# cekani mezi odesilanim dat v sekundach
SLEEP_BETWEEN_SENDING_DATA_SEC = 5


############ Funkce pro komunikaci s REST API  ##########################################

def sendDataToRestApi(url, dataDictionary):
    '''
    Odesle data na REST API a vrati odpoved.
    :param url:         URL daneho REST API.
    :param dataDictionary:  Slovnik s daty, ktera se maji odeslat jako JSON.
    :return:            Odpoved z REST API.
    '''
    print("----- Sending data to REST API -----")
    # prevedu objekt na JSON (tj. na textovy retezec)
    my_json = json.dumps(dataDictionary)
    print("Text sending to API: "+my_json)

    # odeslat metodou POST s cekanim na odpoved maximalne 10 sekund
    try:
        r = requests.post(url, data = my_json, timeout=10)
    except requests.exceptions.Timeout:
        print("Request timed out after 10 seconds.")
        return {'error': 'timeout'}
    except requests.exceptions.RequestException as e:
        print("Request failed: " + str(e))
        return {'error': 'request_exception', 'message': str(e)}

    # ukazka odeslani dat metodou PUT a DELETE (bez osetreni vyjimek)
    # r = requests.put(url, data = my_json)
    # r = requests.delete(url, data = my_json)

    # ukazka odeslani dat metodou GET (tj. spise zadost o data, nez odeslani dat)
    # r = requests.get(url, params = dataDictionary)

    # vypsat vysledek
    print("----- API Response -----")
    print("Response status: "+ str(r.status_code))
    print("Response reason: "+ str(r.reason))
    print("Response headers: ")
    print(r.headers)

    # prectu prijata data (tj. JSON odeslany serverem klientovi)
    print("----- Parse response JSON -----")
#     print("response text: " +r.text[0:10000])
    print("Response text: " +r.text)

    # prevedu odpoved s JSON na pole
    answer = json.loads(r.text)
    return answer

############ KONEC: Funkce pro komunikaci s REST API  ##########################################


## Nekonecna testovaci smycka s odesilanim nahodnych dat do REST API.
## Vyzdy vygeneruje nahodne hodnoty (teplota, vlhkost) a prida akci a aktualni datetime.
## Po odeslani spi 5 sekund a pak odesle dalsi data.
while True:
    print("==================================================")
    # vygeneruji nahodna data
    currentDhtData = {'temperature': round(random.uniform(10.0, 25.0), 2),
                      'humidity': round(random.uniform(30.0, 60.0), 2)}
    print("Generated DHT data: " + str(currentDhtData))

    # slozim python objekt s daty pro odeslani do API
    par = { 'mac_address': mac,
            'action': ACTION_SAVE_DHT_DATA,
            'datetime': time.strftime("%Y-%m-%d %H:%M:%S"),
            'dht_data': currentDhtData,
    }

    # odeslu data na REST API
    answer = sendDataToRestApi(api_url, par)

    print("API Answer: ")
    print(answer)

    print("==================================================")

    # pockam pred dalsim odeslanim
    print("Sleeping for " + str(SLEEP_BETWEEN_SENDING_DATA_SEC) + " seconds...")
    time.sleep(SLEEP_BETWEEN_SENDING_DATA_SEC)



