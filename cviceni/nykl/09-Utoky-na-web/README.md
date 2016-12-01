# 9. cvičení KIV/WEB - Útoky na web a ochrana webu

* Projděte si prezentaci k tomuto cvičení.
* Může se hodit - [Tutoriál SQL](http://www.w3schools.com/sql/default.asp).


## 0. úkol - zprovozněte si dodanou aplikaci

* Vytvoření databáze
  * Pokud používáte databázi na students.kiv.zcu.cz, tak v souboru "DB-instal/+db_install.sql" nahraďte všechny výskyty slova "username" za Váš orion login.
  * PhpMyAdmin si nechte otevřený pro pozdější použití.
* Zprovozněte zbytek aplikace
  * V souboru settings.inc.php bude nejspíš potřeba upravit přihlašovací údaje k databázi a názvy tabulek.
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
* Odstraňte z databáze Vaše útoky, aby Vám nevadily v dalších úkolech (zvláště úkol pro "Zkušené").


## 2. úkol - SQL injection útok

* Získejte výpis všech uživatelů, včetně jejich hesel.
  * Rada: použijte vstupní pole pro zadání hesla ve formuláři s přihlášením uživatelů.
  * Nyní se můžete přihlásit s účtem administrátora, ale nedělejte to.
* Zaregistrujte se a následně si využitím SQL injection změňte své právo na "administrátor", tj. idprava=1.
  * Pozn.1: databáze sice vrátí výsledek pouze prvního z dotazů, ale provede všechny dotazy, které jí zadáte.
  * Pozn.2: název tabulky je "username_uzivatele". V praxi bychom ho museli nejprve zjistit.
* Smažte z databáze všechny uživatele kromě sebe.
  * Vynecháme příklad s útokem mazajícím tabulku (abyste omylem nesmazali tabulky někomu jinému).
  * Pokud vyvíjíte na vlastním PC, tak si můžete zkusit SQL dotaz DROP TABLE, ale následně už se ke stránce nepřihlásíte.


## 3. úkol - ošetřete stránku před útoky typu XSS a SQL injection

* Úpravy stačí provádět v souboru databaze.class.php
* Zkuste si ošetřit některé vstupní prvky před XSS a SQL injection útoky.
  * XSS lze ošetřit převedením HTML tagů na značky začínající &, např. &lt; &gt apod. (Test např. na návštěvní knize.)
  * SQL injection lze ošetřit tzv. předpřipravenými dotazy (což PDO umožňuje). (Test např. na přihlášení uživatele.)
* Obecně je dobré:
  * Omezovat velikost vstupních prvků (minimální ochrana).
  * K číslům přičítat 0.
  * Používat předpřipravené dotazy.
  * Používat převody HTML tagů na speciální znaky.
  * Používat v SQL dotazech tzv. backticks, např.: SELECT * FROM `username_uzivatele` WHERE `iduzivatel`=...
    * Jedná se o [symbol zpětného apostrofu](https://en.wiktionary.org/wiki/backtick) (Readme na GitHubu je ale nezobrazuje).
    * Umožňuje nejspíš pouze MySQL.


## 4. úkol - dobrovolně

* Prohlédněte si následující texty: [SQL Injection - úvod](https://www.owasp.org/index.php/SQL_Injection), [Testing for SQL Injection](https://www.owasp.org/index.php/Testing_for_SQL_Injection_(OTG-INPVAL-005)), [SQL Injection Prevention Cheat Sheet](https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet).
* Různé další typy útoků: [Types of application security attacks](https://www.owasp.org/index.php/Category:Attack).



## PROSBA CVIČÍCÍHO

* Prosím vás, abyste dané útoky nikde nepoužívali. V případě jich použití nenese cvičící ani nikdo ze ZČU zodpovědnost za vaše chování. Děkuji, MN.



:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :bug:
