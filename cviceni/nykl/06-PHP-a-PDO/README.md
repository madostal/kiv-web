# 6. cvičení KIV/WEB - PHP a práce s databází (PDO).

* Projděte si prezentaci k tomuto cvičení.
* Při vypracovávání se Vám může hodit [Tutoriál SQL](https://www.w3schools.com/sql/default.asp).


## 0. úkol - Zprovoznění webové aplikace 

* Prohlédněte si a zprovozněte dodané soubory - požadavkem je, aby vám fungovaly odkazy v menu: 
  * Vstupním bodem do aplikace je *index.php*, který načítá jednotlivé stránky webu.
  * Soubor s nastavením *settings.inc.php* obsahuje konfiguraci připojení k databázi 
  a konfiguraci souborů jednotlivých stránek webu.


## 1. úkol - Návrh schématu databáze a import databáze

* ERA model databáze:

![ERA model databáze](_ERA_model_databaze.png)
    
* Protože tento úkol se přímo netýká PHP, tak ho lze vyřešit více způsoby:
  * Kompletní návrh databáze, tj. návrh celého schématu databáze např. v MySQL Workbench. (nejnáročnější)
  * Úprava souboru pro MySQL Workbench.
  * Úprava pouze souboru pro import schématu databáze. (nejlehčí)


* Kompletní návrh databáze:
  * V nástroji MySQL Workbench navrhněte schéma databáze:
    * Pouze tabulky UZIVATEL a PRAVO s relací 1:N. Znaková sada celé databáze nebo jednotlivých tabulek bude **utf8_czech_ci** (*ci* říká, že porovnávání znaků bude *case insensitive*).
    * Atributy tabulek a jejich datové typy nastavte dle přiloženého obrázku.
    * **Pokud pracujete na *students.kiv.zcu.cz***, tak názvy tabulek musí mít předponu s Vaším orionloginem (např.: nyklm_uzivatel a nyklm_pravo).
  * Naplňte databázi základními daty:
    * V tabulce s právy uživatelů vytvořte 4 práva, např.: SuperAdmin, Admin, Recenzent a Autor.
    * V tabulce s jednotlivými uživateli vytvořte alespoň jednoho uživatele, který bude mít právo SuperAdmin.
  * Exportujte SQL skript pro instalaci databáze. Při exportu zvolte následující volby:
    * *Generate DROP Statements* ... - smazání v databázi dříve vytvořených tabulek stejných názvů.
    * *Omit SCHEMA* ... - vynechat z názvu tabulek název databáze.
    * *Generate INSERT* ... - exportovat i defaultní data tabulek, tj. práva a uživatele.


* Úprava souboru pro MySQL Workbench:
  * Využijte soubor *db_install-reseni-MySQLWorkBench.mwb* a upravte ho. 
    * Např. upravte předpony názvů tabulek.
  * Exportujte SQL skript pro instalaci databáze. Při exportu zvolte následující volby:
    * *Generate DROP Statements* ... - smazání v databázi dříve vytvořených tabulek stejných názvů.
    * *Omit SCHEMA* ... - vynechat z názvu tabulek název databáze.
    * *Generate INSERT* ... - exportovat i defaultní data tabulek, tj. práva a uživatele.


* Úprava pouze souboru pro import schématu databáze:
  * Využijte soubor *db_install-reseni.sql* a upravte ho.
    * Např. upravte předpony názvů tabulek.
    

### Import databáze
* Přihlašte se do správy databáze, např. do nástroje PhpMyAdmin:
  * Buďto na https://students.kiv.zcu.cz/phpmyadmin/ (tj. students.kiv.zcu.cz -> PhpMyAdmin).
    * Přihlašovací údaje Vám poskytne vyučující.
    * Pokud s databází chcete pracovat mimo prostředí ZČU, tak musíte využít VPN (viz [návod](https://support.zcu.cz/index.php/VPN)).
  * Nebo lokální (např. viz kontextové nabídky nástrojů Wamp, Xampp apod.).
    * Uživatel **root** a heslo buď **žádné**, nebo **root**.
* Pokud nemáte, tak si založte novou databázi, např. *kivweb*, a nastavte jí znakovou sadu **utf8_czech_ci**.
* Importujte vytvořené schéma databáze do dané databáze a pohledem ověřte, že se Vám vše importovalo.


## 2. úkol - Připojení k databázi a výpis aktuálních uživatelů aplikace

* Prohlédněte si soubor *settings.inc.php* a doplňte mu chybějící údaje (tj. přístupové údaje k databázi a názvy vytvořených tabulek).
* V souboru *database.class.php* vytvořte objekt, který bude spravovat přístup k databázi.
  * Vytvořte privátní atribut objektu, který bude obsahovat referenci na instanci třídy PDO pro přístup k databázi, a v konstruktoru ho inicializujte.
    * Pokud z databáze není správně čten text v kódování UTF-8, tak pod inicializaci doplňte následující kód: *$this->???->exec("set names utf8")*;
  * Vytvořte obecnou funkci pro **SQL Select**, která umožní získat z databáze jak všechny řádky zvolené tabulky, tak i jen jeden konkrétní řádek tabulky.
    * Následně z dané funkce extrahujte/dekomponujte obecnou funkci pro vykonání dotazu v databázi (tj. abyste nemuseli při každém SQL dotazu zapisovat stejnou část kódu).
  * Vytvořte funkci, která z databáze přečte všechny uživatele řazené dle jejich ID,
    a ve stránce se správou uživatelů (soubor *user-management*) všechny uživatele vypište.


## 3. úkol - Registrace uživatele

  * Vytvořte funkci, která z databáze přečte všechna práva řazená dle jejich ID,
    a ve stránce s registrací uživatele (soubor *user-registration*) všechny role vypište.
  * Vytvořte obecnou funkci pro **SQL Insert**, která umožní vložit jeden řádek do databázové tabulky.
  * Vytvořte funkci pro vložení nového uživatele do databáze a použijte ji na stránce 
    s registrací uživatele.
    
    
## 4. úkol - Úprava osobních údajů uživatele  
 
  * Vytvořte obecnou funkci pro **SQL Update**, která umožní upravovat řádky databázové tabulky.
  * Vytvořte funkci pro úpravu dat uživatele v databázi a použijte ji na stránce 
    se správou osobních údajů uživatele (soubor *user-update*). 
    * Pro testování si zvolte ID jednoho uživatele a toho upravujte.
    * Do formuláře vždy vypisujte aktuální data uživatele.
 
 
## 5. úkol - Smazání uživatele
  
  * Vytvořte obecnou funkci pro **SQL Delete**, která umožní mazat řádky databázové tabulky.
  * Doplňte správu uživatelů aplikace (soubor *user-management*) o možnost mazání uživatelů (pozn.: stačí jednotlivě).
  
  
## 6. úkol - Přihlášení/Odhlášení uživatele a dokončení všech stránek
  
  * Jakýmkoliv způsobem implementujte přihlášení a odhlášení uživatele, viz předchozí cvičení, 
  a zakomponujte ho do příslušné stránky.
    * Lze využít objekt MySession z předchozího cvičení.
    * V ukázkovém řešení je správa přihlášení uživatele součástí třídy MyDatabase,
    ale v samostatné práci by měla být ve vlastní třídě.
    * Pozn.: hesla by správně měla být v DB uložena šifrovaná, k čemuž lze využít 
    např. algoritmus BCrypt, tj. funkci [password_hash($password, PASSWORD_BCRYPT)](http://php.net/manual/en/function.password-hash.php) 
    pro šifrování a funkci [password_verify($password, $hash)](https://www.php.net/manual/en/function.password-verify.php) pro porovnání zadaného a šifrovaného hesla. 
    Pozn.: PASSWORD_BCRYPT produkuje 60-ti znakový hash (nutné s tím počítat při návrhu databáze).
  * Zakomponujte ověření přihlášení uživatele do všech stránek vytvořeného webu.
    * Registrovat se smí jen nepřihlášený uživatel.
    * Správa osobních údajů umožňuje upravit údaje právě přihlášeného uživatele.
    * Správa uživatelů je dostupná pouze uživatelům s právem *Admin* nebo *SuperAdmin*.  


## Úkoly na doma
* Doporučuji podívat se alespoň na následující stránky [MySQL Database tutoriálu na W3Schools](https://www.w3schools.com/php/php_mysql_intro.asp):
  * Všímejte si částí s návodem na PDO !!
  * MySQL Connect, MySQL Insert Data, MySQL Get Last ID.
  * MySQL Select Data, MySQL Delete Data, MySQL Update Data, MySQL Limit Data (pozn.: nemusí fungovat ve všech databázových systémech).
* Pokud neznáte jazyk SQL, tak doporučuji projít si alespoň následující stránky z [SQL tutoriálu na W3Schools](https://www.w3schools.com/sql/default.asp): 
  * CRUD operace - SQL Insert Into *(tj. create)*, SQL Select *(tj. read)*, SQL Updata, SQL Delete. 
  * Podmínky a řazení - SQL Where, SQL And-Or-Not, SQL Like, SQL In, SQL Order By.
  * Práce s tabulkou - SQL Create Table, SQL Alter Table, SQL Drop Table.
  
  
## Výstupy cvičení
* Student by měl umět připojit PHP aplikaci k databázi, např. využitím PDO.
* Student by měl umět použít v PHP databázové CRUD operace, tj. vytváření, čtení, úpravu a mazání řádek tabulky.
* **Semestrální práce** - student by nyní měl být schopen:
  * připravit si třídu pro práci s databází (zatím bez ošetření SQL Injection).
  * dokončit si třídy spravující přihlášení uživatele.
  * připravit si téměř všechny funkce pro práci s databází, tj. ty, které využijete v SP.
    * Pozor, funkce se trochu změní, až si ukážeme, jak se bránit útokům typu SQL Injection (9. cvičení).   
  

:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :fish:
