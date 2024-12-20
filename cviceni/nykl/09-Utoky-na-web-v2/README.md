# 9. cvičení KIV/WEB - Útoky na web a ochrana webu, 2.verze

* Projděte si prezentaci k tomuto cvičení.
* Může se hodit [Tutoriál SQL](http://www.w3schools.com/sql/default.asp).


## 0. úkol - Zprovoznění dodané aplikace

* Vytvoření databáze:
  * Pokud používáte databázi na *students.kiv.zcu.cz*, tak v souboru _+db_install.sql_ nahraďte všechny výskyty slova _"orionlogin"_
   za Váš konkrétní orion login.
  * *PhpMyAdmin* si nechte otevřený pro pozdější použití (mazání úspěšných útoků).
* Zprovoznění aplikace:
  * V souboru _settings.inc.php_ bude nejspíš potřeba upravit přihlašovací údaje k databázi a názvy tabulek.
* Poznámka: příliš se nezaobírejte strukturou aplikace - jedná se spíše o ukázku nevhodné implementace webu.


## 1. úkol - Cross-Site Scripting (XSS) útok

* Poznámka: při vypracovávání budete nejspíš potřebovat průběžně mazat své pokusy/útoky z databáze (tabulka návštěvní knihy).
* Zkuste, zda *Návštěvní kniha* umožní zadat HTML, které bude vykonáno při vypsání příspěvků návštěvní knihy:
  * Zadejte libovolný text, jehož část udělejte s využitím HTML tučnou či kurzívní - pokud toto projde, 
  tak jste v podstatě provedli první XSS útok.
* Využijte vstupní prvky *Návštěvní knihy* a podsuňte webu XSS útokem svou "reklamu":
  * Reklama by se měla trvale zobrazovat v pravém dolním rohu okna prohlížeče, mít pozadí a nápis "Moje reklama".
  * [+] Upravte útočný kód tak, aby při kliknutí myši přesměroval uživatele na zcela jinou stránku, např. www.zcu.cz.
  * [++] Upravte útočný kód tak, aby při najetí myši na reklamu vyskočila hláška (JavaScript Alert) s nápisem "Útok". 
  * Pozor: hlavním problémem nejspíš bude správné zvolení uvozovek či apostrofů, 
  protože jeden typ je použit v SQL dotazu na serveru, a proto v útočném kódu musíme použít druhý typ.
* Vložte do stránky útočný kód, který útočníkovi odešle všechna Cookie uživatele z dané stránky:
  * Pro příjem dat, jakožto útočník, použijte soubor _hacker-prijem.php_ (prohlédněte si ho), 
  který parametry URL adresy i s hodnotami ukládá do lokálního souboru _cookie.txt_.
  * Pozor: na _students.kiv.zcu.cz_ lze programově vytvářet soubory pouze v adresáři _data_, 
  tj. přesuňte soubor _hacker-prijem.php_ do tohoto adresáře.
  
  
### 1.1 úkol - Pro "zkušené" studenty  
  
* Vytvořte útočný kód, který pomyslně nahradí obsah aktuální stránky obsahem stránky např. http://kiv.zcu.cz:
  * Pozn.: lze využít např. HTML element *IFRAME*, kterým nahradíte celý obsah elementu BODY. 
  Může se vám hodit získat velikost obsahu v okně prohlížeče, viz JS: *window.innerHeight-25*.
  * Výsledkem by mělo být, že doména zůstane správná, ale obsah webu bude nahrazen za falešný obsah.
  * Zajistěte, aby se útočný kód vykonal okamžitě po načtení stránky. 
  (Rada: [JS Onload Event](http://www.w3schools.com/jsref/event_onload.asp))
  * *Pozn.: na internetu lze nalézt návody, jak lze získat obsah IFRAME. 
  Pokud bychom jím nahradili obsah aktuální stránky, tak uživatel by měl vidět pouze útočnou stránku 
  a neměl by zaznamenat žádný problém. Nicméně moderní internetové prohlížeče by toto neměly dovolit.*
* Odstraňte z databáze své útoky, aby vám nevadily v dalších úkolech.


### 1.2 úkol - Ošetření návštěvní knihy proti XSS

* Ošetřete vstupy pro vkládání příspěvků do návštěvní knihy tak, aby skrze ni nešel provést XSS útok.
  * Postačí využít funkci *htmlspecialchars()*.


## 2. úkol - SQL Injection útok

* Sofistikovaný útok SQL Injection prostřednictvím _"Zobrazení zvoleného příspěvku"_:
  * Řešení příkladu vychází z [tohoto návodu](https://www.exploit-db.com/papers/13045/), 
  který byl zkopírován do souboru _sql_injection_tutorial.txt_. 
  * Útok provádějte prostřednictvím parametrů URL adresy  (přesněji prostřednictvím parametru *prispevek*).
* Jednotlivé kroky útoku:
  * Otestujte web na zranitelnost vůči SQL Injection.
  * Zjistěte, který typ komentářů používá databáze napadené stránky.
  * Zjistěte, kolik sloupců používá select dotaz, jehož data jsou vypisována při zobrazení zvoleného příspěvku.
  * Otestujte, zda v databázi funguje dotaz *UNION*, který slouží pro sloučení dat 
  z vícera select dotazů, které mají stejný počet sloupců (počet sloupců aktuálního dotazu už známe).
  * Zjistěte typ databáze a její verzi.
  * Zjistěte názvy uživatelských tabulek napadané databáze.
  * Zjistěte názvy sloupců v tabulce s daty uživatelů.
  * Zjistěte login a heslo administrátora.
    * Předpokládejme, že jste si nejprve prošli tabulku s právy uživatelů 
    a zjistili, že právo administrátora má *idpravo=1*.
  * Přihlašte se do aplikace jako administrátor, tj. *"převezměte vládu nad daným webem"*.
  

### 2.1. úkol - Ošetřete stránku před útoky typu SQL Injection

* Ošetřete všechny databázové dotazy tak, aby neumožňovaly provedení útoku typu SQL Injection.
  * Použijte předpřipravené dotazy (*prepared statements*) např. využitím PDO.
  * Zkuste bindovat proměnné do SQL dotazu předáním reference do paměti i předáním hodnoty - měli
  byste vědět, jaký je v tom rozdíl.
  * Ověřte, že již nelze provést SQL Injection útok.


## 3. úkol - Ukázka dvou reálných útoků, které se dostaly na mé weby

* Hlavním cílem ukázky je spíše demonstrovat, jak také může vypadat PHP kód.
* Ukázky jsou obsaženy v adresáři *"Ukázky reálných útoků"*:
  * Obsažena je vždy přesná kopie napadeného souboru (označena *útok*) 
  a soubor s rozkódovaným útokem (značen *rozkodovani*). 
    * V případě 01 je rozkódování snadné a poučné.
    * V případe 02 je uveden jen pokus o rozkódování, 
    který není kvůli obsáhlosti útočného kódu dokončen - plné rozkódování by bylo lepší 
    nedělat manuálně, ale pomoci si programově (*jsme IT a umíme si pomoci*). 
* ___Pozor: některé antiviry nedovolí uložit soubory s útoky do vlastního PC.___
* Útok 01
  * Pěkná ukázka útoku na server. 
* Útok 02 
  * Ukázkový soubor _index-utok.php_ je souborem spouštějícím redakční systém Drupal.
  * Spíše ukázka sofistikovaného ukrytí útočného kódu do PHP.

<strike>  
<b>3.1 - [dobrovolně] Bonusové body ke zkoušce</b>

* Ten, kdo první získá alespoň čitelný kód útoku 02 a ideálně se pokusí určit, 
co daný kód dělá, získá **5 bodů** k samostatné práci.
</strike>


* Bonusové body za rozkódování útoku 02 pouze po předchozí domluvě.


## Úkoly na doma

* Doporučuji prohlédnout si následující texty: 
[SQL Injection - úvod](https://www.owasp.org/index.php/SQL_Injection), 
[Testing for SQL Injection](https://www.owasp.org/index.php/Testing_for_SQL_Injection_(OTG-INPVAL-005)), 
[SQL Injection Prevention Cheat Sheet](https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet).
  * Popis různých dalších typů útoků: [Types of application security attacks](https://www.owasp.org/index.php/Category:Attack).
* Na W3Schools doporučuji prohlédnout si: 
  [Validace formulářů](https://www.w3schools.com/php/php_form_validation.asp) a
  [Předpřipravené dotazy](https://www.w3schools.com/php/php_mysql_prepared_statements.asp).


## Výstupy cvičení

* Student ví, co obnáší útoky typu *XSS* (*Cross-Site Scripting*) a *SQL Injection*.
  * Student umí využít zranitelnosti webové stránky pro tyto dva typy útoků.
  * Student umí ošetřit vstupy webové stránky tak, aby na ní tyto útoky nemohly být provedeny.
* Student rozumí rozdílu mezi _"bindováním parametrů"_ a _"bindováním hodnot"_ 
funkcemi *bindParam()* (tj. předání reference do paměti) a *bindValue()* (tj. předání hodnoty). 
* Student ví, jaký je rozdíl mezi útoky typu DOS a DDOS.
* **Semestrální práce** - student by nyní měl být schopen ošetřit vstupní prvky své webové stránky 
proti útokům typu XSS a SQL Injection.    


:+1:


### Poznámky

* __V případě použití těchto ukázek útoků jinde, než na stránce příslušné k dnešnímu cvičení, nenese cvičící ani nikdo ze ZČU odpovědnost za Vaše činy.__
* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :turtle:
