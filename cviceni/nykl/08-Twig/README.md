# 8. cvičení KIV/WEB - Šablonovací systém Twig

* Verze šablonovacího systému Twig:
  * Verze 2: Vyžaduje PHP alespoň verze 7.0 a instalaci prostřednictvím Composer.
  * Verze 1: Stačí PHP verze 5.5 a instalaci lze provést ze ZIP souboru či využitím Composer.
* Projděte si prezentaci k tomuto cvičení.


## 0. úkol - Získání Twigu

* Twig v.2 doporučuji stáhnout s využitím composeru, popř. lze použít soubor *Twig-v2.12-composer-reseni.zip* (obsahuje celý adresář *composer*).
* Twig v.1 (pouze, pokud si chcete vyzkoušet jeho ukázku) doporučuji stáhnout v souboru *Twig-v1.28-twig-master-reseni.zip* (obsahuje celý adresář *twig-master*). 


## 1. úkol - Seznámení se s Twigem

* Práce s adresářem **twig-uvod**.
* Prohlédněte si soubory úvodního příkladu: 
  * *index.php* - obsahuje definici dat pro šablonu a ukazuje, jak je načten Twig a odpovídající šablona a jak je proveden výpis šablony.
  * *ukazkova-sablona.twig* - ukazuje příklady jednoduchých výpisů s využitím Twigu.
    * Všimněte si, že klíče z (první úrovně) předaného pole dat se v šabloně stanou proměnnými.
    * Do posledního DIVu doplňte výpis ovoce do jednoho řádku, tj. spojte pole využitím filtru *join()*.


## 2. úkol - Příklad na využití Twigu

* Práce s adresářem **twig-priklad**.
* Vaším cílem je pracovat se šablonami, tj. budete vytvářet šablony 
a měnit pouze funkci pro jejich načítání v souboru index.php 
(aby místo aktuální šablony v PHP využíval Vaši šablonu v Twigu). 
Zbytek aplikace ponechte pokud možno beze změny.
  * Jako naprostý základ pro šablony lze využít HTML soubory z adresáře "sablony-html" 
    * Na obě HTML šablony se podívejte, abyste získali představu, jaký vzhled webu budeme vytvářet.
    * Z praxe: pokud si šablonu webu stáhnete z internetu, 
    tak se bude obvykle skládat právě z HTML souborů,
    které lze snadno zaimplementovat do svého řešení v libovolném programovacím jazyce pro web
     (PHP, Java apod.).
* __Data vstupující do šablony__:
  * V *index.php* jsou jako pole *$tplData*.
  * Defaultní data jsou pod klíči:
    * __nadpis__ a __text__ - textové řetězce s názvem a textem stránky.
    * __prihlaseni__ - textový řetězec s informativní hláškou (která se týká správy přihlášení uživatele) nebo neexistuje.
    * __uzivatel__ - textový řetězec se jménem uživatele nebo NULL.
  * Data pro výpis obchodu jsou pod klíči:
    * __produkty__ a __kos__ - pole s klíči *id*, *nazev*, *cena*, *obrazek* a koš obsahuje navíc *ks* s počtem vybraných kusů.
* __Data, která musí šablona odesílat při příslušných akcích uživatele__:
  * Přihlášení uživatele - tlačítko _name='prihlaseni'_, textový input _name='login'_.
  * Odhlášení uživatele - tlačítko _name='odhlaseni'_.
  * Vložení produktu do košíku - tlačítko _name='pridat'_, skrytý prvek _name='produkt'_ s ID produktu a počet kusů _name='mnozstvi'_.
  * Odebrání produktu z košíku - tlačítko _name='odebrat'_ a skrytý prvek _name='produkt'_ s ID produktu.


### část 2.0 - Průzkum PHP šablon

* Zprovozněte aplikaci a prohlédněte si šablony v PHP, tj. adresář **sablony-php** 
a příslušné funkce *renderInPhpTemplate* (používá šablonu zapsanou jako PHP třídu) 
a *renderInPhpTemplateWithWrapper* (používá Output Buffer a šablonu využívající globální proměnnou) v souboru *index.php*.
  * Protože Output Buffer jsme viděli již v předešlém cvičení, tak by vám funkce obou typů PHP šablon měla být zřejmá.
* *Pozn.: používat formulář tak, jak je ukázáno v šablonách, není HTML validní, 
proto by bylo lepší použít např. Bootstrap (či jen CSS) a celou tabulku si vytvářit samostatně 
např. z DIV elementů. Nicméně pro potřeby našeho příkladu je tato verze intuitivnější a funguje také.*  
  

### 2.1 úkol - Vytvoření základní šablony s využitím Twigu

* Cílem je s využitím Twigu vypsat obsah původní šablony.
  * Pozor: v souboru *index.php* jsou data polem *$tplData*, 
  ale ve Twig šabloně jsou klíče z tohoto pole názvy proměnných 
  (např. v PHP je **$tplData['uzivatel']**, ale v šabloně je jen **uzivatel**);
  * Do nové šablony kopírujte z HTML šablon, co uznáte za vhodné.
* Základní soubor šablon s HTML hlavičkami a základem obsahu:
  * Vytvořte např. soubor **sablona-zaklad.twig**.
  * V TITLE a H1 vypište nadpis, ideálně s odstraněním HTML elementů (filtr *striptags*).
  * Nechte si zobrazit výsledek, abyste viděli, že vám základ funguje.
  * Vytvořte jeden blok (název např. *prihlaseni*) pro výpis formuláře 
  a informací o přihlášení/odhlášení uživatele a pro výpis menu.
  * Vytvořte jeden blok pro celý zbytek obsahu stránky (název např. *obsah*) a v něm vytvořte:
    * Blok pro výpis obsahu nákupního košíku (název např. *nakupniKosik*).
    * Blok pro výpis produktů obchodu (název např. *produktyObchodu*).
    * Blok pro výpis textu (název např. *vlastniText*).
    * Do každého z těchto bloků napište libovolný informativní text.
* Nechte si zobrazit výsledek, abyste viděli, že vám základ funguje.
  * V souboru *index.php* tedy nyní s využitím Twigu vypište šablonu *sablona-zaklad.twig*.
    * Připojte si rozšíření pro funkci *dump()*, která je ekvivalentem PHP funkce *var_dump()*, 
    viz [návod na zprovoznění funkce dump()](https://twig.symfony.com/doc/2.x/functions/dump.html),
    a může vám pomoci s řešením problémů. 


### 2.2 úkol - Vytvoření části s informacemi o přihlášení uživatele a příslušnými formuláři

* Cílem je vytvořit výpis pro správu přihlášení uživatele (včetně formulářů pro jeho přihlášení a odhlášení).
  * Přihlášený uživatel také vidí menu.
* Šablona se správou přihlášení, např. soubor **prihlaseni.twig**:
  * Pokud proměnná *prihlaseni* obsahuje neprázdný text, 
  tak ho vypište do DIV elementu s *id=vypis* - slouží pro různé hlášky uživateli.
  * Vypište formulář, který přihlášenému uživateli poskytne odhlášení a nepřihlášenému uživateli přihlášení.
    * Uživatel se přihlašuje pouze jménem/loginem, přičemž na server musejí být metodou POST 
    odeslány parametry _name='prihlaseni'_ a _name='login'_.
    * Odhlášení uživatele je prováděno odesláním parametru _name='odhlaseni'_. 
    * Přihlášenému uživateli vypište menu, které vždy odkazuje na soubor *index.php* 
    s příslušným parametrem *web*, který může nabývat hodnot *uvod* a *obchod* 
    (tj. *index.php?web=obchod* a jen *index.php* nebo *index.php?web=uvod*).
* Příslušná úprava základní šablony (soubor **sablona-zaklad.twig**):
  * Vymaže obsah bloku pro přihlášení uživatele a includujte v něm šablonu *prihlaseni.twig* pro správu přihlášení uživatele.
* Nechte si zobrazit výsledek a ověřte, že vám přihlášení a odhlášení funguje.


### 2.3 úkol - Vytvoření šablony úvodní stránky

* Cílem je vytvořit samostatnou šablonu pro výpis úvodní stránky, která vedle přihlášení vypisuje jen svůj text.
* Šablona pro úvodní stránku, např. soubor **stranka-uvod.twig**:
  * Dědí od základní šablony (soubor *sablona-zaklad.twig*).
  * Přepisuje blok *obsah* tak, že do něj vloží DIV, ve kterém vypíše proměnnou *text* v původní podobě (filtr *raw*).
    * DIVu dejte CSS třídu *text*, která zajistí zarovnání textu do bloku.
* Příslušná úprava souboru **index.php**:
  * Volitelně: Vytvořte si pole, které dle klíčů *uvod* a *obchod* vrátí název souboru s příslušnou Twig šablonou 
  (šablonu pro obchod vytvoříme v následujícím úkolu, nyní místo ní může být použita např. základní šablona).
* Nechte si zobrazit výsledek, tj. úvodní stránku, a ověřte, že správně vypisuje svůj text.
  
  
### 2.4 úkol - Vytvoření šablony pro stránku s obchodem

* Cílem je připravit si základ šablony pro obchod.
  * Nyní nebude vypisovat kompletní tabulky s produkty obchodu a nákupním košíkem,
protože jejich výpis zajistíme až následně s využitím maker.
* Šablona pro stránku s obchodem, např. soubor **stranka-obchod.twig**:
  * Dědí od základní šablony (soubor *sablona-zaklad.twig*).
  * Přepište blok *vlastniText*:
      * Pokud existuje text, tak ho vypište do B elementu s třídou *center*.
  * Přepisuje blok *produktyObchodu*:
    * Pokud existuje uživatel i produkty, tak vypište název "Produkty v obchodě" a tabulku s hlavičkou pro výpis produktů.
      * Produkty nyní vypište pouze názvem do jednoho sloupce tabulky - výpis řádek tabulky zajistíme makrem.
  * Přepište blok *nakupniKosik*:
    * Pokud existuje uživatel i koš, tak vypište název "Nákupní košík" a tabulku s hlavičkou pro výpis produktů.
      * Produkty nyní vypište pouze názvem do jednoho sloupce tabulky - výpis řádek tabulky zajistíme makrem.
* Příslušná úprava souboru **index.php**:
  * Volitelně: Pokud jste si vytvořili pole s klíči *uvod* a *obchod*, tak do něj doplňte název šablony pro výpis stránky s obchodem.
* Nechte si zobrazit výsledek, tj. stránku obchodu, a ověřte, že správně vypisuje svůj text a produkty obchodu. 
Košík nyní nejspíš neuvidíte, protože nemáme vytvořena tlačítka pro přidávání produktů do košíku.


### 2.5 úkol - Vytvoření souboru s makry

* Cílem je znovupoužitelné části šablon přesunout do maker a ta volat z příslušných míst užití.
* Šablona s makry, např. soubor **makra.twig**:
  * Vytvořte obecné makro pro výpis INPUT elementu:
    * Do makra vstupují parametry pro atributy *type*, *name* a *value* 
    a atribut (např. *other*) pro doplnění libovolné části INPUT elementu
    * Defaultní hodnotou atributu *type* je *text*.
    * Atribut *value* využívá escapování znaků.
    * Atribut *other* nemusí být zadán.
  * Vytvořte makro pro výpis řádku tabulky: 
    * Do makra vstupují parametry *typRadku*, *produkt* a *barvaRadku*.
    * Atribut *typRadku* může nabývat hodnot např. *kosik* a *obchod*, 
    které určují, jestli bude vypsán řádek košíku, nebo řádek s produkty obchodu.
    * Košík i obchod mají stejnou část řádku s výpisem názvu produktu, obrázkem a cenou.
    * Obchod navíc umožňuje zvolit počet produktů a přidat je do košíku.
    * Košík navíc zobrazuje počet zvolených kusů a umožňuje odebrat produkt z košíku.
    * *Pozn.: pro vstupní elementy jsme si připravili makro s INPUT elementem.*
* Příslušná úprava šablony pro stránku s obchodem, soubor **stranka-obchod.twig**:
  * Správně doplňte volání makra pro výpis řádku produktů obchodu a produktů v košíku.
* Nechte si zobrazit výsledek a ověřte, že vám funguje přidávání a odebírání produktů z košíku.
  * Nyní by měly fungovat všechny funkce webu.  


### 2.6 úkol - Součet obsahu košíku

* Cílem je doplnit šablonu s výpisem obchodu o výpis součtu ceny nákupního košíku.
* Zkuste samostatně:
   * Stačí sčítat násobky ceny a počtu kusů. 
   * Popř. si lze vyzkoušet formátování měn funkcí *format_currency*, ale vyžaduje PHP verze alespoň 7.1.3
   (na *students.kiv.zcu.cz* je v současnosti verze 7.0).


## 3. úkol - Práce s řešením příkladu

* Stáhněte si soubor s řešením příkladu a podívejte se na možné varianty implementování šablony v Twigu.
  * Porovnejte si šablony *Sablona.class.php*, *Sablona.tpl.php* a *cela-sablona-v-jednom-souboru.twig*.
  * Porovnejte si způsoby načítání Twig v1 a Twig v2.
  * Zkuste si, co uznáte za vhodné.


## Úkoly na doma

* Doporučuji podívat se na následující přehledovou stránku manuálu Twigu: [Twig for Template Designers](https://twig.symfony.com/doc/2.x/templates.html).
* Je dobré chápat, jakým způsobem v šablonách fungují [proměnné](https://twig.symfony.com/doc/2.x/templates.html#variables),
  [bloky](http://twig.sensiolabs.org/doc/functions/block.html) a [makra](http://twig.sensiolabs.org/doc/tags/macro.html).
* Dopučuji podívat se alespoň na některé funkcionality Twigu, jejichž výčet následuje: 
  * [Tagy](http://twig.sensiolabs.org/doc/tags/index.html) (v podstatě příkazy jazyka) - apply, autoescape, block, deprecated, do, embed, extends, filter, flush, for, from, if, import, include, macro, sandbox, set, spaceless, use, verbatim, with.
  * [Filtry](http://twig.sensiolabs.org/doc/filters/index.html) (pro úpravu výpisů) - abs, batch, capitalize, column, convert_encoding, country_name, currency_name, currency_symbol, data_uri, date, date_modify, default, escape, filter, first, format, format_currency, format_date, format_datetime, format_number, format_time, html_to_markdown, inline_css, inky_to_html, join, json_encode, keys, language_name, last, length, locale_name, lower, map, markdown_to_html, merge, nl2br, number_format, raw, reduce, replace, reverse, round, slice, sort, spaceless, split, striptags, timezone_name, title, trim, upper, url_encode.
  * [Funkce](http://twig.sensiolabs.org/doc/functions/index.html) (pro speciální akce) - attribute, block, constant, cycle, date, dump, html_classes, include, max, min, parent, random, range, source, country_timezones, template_from_string.
   

## Výstupy cvičení

* Student by měl vědět, jak ve své aplikaci použít Twig.
* Student by měl umět používat základní konstrukce Twigu (výpisy, cykly, větvení, přiřazování hodnot, makra, bloky, include vs. import apod.) a příslušné typy závorek {{..}}, {%..%}, {#..#}.
  * Student by měl znát základní filtry (date, default, length, lower, raw, sort, striptags, trim, upper) a mít představu, k čemu slouží další filtry.      
* Student by měl umět nastavit prostředí Twigu (*Environment*):
  * Umět zapnout debug a umožnit použití funkce [dump()](https://twig.symfony.com/doc/2.x/functions/dump.html).
  * Umět zapnout cache pro šablony Twigu.
* Student by měl umět zapnout/přidat rozšíření Twigu (např. [format_currency](https://twig.symfony.com/doc/2.x/filters/format_currency.html)).


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :rabbit:
