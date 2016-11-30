* Řešení bude dodáno.


# 9. cvičení KIV/WEB - Útoky na web a ochrana webu

* Projděte si prezentaci k tomuto cvičení.


## 0. úkol - zprovozněte si dodanou aplikaci

* Vytvoření databáze
  * Pokud používáte databázi na students.kiv.zcu.cz, tak v souboru "DB-instal/+db_install.sql" nahraďte všechny výskyty slova "username" za Váš orion login.
  * PhpMyAdmin si nechte otevřený pro pozdější použití.
* Zprovozněte zbytek aplikace
  * V souboru settings.inc.php bude nejspíš potřeba upravit přihlašovací údaje k databázi a názvy tabulek.
* Pokud se Vám nebude na webu správně zobrazovat čeština, tak to aktuálně nevadí (nejspíš se jedná o konfliktní nastavení databáze).
* Pozn.: příliš se nezaobírejte strukturou aplikace. Jde spíše o ukázku nevhodné implementace webu, ale pro naše účely je dostatečná.


## 1. úkol - Cross-Site Scripting (XSS) útok a jeho ošetření

* Využijte vstupní prvky Návštěvní knihy a podsuňte webu XSS útokem svou reklamu.
  * Pozn.: při vypracovávání budete nejspíš potřebovat průběžně mazat nepovedené pokusy z databáze.
  * Reklama by se měla zobrazovat v pravém dolním rohu prohlížeče, mít pozadí a nápis "Moje reklama".
  * Upravte útočný kód tak, aby při najetí myši na vložený prvek vyskočil hláška (JavaScript Alert) s nápisem "Útok". Pozn.: hlavním problémem nejspíš bude použití uvozovek.
  * Upravte útočný kód tak, aby při kliknutí myši přesměroval uživatele na zcela jinou stránku, např. www.zcu.cz.
  * Kód útoku si uschovejte pro pozdější použití.
  * (Pro zkušené) Upravte útočný kód tak, aby při kliku myši nahradil obsah aktuální stránky obsahem stránky např. www.zcu.cz
    * Pozn.: budete potřebovat AJAX.
    * Výsledkem by mělo být, že doména zůstane správná, ale obsah webu bude nahrazen za falešný obsah.
* Odstraňte z databáze Vaše útoky, aby Vám nevadily v dalších úkolech (zvláště, pokud jste vypracovali úkol s AJAXem).


## 2. úkol - SQL injection útok

* Získejte výpis všech uživatelů, včetně jejich hesel.
  * Rada: použijte vstupní pole pro zadání hesla ve formuláři s přihlášením uživatelů.
  * Nyní se můžete přihlásit s účtem administrátora, ale nedělejte to.
* Zaregistrujte se a následně si využitím SQL injection změňte své právo na "administrátor", tj. idprava=1.
  * Pozn.1: databáze sice vrátí výsledek pouze prvního z dotazů, ale provede všechny dotazy, které jí zadáte.
  * Pozn.2: název tabulky je "username_uzivatele". V praxi bychom ho museli nejprve zjistit.
* Smažte z databáze všechny uživatele kromě sebe.
  * Vynecháme příklad s útokem mazajícím tabulku (abyste omylem nesmazali tabulky někomu jinému).
  * Pokud vyvíjíte na vlastním PC, tak si můžete zkusit SQL dotaz DROP TABLE.


## 3. úkol - ošetřete stránku před útoky typu XSS a SQL injection

* Zkuste si ošetřit některé vstupní prvky před XSS a SQL injection útoky.
  * XSS lze ošetřit převedením HTML tagů na značky začínající &, např. &lt; &gt apod. (Test např. na návštěvní knize.)
  * SQL injection lze ošetřit tzv. předpřipravenými dotazy (což PDO umožňuje). (Test např. na přihlášení uživatele.)
* Obecně je dobré:
  * Omezovat velikost vstupních prvků.
  * K číslům přičítat 0.
  * Používat předpřipravené dotazy.
  * Používat převody HTML tagů na speciální znaky.
  * Používat v SQL dotazech tzv. backticks, např.: SELECT * FROM `username_uzivatele` WHERE `iduzivatel`=...
    * Jedná se o [symbol zpětného apostrofu](https://en.wiktionary.org/wiki/backtick) (Readme na GitHubu je ale nezobrazuje).
    * Umožňuje nejspíš pouze MySQL.


## 4. úkol - dobrovolně

* Prohlédněte si následující texty: [SQL Injection - úvod](https://www.owasp.org/index.php/SQL_Injection), [Testing for SQL Injection](https://www.owasp.org/index.php/Testing_for_SQL_Injection_(OTG-INPVAL-005)), [SQL Injection Prevention Cheat Sheet](https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet).
* Různé další typy útoků: [Types of application security attacks](https://www.owasp.org/index.php/Category:Attack).


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :bug:
