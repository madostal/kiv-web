# 6. cvičení KIV/WEB - PHP a práce s databází (PDO).

* Projděte si prezentaci k tomuto cvičení.
* Prohlédněte si a zprovozněte dodané soubory - vstupním bodem do aplikace je index.php, kterému se podstrkují indexy stránek pro zobrazení, viz settings.inc.php.
  * Požadavkem je, aby Vám fungovaly odkazy v menu.
* Může se hodit - [tutoriál SQL](http://www.w3schools.com/sql/default.asp), zvláště části Select, Insert, Update, Delete.
* Pozn.: na vypracování následujících úkolů Vám nejspíš nebude stačit čas cvičení. Ve vlastním zájmu si ho dodělejte doma, nebo si alespoň prohlédněte soubory s řešením.
* V případě nejasností se ptejte - raději dříve, než trávit čas dlouhým přemýšlením.

## 1. úkol - návrh databáze

* Protože tento úkol se přímo netýká PHP, tak ho lze řešit více způsoby.
  * Kompletní řešení - návrh celé DB v MySQL Workbench. (nejdelší)
  * Úprava souboru pro MySQL Workbench.
  * Úprava souboru pro import do DB. (nejkratší)


* Kompletní řešení:
  * V nástroji MySQL Workbench navrhněte zjednodušené schéma databáze.
    * Dvě tabulky (uživatelé a práva) s příslušnou relací (atributy tabulek lze využít z prezentace či z přiloženého obrázku).
    * **! názvy tabulek musí mít předponu s Vaším orionloginem** (např.: nyklm_uzivatele a nyklm_prava).
  * Naplňte databázi základními daty.
    * V tabulce "práva" vytvořte 3 práva: Administrátor, Recenzent, Autor.
    * V tabulce "uživatelé" vytvořte jednoho uživatele, který bude administrátor.
  * Vygenerujte SQL skript pro instalaci databáze. Při exportu zvolte následující:
    * Generate DROP Statements .. - smazání dříve vytvořených tabulek stejného názvu.
    * Omit SCHEMA .. - bez názvu databáze.
    * Generate INSERT .. - vložení dat.


* Úprava souboru pro MySQL Workbench:
  * Využijte soubor db_install-reseni-MySQLWorkBench.mwb a upravte ho. 
    * Zvláště je potřeba upravit názvy tabulek.
  * Vygenerujte SQL skript pro instalaci databáze. Při exportu zvolte následující:
    * Generate DROP Statements .. - smazání dříve vytvořených tabulek stejného názvu.
    * Omit SCHEMA .. - bez názvu databáze.
    * Generate INSERT .. - vložení dat.


* Úprava souboru pro import do DB:
  * Využijte soubor db_install-reseni.sql a upravte ho.
    * Zvláště je potřeba upravit názvy tabulek.
    

* **Vždy**:
  * Přihlaste se k databázi https://students.kiv.zcu.cz/phpmyadmin/ (tj. students.kiv.zcu.cz -> PhpMyAdmin).
    * Přihlašovací údaje Vám poskytne vyučující.
  * Importujte vytvořené schéma do dané databáze a ověřte si, že se Vám vše importovalo.


## 2. úkol - výpis práv uživatele

* Do souboru settings.inc.php doplňte chybějící informace.
* V souboru database.class.php vytvořte objekt, který bude spravovat přihlášení uživatele a přístup k databázi (pozn.: v SP by tato funkcionalita měla být rozdělena do dvou tříd).
  * Vytvořte privátní proměnnou, která bude obsahovat referenci na instanci třídy PDO, a v konstruktoru do dané proměnné uložte aktivní "připojení" k databázi.
  * Při používání proměnných ze souboru settings-reseni.php nezapomeňte říci, že jsou globální ("slůvko": global).
* Doplňte třídu o metodu poskytující všechny informace z tabulky "práva".
* V souborech user-update.php a user-registration.php vyplňte selectboxy právy získanými z DB tak, aby v daných formulářích šla práva volit.
  * Práci si můžete ulehčit doplněním metody do zaklad.php
  * Pozn.: zanedbejte skutečnost, že právo si volí sám uživatel už při registraci a může si zvolit např. právo Administrátor (pro tento příklad je to v pořádku).


## 3. úkol - registrace a login uživatele

* Doplňte soubor database.class.php o následující funkce (nezapomeňte na session pro právě přihlášeného uživatele):
  * Porovnání dodaného loginu a hesla uživatele s loginem a heslem uloženým v databázi.
  * Přihlášení uživatele.
  * Odhlášení uživatele.
  * Ověření přihlášení uživatele, tj. je uživatel přihlášen nebo není.
  * Vytvoření záznamu o novém uživateli v DB.  
* Zprovozněte soubor login.php tak, aby fungoval, tj. umožnil přihlásit a odhlásit uživatele (v DB byste měli mít jednoho uživatele pro testování). Nezapomeňte ověřit, že se vložené heslo shoduje s heslem v databázi.
* Zprovozněte soubor user-registration.php tak, aby fungoval, jak má, tj.:
  * Přihlášený uživatel nemůže dělat nic.
  * Nepřihlášený uživatel se může registrovat, přičemž po úspěšné registraci je automaticky i přihlášen.
    * Pozor: login musí být unikátní, tj. pokud ho nekotrolujete v DB (např. vlastnost Unique), tak musíte "někde" zde.


## 4. úkol - změna údajů uživatele

* Doplňte soubor database.class.php o následující funkce:
  * Získání všech informací o uživateli, včetně jeho práva.
  * Změna dat uživatele (update).
* Zprovozněte soubor user-update.php tak, aby fungoval, jak má, tj.:
  * Nepřihlášený uživatel nevidí formulář.
  * Přihlášený uživatel vidí formulář vyplněný jeho údaji a může je libovolně měnit.
    * Před změnou by mělo být ověřeno, že uživatel vložil správně původní heslo.
    * Pokud nejsou zadána nová hesla, tak zůstává heslo staré.
   
   
## 5. úkol - správa uživatelů

* Doplňte soubor database.class.php o následující funkce:
  * Získání informací o všech uživatelích.
  * Mazání konkrétního uživatele.
* Zprovozněte soubor user-management.php tak, aby fungoval, jak má, tj.:
  * Nepřihlášenému uživateli zobrazil, že je stránka jen pro přihlášené.
  * Přihlášenému uživateli, který nemá právo Administrátor, zobrazil, že stránka je dostupná jen administrátorům.
  * Administrátorovi zobrazil tabulku s výpisem uživatelů.
    * V tabulce nebude zobrazen aktuálně přihlášený uživatel (aby nemohl smazat sám sebe).
    * U každého uživatele bude funkční tlačítko "smazat uživatele", které daného uživatele odstraní z DB.




* Prohlédněte si přiložené řešení příkladu (možná Vám rozšíří obzor). 
* Pokud naleznete nějakou chybu nebo myslíte, že něco lze vyřešit lépe, tak se mi prosím přihlaste - rád uvidím lepší řešení.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :fish: