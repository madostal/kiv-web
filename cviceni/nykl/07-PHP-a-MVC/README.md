# 7. cvičení KIV/WEB - PHP a MVC, tj. 3-vrstvá architektura aplikace

* Projděte si prezentaci k tomuto cvičení.


## Popis úkolu

* Chceme vytvořit aplikaci s MVC architekturou, která bude vypisovat pohádky a umožňovat správu uživatelů (ideálně 1. varianta MVC z prezentace, viz následující obrázek či obrázky *php-a-mvc-priklad-var1_?.png*).
  * Stránky požadovaného webu:
    * Úvodní stránka - zobrazuje seznam pohádek, včetně autora a data vložení (získány z DB: *orionlogin_mvc_introduction*). Ukázka viz obrázek *mvc-uvod.png*.
    * Správa uživatelů - vypisuje všechny uživatele, přičemž jednotlivé uživatele umožňuje mazat. Ukázka viz obrázek *mvc-sprava-uzivatelu.png*.
  * Ukázka MVC architektury:
  ![Příklad MVC v PHP](_images/php-a-mvc-priklad-var1_2.png)
* Komponenta ovladačů (Controllers) - bude obsahovat 3 soubory (*index.php*, *IntroductionController.class.php*, *UserManagementController.class.php*).
  * "Rozcestník" - jediný vstupní bod do aplikace (*index.php*):
    * Přijme požadavek na zobrazení určité stránky webu, načte odpovídající ovladač, zavolá jeho funkci pro zpracování požadavku (a vypsání stránky) a výsledné HTML zobrazí uživateli.
  * Úvodní stránka s pohádkami (soubor *IntroductionController.class.php*) a Správa uživatelů (soubor *UserManagementController.class.php*):
    * Požádá odpovídající model dat o data, přijatá data předá odpovídající šabloně a výsledek šablony vrátí rozcestníku.
* Komponenta modelů (Models) - bude obsahovat 1 soubor pro veškerou práci s databází (*DatabaseModel.class.php*):
  * Získá požadovaná data z databáze a poskytne je volajícímu ovladači.
* Komponenta šablon či pohledů (Views) - bude obsahovat 3 soubory (*TemplateBasics.tpl.php*, *IntroductionTemplate.tpl.php*, *UserManagement.tpl.php*)
  * Přijme data, vykreslí je v HTML šabloně a výsledný vzhled vypíše (nebo vrátí ovladači). 
  * Poznámka: v naší 1. variantě MVC je výpis kontrolerem odchycen do tzv. bufferu a předán do rozcestníku, který ho vypíše uživateli.

### Způsoby řešení

* Řešení využívající pouze to, co jsme dosud viděli na cvičeních, tj. v každém souboru manuálně připojíme soubory tříd, které aplikace aktuálně vyžaduje.
* Řešení využívající jmenné prostory (*namespaces*) a automatické načítání souborů požadovaných tříd.
  * Vede k lepší strukturaci kódu a usnadňuje vývojáři práci.
  * Doporučuji zkusit si vytvořit tuto variantu, nebo si alespoň prohlédnout příslušné řešení.

### 0. úkol - Import databáze a průzkum souborů příkladu

* V souboru *mvc-database-install.sql* nahraďte všechny výskyty slova "orionlogin" za Váš konkrétní orion login.
  * Získáte tak dvě tabulky, které jako prefix budou mít Váš orion login (původně: **orionlogin_mvc_introduction** a **orionlogin_mvc_user**).
* Importujte daný soubor do Vaší MySQL databáze (nebo do databáze na *students.kiv.zcu.cz*).
* Doplňte přístupové údaje k databázi do souboru *settings.inc.php*, včetně konkrétních názvů tabulek.
* Prohlédněte si dodané zdrojové soubory příkladu.
* Pozn.: pokud se Vám při čtení z databáze nebude správně zobrazovat česká diakritika, tak můžete použít následující příkazy (ideální je použít je bezprostředně po vytvoření instance PDO):
  * Varianta 1, PDO příkaz: *$myPDO->exec("set names utf8")*. 
  * Varianta 2, SQL dotaz: *$q = "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'"*.

### 1. úkol - Vytvoření šablon/pohledů

* Začněte vytvořením šablon pro úvodní stránku (soubor *IntroductionTemplate.tpl.php*) a pro správu uživatelů (soubor *UserManagement.tpl.php*).
  * Připravené soubory mají na začátku svého kódu uvedenu strukturu všech dat, se kterými mají pracovat.
  * Obě šablony si nechte samostatně zobrazit (nic by tomu nemělo bránit, protože přímo obsahují vypisovaná data).
* Soubor *TemplateBasics.class.php* s HTML hlavičkami:
  * Obsahuje funkci pro vykreslení "hlavičky" a "patičky" HTML dokumentu.
  * Vstupním parametrem funkce vykreslující hlavičku je název stránky.
  * Doplňte do hlavičky výpis menu, viz konstanta *WEB_PAGES* v souboru *settings.inc.php*.  
  * Využijte tuto třídu pro výpsání "hlavičky a patičky" v následujících šablonách.
* Šablona pro úvodní stránku:
  * Vypisuje ukázky pohádek, jejichž data obsahují jméno autora, datum vytvoření, název pohádky a úryvek pohádky. Záznamy lze na stránce oddělit např. vodorovnou čarou, viz ukázka na obrázku *mvc-uvod.png*.
* Šablona pro správu uživatelů:
  * Vypisuje formou tabulky uživatele (kteří jsou uloženi v databázi) a umožňuje jen jejich mazání tlačítky v posledním sloupci tabulky (pozn.: ID uživatele lze serveru předat input elementem typu *hidden*). Ukázka viz obrázek *mvc-sprava-uzivatelu.png*.
  * Data uživatelů obsahují jejich ID (důležité pro mazání), jméno, příjmení, login, heslo (nebude vypsáno), e-mail a web.  
* Pozn.: ukázková data lze zatím v šablonách ponechat.


### 2. úkol - Vytvoření ovladačů (zatím bez přístupu k databázi)

* Rozcestník webu (soubor *index.php*):
  * Je jediným vstupním bodem aplikace.
  * Zobrazuje požadovanou stránku na základě parametru *page*, který mu přichází v URL (jako GET požadavek). Pokud parametr není zadán nebo neodkazuje na validní stránku webu (konstanta *WEB_PAGES*), tak je uživateli zobrazena defaultní stránka (konstanta *DEFAULT_WEB_PAGE_KEY*). 
    * V praxi by se současně kontrolovalo, zda daný uživatel může příslušnou stránku zobrazit, tj. zda má dostatečné oprávnění.
    * Zobrazení stránky je provedeno prostřednictvím ovladače (controller), který odpovídá požadované stránce a obsahuje funkci pro zpracování dat stránky a vykreslení jejího obsahu. Funkce je dána rozhraním *IController*, viz soubor *IController.interface.php*.
* Ovladač pro úvodní stránku (soubor *IntroductionController.class.php*) a ovladač pro správu uživatelů (soubor *UserManagementController.class.php*):
  * Inicializuje globální proměnnou *$tplData*, která je polem, které slouží pro předání dat do šablony (viz soubor šablony).
  * Nastaví do *$tplData* název stránky (z parametru funkce).
  * V příslušné šabloně zakomentujte ukázková data a odkomentujte inicializaci globální proměnné *$tplData*.
  * Doplňte informace o ovladači správy uživatelů do souboru *settings.inc.php*.
* Otestujte, že na stránce fungují odkazy v menu, tj. že správně funguje rozcestník a příslušné ovladače správně vypisují data v odpovídajících šablonách.
  * Pozn.: nyní šablonám nepředáváme data pohádek ani uživatelů, a proto šablony vypisují jen hlavičku a patičku.


### 3. úkol - Vytvoření třídy modelu pro správu databáze a jeho použití v ovladačích

* Doplňte soubor *DatabaseModel.class.php*:
  * Doplňte funkci pro získání všech pohádek z databáze (tabulka *mvc_introduction*).
  * Doplňte funkci pro získání všech uživatelů z databáze (tabulka *mvc_user*).
  * Doplňte funkci pro smazání konkrétního uživatele z databáze, přičemž ID uživatele je parametrem příslušné funkce. 
* Doplňte ovladač pro výpis úvodní stránky (soubor *IntroductionController.class.php*) o získání všech pohádek z databáze, tj. o volání příslušné funkce modelu.
  * Ověřte správnost implementace pohledem na danou stránku.
* Doplňte ovladač pro výpis správy uživatelů (soubor *UserManagementController.class.php*) o získání všech uživatelů z databáze, tj. o volání příslušné funkce modelu.
  * Ověřte správnost implementace pohledem na danou stránku.
* Doplňte ovladač pro výpis správy uživatelů o možnost mazání uživatele, tj. o volání příslušné funkce modelu.
  * Kontrolujte, zda přišel požadavek na smazání uživatele, a po jeho vykonání vypište úspěšnost mazání.
  * Ověřte správnost implementace.

### 4. úkol - Použití jmenných prostorů (volitelné, ale doporučené)

* Zkuste si aplikaci upravit tak, aby používala jmenné prostory. 

## Ukázka generování programové dokumentace

* V adresáři *_dokumentace* máte přiložen soubor *phpDocumentor.phar* (popis viz [zdroj](https://www.phpdoc.org)), který je PHP aplikací, která umožňuje automaticky generovat programovou dokumentaci na základě komentářů použitých v kódu aplikace (pozn. něco jako JavaDoc pro Javu).
  * Generování dokumentace lze spustit např. příkazem: *php phpDocumentor(new_php7.2).phar -v -d ../src/ -t ./my_documentation/ --template="clean"*
  * Ukázku spuštění obsahují také přiložené BAT soubory.

## Ukázka souboru *.htaccess* s lokálními nastaveními serveru
* Soubor ***.htaccess*** (pozn.: soubor je bez jména a má příponou *htaccess*) slouží k úpravě chování serveru v daném adresáři či jeho podadresářích.
  * Lze nastavit výchozí soubor/y adresářů, defaultně *index.html* a *index.php* (na pořadí záleží).
  * Lze nastavit přesměrování (např. z URL adresy bez *www* na adresu s *www* či opačně).
  * Lze nastavit chování pro tzv. hezké URL adresy:
    * Klasická URL adresa např.: www.pokus.cz/?stranka=uvod&clanek=12
    * Hezká URL adresa např.: www.pokus.cz/uvod/12/
  * Poznámka: na *students.kiv.zcu.cz* vám pravděpodobně nebudou hezké URL adresy fungovat, protože Váš prostor na dané doméně začíná až za *students.kiv.zcu.cz/~orionlogin/*
  * Ukázka viz soubor *ukazka.htaccess*. 


## Úkoly na doma

* Dle vlastního zájmu.

    
## Výstupy cvičení

* Student by měl vědět, co je MVC architektura, a měl by ji umět vysvětlit (alespoň ve dvou variantách, tj. výstup z ovladače VS. výstup z šablony).
  * Student by měl chápat, proč je vhodné MVC dodržovat.
* Student by měl být schopen implementovat PHP aplikaci, která dbá MVC architektury.
* Student by měl alespoň vědět, že existují jmenné prostory (ideálně by je měl umět i použít).
* Student by měl vědět, k čemu slouží soubor *.htaccess*.
* Student by měl umět vygenerovat programovou dokumentaci k objektové PHP aplikaci využitím nástroje *phpDocumentor*.
* **Semestrální práce** - nyní by student měl mít téměř všechny nutné znalosti pro implementaci kompletní webové aplikace, která je požadována zadáním semestrální práce.
  * Posledním nutným požadavkem na semestrální práci je ošetření jejích vstupů proti útokům typu *Cross-Site Scripting* a *SQL Injection*, viz 9. cvičení.
  * Za bonusové body můžete v semestrální práci využít šablonovací systém *Twig*, viz 8. cvičení, a *JavaScript* či jeho knihovnu *jQuery* (nebo jinou), viz 10. cvičení.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :camel:
