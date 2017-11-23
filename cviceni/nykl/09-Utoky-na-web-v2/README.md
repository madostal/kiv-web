# 9. cvičení KIV/WEB - Útoky na web a ochrana webu, 2.verze

* Tato verze vychází z 1. verze a popisuje pouze sofistikovanější způsob SQL Injection.
  * V řešení příkladu jsou uvedeny pouze útoky, přičemž obrana proti nim je stejná jako v 1. verzi.
* Projděte si prezentaci k tomuto cvičení.
* Může se hodit - [Tutoriál SQL](http://www.w3schools.com/sql/default.asp).


## 0. úkol - zprovozněte si dodanou aplikaci

* Pozor aplikace ve 2. verzi má trochu jiné chování než v 1. verzi, ale databáze jsou totožné. 
* Vytvoření databáze:
  * Pokud používáte databázi na students.kiv.zcu.cz, tak v souboru _+db_install.sql_ nahraďte všechny výskyty slova "username" za Váš orion login.
  * PhpMyAdmin si nechte otevřený pro pozdější použití.
* Zprovozněte zbytek aplikace.
  * V souboru _settings.inc.php_ bude nejspíš potřeba upravit přihlašovací údaje k databázi a názvy tabulek.
* Pokud se Vám nebude na webu správně zobrazovat čeština, tak to aktuálně nevadí (nejspíš se jedná o konfliktní nastavení databáze).
* Pozn.: příliš se nezaobírejte strukturou aplikace. Jde spíše o ukázku nevhodné implementace webu, ale pro naše účely je dostatečná.


## 1. úkol - Cross-Site Scripting (XSS) útok

* Využijte vstupní prvky Návštěvní knihy a podsuňte webu XSS útokem svou reklamu.
  * Pozn.: při vypracovávání budete nejspíš potřebovat průběžně mazat nepovedené pokusy z databáze.
  * Reklama by se měla zobrazovat v pravém dolním rohu prohlížeče, mít pozadí a nápis "Moje reklama".
  * Upravte útočný kód tak, aby při najetí myši na vložený prvek vyskočila hláška (JavaScript Alert) s nápisem "Útok". Pozn.: hlavním problémem nejspíš bude použití uvozovek.
  * Upravte útočný kód tak, aby při kliknutí myši přesměroval uživatele na zcela jinou stránku, např. www.zcu.cz.
  * Kód útoku si uschovejte pro pozdější použití.
* (Pro "zkušené", nechte si nakonec) Upravte útočný kód nebo vytvořte nový, který nahradí obsah aktuální stránky obsahem stránky např. www.zcu.cz
  * Pozn.: lze využít např. IFRAME, kterým nahradíte celý obsah elementu BODY. Může se Vám hodit: (window.innerHeight-25) - získání velikosti okna pro obsah prohlížeče.
  * Výsledkem by mělo být, že doména zůstane správná, ale obsah webu bude nahrazen za falešný obsah.
  * Pokuste se propašovat kód do stránky tak, aby se vykonal okamžitě po načtení stránky. (Rada: [JS Onload Event](http://www.w3schools.com/jsref/event_onload.asp))
  * Pozn.: na internetu lze nalézt návody, jak získat obsah IFRAME. Pokud bychom jím nahradili obsah aktuální stránky, tak v mnoha případech získáme identický vzhled vložené stránky. Nicméně moderní internetové prohlížeče by toto neměly dovolit.
* Pokuste se odeslat na soubor _prijem.php_ všechna Cookies dané stránky.
* Odstraňte z databáze své útoky, aby Vám nevadily v dalších úkolech (zvláště úkol pro "zkušené").


## 2. úkol - SQL Injection útok

* Liší se oproti 1. verzi (lze si vyzkoušet i úkol popsaný v ní, aplikaci můžete použít stejnou).
* Sofistikovaný útok SQL Injection:
  * Vychází z [tohoto návodu](https://www.exploit-db.com/papers/13045/), který byl zkopírován do souboru _sql_injection_tutorial.txt_. 
  * Otestujte web na zranitelnost vůči SQL Injection.
  * Zjistěte, který typ komentářů používá DB napadené stránky.
  * Zjistěte, kolik sloupců má tabulka, ze které povedete svůj útok.
  * Otestujte, zda funguje dotaz UNION na sloučení vícera tabulek se stejným počtem sloupců (počet sloupců aktuální tabulky už známe).
  * Zjistěte verzi MySQL.
  * Zjistěte názvy tabulek napadané DB.
  * Zjistěte názvy sloupců v tabulce s uživateli.
  * Zjistěte login a heslo administrátora.
    * Předpokládejme, že jste si nejprve prošli tabulku s právy uživatelů a zjistili, že právo administrátora má id 1.
  * Přihlaste se do aplikace jako administrátor.
  

## 3. úkol - ošetřete stránku před útoky typu XSS a SQL Injection

* Viz 1. verze tohoto cvičení.


## 4. úkol - dobrovolně

* Prohlédněte si následující texty: [SQL Injection - úvod](https://www.owasp.org/index.php/SQL_Injection), [Testing for SQL Injection](https://www.owasp.org/index.php/Testing_for_SQL_Injection_(OTG-INPVAL-005)), [SQL Injection Prevention Cheat Sheet](https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet).
* Různé další typy útoků: [Types of application security attacks](https://www.owasp.org/index.php/Category:Attack).



## PROSBA CVIČÍCÍHO




:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :bug:
