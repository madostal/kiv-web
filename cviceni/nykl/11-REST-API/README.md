# 11. cvičení KIV/WEB - REST API a SSE API

**Pracovní verze, rok 2025/26**

* Projděte si prezentaci k tomuto cvičení.
* Při vypracovávání se Vám může hodit:
    * [HTTP Request Methods](https://www.w3schools.com/tags/ref_httpmethods.asp).
    * [HTTP Status Messages](https://www.w3schools.com/tags/ref_httpmessages.asp).
    * [Handle CORS and Preflight](https://www.wpeform.io/blog/handle-cors-preflight-php-wordpress/)


## 1. úkol - Simple POST REST API

* V tomto případě se jedná o ukázku jednoduchého REST API.
* Požadavek (*request*) je zasílán na jediný endpoint:<br> **/simple_post_rest_api/server/rest_api_zadani.php**
* Požavek používá pouze HTTP metodu POST a data jsou ve formátu JSON.
  * V datech musí být klíč **action** určující požadovanou akci a klíč **mac_address** s MAC adresou zařízení. 
  * Akce:
    * **get_config** - získání konfiguračních dat pro zařízení s danou MAC adresou.
    * **save_dht_data** - odeslání dat DHT senzoru ze zařízení na server.
    * Ukázka kompletních JSON dat pro akci *save_dht_data*:
        ```json
        {
            "action": "save_dht_data",
            "mac_address": "00:11:22:33:44:55",
            "datetime": "2024-06-01T12:00:00",
            "dht_data": {
                "temperature": 23.5,
                "humidity": 60.2
            }
        }
        ```
* Odpovědi (*response*) serveru využívají HTTP statusy (např. *200 OK, 400 Bad Request, 405 Method Not Allowed* aj.).

**Klienti:**
  * Klienti v různých jazycích (Python, PHP, JS) komunikující s REST API jsou v adresáři: <br>
   **/simple_post_rest_api/clients/**
  * Vždy používají HTTP metodu POST a data obsahující klíče **action** a **mac_address**.
  * Simulovaná data z DHT senzoru jsou pod klíčem **dht_data** uložena v poli (*temperature*, *humidity*). Přítomen musí být i aktuální datum a čas pod klíčem **datetime**.

**Úkoly:**
  * Prohlédněte si klienty - zaměřte se na jednoduchost implementace komunikace s REST API.
  * Prohlédněte si soubor */simple_post_rest_api/server/rest_api_zadani.php*,
    který obsahuje implementaci REST API a je jediným endpointem daného REST API (tj. jedinou URL adresou). Dolpňte v souboru chybějící části kódu pod poznámkami s TODO. Poznámky "TODO FUTURE" vynechte (pod nimi by následovalo reálné začlenění funkcionalit REST API do konkrétního systému). Všímejte si, jakým způsobem jsou vraceny různé HTTP statusy (jejich volba vždy závisí na Vás).
  * Vyzkoušejte funkčnost REST API pomocí klientů, min. klienta v JavaScriptu.
    * Aby klient fungoval, tak musí mít nastavenu správnou URL adresu REST API serveru.

## 2. úkol - FullREST API example
* V tomto případě se jedná o ukázku FullREST API.
* Hlavním cílem je ukázat, jak na serveru reagovat na různé HTTP metody (GET, POST, PUT, DELETE) a jak určit požadovaný endpoint a případně ID zdroje (*resource ID*), které jsou použity v URL adrese.
* URL adresy a HTTP metody v rámci FullREST API mají následující význam (předpokládejme, že požadovaný endpoint je *devices*):
  * **/devices** (metoda GET) - získání seznamu všech zařízení.
  * **/devices** (metoda POST) - vytvoření nového zařízení.
  * **/devices/{id}** (metoda GET) - získání detailu zařízení s daným ID.
  * **/devices/{id}** (metoda PUT) - update zařízení s daným ID.
  * **/devices/{id}** (metoda DELETE) - smazání zařízení s daným ID.
* Odpovědi (*response*) serveru využívají HTTP statusy (např. *200 OK, 201 Created, 400 Bad Request, 404 Not Found, 405 Method Not Allowed* aj.).
* Všechna data jsou ve formátu JSON (a neobsahují žádný atribut udávající, jaká akce má být provedena - ta je určena URL adresou a HTTP metodou).
* Ukázáno je:
  * jak implementovat FullREST API bez použití souboru **.htaccess** (tj. s URL adresou obsahující název skriptu, který má být proveden).<br>
   Např.: **/fullrest_api_example/fullrest_api_bez_htaccess.php/devices/1**
  * jak implementovat FullREST API s použitím souboru **.htaccess** (tj. s hezkými URL adresami a přesměrováním všech požadavků na jediný PHP skript, který zpracovává požadavky na různé endpointy pro různé HTTP metody).<br>
   Např.: **/fullrest_api_example/fullrestapi/devices/1**


**Úkoly:**
* Prohlédněte si soubor **/fullrest_api_example/fullrest_api_bez_htaccess.php**.
* Udělejte v souboru pouze testovací výpis "hello world" a vyzkoušejte, že funguje přístup z různých URL adres, např.: 
  * **/fullrest_api_example/fullrest_api_bez_htaccess.php/devices**
  * **/fullrest_api_example/fullrest_api_bez_htaccess.php/devices/1**
* Doplňte do souboru zjištění použité HTTP metody požadavku a zpracování URL adresy pro získání požadovaného endpointu a případného ID zdroje.
 * Výstupem souboru může být pouze *var_dump()* výpis, jaká HTTP metoda byla použita a jaký endpoint a ID zdroje bylo požadováno.
* Přejmenujte soubor **example.htaccess** na **.htaccess**, upravte v něm cestu k souboru **fullrest_api_s_htaccess.php** a vyzkoušejte přístup z různých URL adres, např.:
  * **/fullrest_api_example/fullrestapi/devices**
  * **/fullrest_api_example/fullrestapi/devices/1**


## Úkoly na doma

Dle vlastní iniciativy se můžete poukusit:
* doimplementovat v příkladu *Simple POST REST API* části označené jako TODO FUTURE, tj. přidání databáze.
* doimplementovat obdobnou funkcionalitu do příkladu *FullREST API example*.


## Výstupy cvičení

* Student by měl vědět, jakým způsobem REST API pro komunikaci s klientem
  využívá HTTP metody a HTTP statusy.
* Student by měl rozumět rozdílu mezi jednoduchým REST API a FullREST API.
* Student by měl umět implementovat jednoduché REST API a FullREST API v PHP.
* Student by měl umět využívat různé HTTP metody (GET, POST, PUT, DELETE) a různé HTTP statusy.
* Student by měl umět pracovat s URL adresami pro různé endpointy a zdroje v rámci FullREST API.
* Student by měl umět využívat soubor .htaccess pro přesměrování požadavků na jediný PHP skript v rámci FullREST API.


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* Závěrem zvířátko :rooster:
