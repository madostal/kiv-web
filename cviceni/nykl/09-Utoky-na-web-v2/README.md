# 9. cvičení KIV/WEB - Útoky na web a ochrana webu, 2.verze

* Projděte si prezentaci k tomuto cvičení.
* Může se hodit [Tutoriál SQL](http://www.w3schools.com/sql/default.asp).


## 0. úkol - Zprovoznění dodané aplikace

* Vytvoření databáze:
  * Pokud používáte databázi na *students.kiv.zcu.cz*, tak v souboru _+db_install.sql_ nahraďte všechny výskyty slova "orionlogin"
   za Váš konkrétní orion login.
  * PhpMyAdmin si nechte otevřený pro pozdější použití (mazání úspěšných útoků).
* Zprovoznění aplikace:
  * V souboru _settings.inc.php_ bude nejspíš potřeba upravit přihlašovací údaje k databázi a názvy tabulek.
* Pozn.: příliš se nezaobírejte strukturou aplikace - jedná se spíše o ukázku nevhodné implementace webu, který si "zaslouží být napadnut".


## 1. úkol - Cross-Site Scripting (XSS) útok

* Pozn.: při vypracovávání budete nejspíš potřebovat průběžně mazat nepovedené pokusy z databáze (tabulka návštěvní knihy).
* Zkuste, zda Návštěvní kniha umožní zadat HTML, které bude vykonáno při vypsání příspěvků návštěvní knihy:
  * Zadejte libovolný text, jehož libovolnou část udělejte s využitím HTML tučnou či kurzívní - pokud toto projde, 
  tak jste v podstatě provedli první XSS útok.
* Využijte vstupní prvky Návštěvní knihy a podsuňte webu XSS útokem svou "reklamu":
  * Reklama by se měla trvale zobrazovat v pravém dolním rohu okna prohlížeče, mít pozadí a nápis "Moje reklama".
  * [+] Upravte útočný kód tak, aby při kliknutí myši přesměroval uživatele na zcela jinou stránku, např. www.zcu.cz.
  * [++] Upravte útočný kód tak, aby při najetí myši na reklamu vyskočila hláška (JavaScript Alert) s nápisem "Útok". Pozn.: hlavním problémem nejspíš bude správné použití uvozovek.
* Vytvořte útočný kód, který útočníkovi odešle všechna Cookie uživatele prostřednictvím parametrů URL adresy:
  * Pro příjem dat, jakožto útočník, použijte soubor _hacker-prijem.php_ (prohlédněte si ho), který parametry URL adresy
   ukládá do souboru cookie.txt. 
  
  
### 1.1 úkol - Pro "zkušené" studenty  
  
* Vytvořte útočný kód, který pomyslně nahradí obsah aktuální stránky obsahem stránky např. http://kiv.zcu.cz:
  * Pozn.: lze využít např. IFRAME, kterým nahradíte celý obsah elementu BODY. Může se vám hodit získat velikost obsahu v okně prohlížeče, viz JS: *window.innerHeight-25*.
  * Výsledkem by mělo být, že doména zůstane správná, ale obsah webu bude nahrazen za falešný obsah.
  * Zajistěte, aby se útočný kód vykonal okamžitě po načtení stránky. (Rada: [JS Onload Event](http://www.w3schools.com/jsref/event_onload.asp))
  * *Pozn.: na internetu lze nalézt návody, jak lze získat obsah IFRAME. Pokud bychom jím nahradili obsah aktuální stránky, tak uživatel by neměl zaznamenat žádný problém. Nicméně moderní internetové prohlížeče by toto neměly dovolit.*
* Odstraňte z databáze své útoky, aby vám nevadily v dalších úkolech.


### 1.2 úkol - Ošetření návštěvní knihy proti XSS

* Ošetřete vstupy pro vkládání příspěvků do návštěvní knihy tak, aby skrze ni nešel provést XSS útok.
  * Postačí využít funkci *htmlspecialchars()*.


## 2. úkol - SQL Injection útok

* Sofistikovaný útok SQL Injection prostřednictvím "Zobrazení zvoleného příspěvku":
  * Vychází z [tohoto návodu](https://www.exploit-db.com/papers/13045/), 
  který byl zkopírován do souboru _sql_injection_tutorial.txt_. 
  * Útok provádějte prostřednictvím URL parametrů (přesněji prostřednictvím parametru "prispevek").
* Jednotlivé kroky útoku:
  * Otestujte web na zranitelnost vůči SQL Injection.
  * Zjistěte, který typ komentářů používá databáze napadené stránky.
  * Zjistěte, kolik sloupců má tabulka, jejíž data jsou vypisována při zobrazení zvoleného příspěvku.
  * Otestujte, zda v databázi funguje dotaz UNION, který slouží pro sloučení dat 
  z vícera tabulek se stejným počtem sloupců (počet sloupců aktuální tabulky už známe).
  * Zjistěte verzi typ databáze a její verzi.
  * Zjistěte názvy uživatelských tabulek napadané databáze.
  * Zjistěte názvy sloupců v tabulce s daty uživatelů.
  * Zjistěte login a heslo administrátora.
    * Předpokládejme, že jste si nejprve prošli tabulku s právy uživatelů 
    a zjistili, že právo administrátora má ID=1.
  * Přihlaste se do aplikace jako administrátor, tj. *"převezměte vládu na daným webem"*.
  

### 2.1. úkol - Ošetřete stránku před útoky typu XSS a SQL Injection

* Ošetřete všechny databázové dotazy tak, aby neumožňovaly provedení útoku typu SQL Injection.
  * Použijte předpřipravené dotazy např. využitím PDO. 


## 3. úkol - Ukázka dvou reálných útoků, které se dostaly na mé weby

* Hlavním cílem ukázky je spíše ukázat, jak také může vypadat PHP kód.
* Ukázky jsou obsaženy v adresáři "Ukázky reálných útoků".
  * Obsažena je vždy přesná kopie napadeného souboru (označena *útok*) 
  a soubor s rozkódovaným útokem (značen *rozkodovani*). 
    * V případě 01 je rozkódování snadné a poučné.
    * V případe 02 je uveden jen pokus o rozkódování, 
    který není kvůli obsáhlosti útočného kódu dokončen - plné rozkódování by bylo lepší 
    nedělat manuálně, ale pomoci si programově (*jsme IT a umíme si pomoci*). 
* Útok 01
  * Pěkná ukázka útoku na server. 
  * Nevím, jak se mi tento kód dostal na web, protože web neobsahuje vůbec žádné vstupy uživatele a pouze vypisuje statický obsah.
* Útok 02 
  * Ukázkový soubor index-utok.php je souborem spouštějícím Drupa
  * Spíše ukázka sofistikovaného ukrytí útočného kódu do PHP.
  
### 3.1 - [dobrovolně] Bonusové body ke zkoušce

* Ten, kdo první získá alespoň čitelný kód útoku 02 a ideálně se pokusí určit, 
co daný kód dělá, získá **5 bodů** k samostatné práci.


## Úkoly na doma

* Doporučuji prohlédnout si následující texty: [SQL Injection - úvod](https://www.owasp.org/index.php/SQL_Injection), [Testing for SQL Injection](https://www.owasp.org/index.php/Testing_for_SQL_Injection_(OTG-INPVAL-005)), [SQL Injection Prevention Cheat Sheet](https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet).
  * Různé další typy útoků: [Types of application security attacks](https://www.owasp.org/index.php/Category:Attack).
* Na W3Schools doporučuji prohlédnout si: 
  [Validace formulářů](https://www.w3schools.com/php/php_form_validation.asp) a
  [Předpřipravené dotazy](https://www.w3schools.com/php/php_mysql_prepared_statements.asp).


## Výstupy cvičení

* Student ví, co znamenají útoky typu XSS (cross-site scripting) a SQL Injection.
  * Student umí využít zranitelnosti webové stránky pro tyto dva typy útoků.
  * Student umí ošetřit vstupy webové stránky tak, aby na ní tyto útoky nemohly být provedeny.
* Student ví, jaký je rozdíl mezi útoky typu DOS a DDOS.
* **Semestrální práce** - student by nyní měl být schopen ošetřit vstupy své webové stránky 
proti útokům typu XSS a SQL Injection.    


:+1:


### Poznámky

* V případě použití těchto ukázek jinde, než na stránce příslušné k dnešnímu cvičení, nenese cvičící ani nikdo ze ZČU odpovědnost za vaše činy.
* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :bug:
