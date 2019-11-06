# 7. cvičení KIV/WEB - PHP a MVC.

* Projděte si prezentaci k tomuto cvičení.


## Popis úkolu

* Chceme vytvořit aplikaci s MVC architekturou, která bude vypisovat pohádky a umožňovat správu uživatelů (ideálně 1. varianta MVC z prezentace, viz následující obrázek či obrázky *php-a-mvc-priklad-var1_?.png*).
  * Stránky požadovaného webu:
    * Úvod stránka - na úhledné stránce zobrazuje seznam pohádek (získán z DB: *orionlogin_mvc_introduction*), včetně autora a data vložení. Ukázka viz soubor *mvc-uvod.png*.
    * Správa uživatelů - na úhledné stránce vypisuje všechny uživatele, přičemž jednotlivé uživatele umožňuje mazat. Ukázka viz soubor *mvc-sprava-uzivatelu.png*.
  ![Příklad MVC v PHP](_images/php-a-mvc-priklad-var1_2.png)
* Vrstva ovladačů (Controllers) - bude obsahovat 3 soubory (*index.php*, *IntroductionController.class.php*, *UserManagementController.class.php*).
  * "Rozcestník" - jediný vstupní bod do aplikace (*index.php*):
    * přijme požadavek na zobrazení určité stránky webu, načte odpovídající ovladač, zavolá jeho funkci pro zpracování požadavku (a vypsání stránky) a výsledné HTML zobrazí uživateli.
  * Úvodní stránka s pohádkami (soubor *IntroductionController.class.php*) a Správa uživatelů (soubor *UserManagementController.class.php*):
    * zavolá odpovídající model dat, přijatá data předá odpovídající šabloně a výsledek šablony vrátí rozcestníku.
* Vrstva modelů (Models) - bude obsahovat 1 soubor pro veškerou práci s databází (*DatabaseModel.class.php*):
  * získá požadovaná data z databáze a poskytne je volajícímu ovladači.
* Vrstva šablon či pohledů (Views) - bude obsahovat 3 soubory (*TemplateBasics.tpl.php*, *IntroductionTemplate.tpl.php*, *UserManagement.tpl.php*)
  * přijme data, vloží je do HTML šablony a výsledný vzhled vypíše.


## 0. úkol - Vytvoření databáze a průzkum souborů příkladu

* V souboru mvc-database-install.sql nahraďte všechny výskyty slova "orionlogin" za Váš konkrétní orion login.
  * Získáte tak dvě tabulky, které jako prefix budou mít Váš orion login (původně: orionlogin_mvc_introductions a orionlogin_mvc_users).
* Importujte daný soubor do Vaší MySQL databáze (nebo do databáze na students.kiv.zcu.cz).
* Pozn.: pokud se Vám při čtení z databáze nebude správně zobrazovat česká diakritika, tak před čtením z DB můžete použít např. následující dotaz (např. v konstruktoru příslušného objektu):
  * *$q = "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'"*;        
* Prohlédněte si dodané soubory příkladu a doplňte údaje do souboru *setting.inc.php*.


## 1. úkol - Vytvoření šablon/pohledů

* Začtněte vytvořením šablon pro úvodní stránku i pro správu uživatelů.
* Připravené soubory mají na začátku svého kódu uvedenu strukturu všech dat, se kterými mají pracovat.
* Soubor s HTML hlavičkami (*TemplateBasics.class.php*):
  * obsahuje metodu pro vykreslení "hlavičky" HTML dokumentu:
    * vstupním parametrem je název stránky.
    * doplňte výpis menu.
  * obsahuje metodu pro vykreslení "patičky" HTML dokumentu.
* Šablona pro úvodní stránku s pohádkami (*IntroductionTemplate.tpl.php*):
  * vypíše celou šablonu úvodní tránky (přidá "hlavičku a patičku" HTML), přičemž v ní vypíše přijatá data pohádek.
  * každý záznam (pohádka) by na stránce měl mít svůj nadpis, autora, datum vložení a text. Záznamy lze oddělit např. vodorovnou čarou, viz soubor *mvc-uvod.png*.
* Šablona pro správu uživatelů (*UserManagement.tpl.php*):
  * vypíše celou šablonu správy uživatelů (přidá "hlavičku a patičku" HTML), přičemž vypíše přijatá data uživatelů.
  * uživatelé budou vypsáni do tabulky, která v posledním sloupci budou obsahovat tlačítko pro smazání příslušného uživatele (pozn.: ID uživatele lze předat input elementem typu hidden), viz soubor *mvc-sprava-uzivatelu.png*.
* Šablony pro úvodní stránku a pro správu uživatelů si nechte samostatně zobrazit (nic by tomu nyní nemělo bránit, protože přímo obsahují vypisovaná data).


## 2. úkol - Vytvoření ovladačů

* Rozcestník webu (*index.php*):
  * bude jediným vstupním bodem aplikace.
  * požadovaná stránka bude předána přes GET požadavek (např. v parametru *page*).
  * zkontroluje, zda požadovaná stránka existuje (pozn.: v praxi by se ještě kontrolovalo, zda daný uživatel může danou stránku zobrazit), pro což by měl existovat seznam dostupných stránek webu.
  * inicializuje ovladač odpovídající požadované stránce a zavolá funkci pro poskytnutí jeho obsahu, který vypíše uživateli.
* Ovladač pro úvodní stránku (*IntroductionController.class.php*)

----
---
TODO ...


  * třída zajišťující správné vykreslení úvodní stránky.
  * zavolá odpovídající metodu z mod-databaze.class.php a získá data pohádek pro stránku úvodu.
  * předá data pro stránku úvodu do šablony se vzhledem úvodu (view-uvod.class.php), která data zakomponuje do HTML kódu úvodní stránky.
  * kompletní vzhled úvodní stránky vrátí "rozcestníku", tj. do con-index.php.
  
* con-sprava-uzivatelu.class.php
  * obdobné, jako u con-uvod.class.php, pouze pro stránku se správou uživatelů.
  * navíc musí obsloužit případný požadavek na smazání uživatele (pozn.: doporučuji udělat až naposledy).
  

## 2. úkol - vytvoření modelu

* mod-databaze.class.php
  * obsahuje metodu pro získání dat úvodní stránky (DB: orion_mvc_introductions).
  * obsahuje metodu pro získání dat všech uživatelů (DB: orion_mvc_users).
  * obsahuje metodu pro smazání konkrétního uživatele (DB: orion_mvc_users).

* DSN string pro inicializaci připojení k DB prostřednictvím PDO.
  * "mysql:host=$host;dbname=$dbname"



## 4. úkol - ověření funkcionality a hezké URL adresy

* Ověřte, že Vám vše funguje, jak má.
* Prohlédněte si "ukazka.htaccess"
  * aby soubor na webu fungoval, tak musí mít název ".htaccess"
  * aby Vám fungovaly tzv. hezké URL adresy, tak musí být soubor umístěn v Root adresáři webu, tj. localhost/.htaccess nebo www.cokoliv.cz/.htaccess a ne např. students.kiv.zcu.cz/~orion/.htaccess . Na students.kiv.zcu.cz Vám tedy hezké URL adresy fungovat nebudou.
* Pokud vyvíjíte na svém PC, tak zkuste .htaccess nasadit tak, aby Vám hezké URL adresy fungovaly (možných řešení je vícero, viz popisy na internetu).
  * Pozn.: měli byste zajistit, aby Vám fungovaly jak klasické URL adresy, tak i hezké URL adresy současně. URL adresa tedy může vypadat např. localhost/con-index.php?web=uvod nebo localhost/uvod/ (popř. localhost/uvod.html), ale výsledek musí být stejný, tj. zobrazení stránky s úvodem.
  * Pozn.2: Nejspíš budete muset upravit i con-index.php - může se hodit: $url=$_SERVER['REQUEST_URI'];    


## 5. úkol - prohlédněte si oba způsoby řešení

* V každém ze způsobů řešení je ukázán jiný způsob práce s šablonou.
  * 07-PHP-a-MVC-reseni.zip - obsahuje kompletně vypracovaný příklad, přičemž šablona je řešena jako třída s metodami pro výpis hlavičky, patičky a konkrétního obsahu.
  * 07-PHP-a-MVC-reseni_ukazka-jine-prace-s-sablonou.zip - obsahuje pouze výpis úvodní stránky, ale šablona je řešena jako samostatný soubor, který lze "samostatně" testovat (pozn.: pokud by šablona využívala např. Twig, tak její tvůrce nemusí znát PHP).


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :camel:
