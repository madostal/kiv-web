# 8. cvičení KIV/WEB - Šablonovací systém Twig

* Verze šablonovacího systému Twig:
  * Verze 2: Vyžaduje PHP alespoň verze 7.0 a instalaci prostřednictvím Composer.
  * Verze 1: Stačí PHP verze 5.5 a instalaci lze provést ze ZIP souboru či využitím Composer.
* Projděte si prezentaci k tomuto cvičení.

## 0. úkol - Získání Twigu

* Twig v.2 doporučuji stáhnout s využitím composeru, popř. lze využít soubor composer-reseni.zip.
  * Obsahuje celý adresář Composer.
* Twig v.1 (pouze, pokud si chcete vyzkoušet jeho ukázku) doporučuji stáhnout v souboru.
  * Obsahuje celý adresář Twig-Master. 


## 1. úkol - Seznámení se s Twigem

* Práce s adresářem "twig-uvod".
* Prohlédněte si obsažené soubory: 
  * *index.php* - obsahuje definici dat pro šablonu a ukazuje, jak je načten Twig a odpovídající šablona a jak je proveden výpis šablony.
  * *ukazkova-sablona.twig* - ukazuje příklady jednoduchých výpisů s využitím Twigu.
    * Všimněte si, že klíče z předaného pole dat se v šabloně stávají proměnnými.
    * Do posledního DIVu doplňte výpis ovoce do jednoho řádku, tj. spojte pole.


## 2. úkol - Příklad na využití Twigu

* Práce s adresářem "twig-priklad".
* Vaším cílem je pracovat se šablonami, tj. budete vytvářet šablony a měnit pouze soubor index.php 
(aby místo aktuální třídy s šablonou v PHP využíval Vaši šablonu v Twigu). Zbytek aplikace ponechte pokud možno beze změny.
  * Jako naprostý základ pro šablony lze využít HTML šablony z adresáře "sablony-html" 
    * Na obě HTML šablony se podívejte, abyste získali představu, jaký vzhled webu budeme vytvářet.
* __Data vstupující do šablony__:
  * V *index.php* jsou jako pole *$tplData*.
  * Defaultní data jsou pod klíči:
    * __nadpis__ a __text__ - textové řetězce.
    * __prihlaseni__ - textový řetězec s informativní hláškou (která se týká správy přihlášení uživatele) nebo neexistuje.
    * __uzivatel__ - textový řetězec se jménem uživatele nebo NULL.
  * Data pro výpis obchodu jsou pod klíči:
    * __produkty__ a __kos__ - pole s klíči *id*, *nazev*, *cena*, *obrazek* a koš obsahuje ještě *ks* s počtem vybraných kusů.
* __Data, která musí odesílat šablona při jednotlivých akcích__:
  * Přihlášení uživatele - tlačítko _name='prihlaseni'_, textový input _name='login'_.
  * Odhlášení uživatele - tlačítko _name='odhlaseni'_.
  * Vložení produktu do košíku - tlačítko _name='pridat'_, skrytý prvek _name='produkt'_ s ID produktu a počet kusů _name='mnozstvi'_.
  * Odebrání produktu z košíku - tlačítko _name='odebrat'_ a skrytý prvek _name='produkt'_ s ID produktu.


### část 2.0 - Průzkum PHP šablon

* Zprovozněte aplikaci a prohlédněte si šablony v PHP, tj. adresář "sablony-php" 
a příslušné funkce *renderInPhpTemplate* (používá šablonu zapsanou jako třídu) 
a *renderInPhpTemplateWithWrapper* (používá Output Buffer a šablonu využívající globální proměnnou) v souboru *index.php*.
  * Protože Output Buffer jsme viděli již v předešlém cvičení, tak by vám funkce obou typů PHP šablon měla být zřejmá.
* *Pozn.: používat formulář tak, jak je ukázáno v šablonách, není HTML validní, 
proto by bylo lepší použít např. Bootstrap (či jen CSS) a celou tabulku si vytvářit samostatně např. z DIV elementů*. 
  

### 2.1 úkol - Vytvoření základní šablony s využitím Twigu

* Cílem je s využitím Twigu vypsat obsah původní šablony.
  * Pozor: v souboru *index.php* jsou data polem *$tplData*, 
  ale ve Twig šabloně jsou klíče z tohoto pole názvy proměnných 
  (např. v PHP je **$tplData['uzivatel']**, ale v šabloně je jen **uzivatel**);
  * Do nové šablony kopírujte z HTML šablon, co uznáte za vhodné.
* Základní soubor s HTML hlavičkami a základem obsahu:
  * Vytvořte např. soubor **sablona-zaklad.twig**.
  * V TITLE a H1 vypište nadpis, ideálně s odstraněným HTML elementů (filter *striptags*).
  * Nechte si zobrazit výsledek, abyste viděli, že vám základ funguje.
  * Vytvořte jeden blok (název např. *prihlaseni*) pro výpis formuláře 
  a informací o přihlášení/odhlášení uživatele a pro výpis menu.
  * Vytvořte jeden blok pro celý zbytek obsahu stránky (název např. *obsah*) a v něm vytvořte:
    * Blok pro výpis obsahu nákupního košíku (název např. *nakupniKosik*).
    * Blok pro výpis produktů obchodu (název např. *produktyObchodu*).
    * Blok pro výpis textu (název např. *text*).
    * Do každého z těchto bloků napište libovolný informativní text.
* Nechte si zobrazit výsledek, abyste viděli, že Vám základ funguje.
  * V souboru *index.php* tedy nyní s využitím Twigu vypište šablonu *sablona-zaklad.twig*.
    * Připojte si rozšíření pro funkci *dump()*, která je ekvivalentem PHP funkce *var_dump()*, 
    viz [návod na zprovoznění funkce dump()](https://twig.symfony.com/doc/2.x/functions/dump.html). 


### 2.2 úkol - Vytvoření části s informacemi o přihlášení uživatele a příslušnými formuláři

* Cílem je vytvořit výpis pro správu přihlášení uživatele (včetně formulářů pro jeho přihlášení a odhlášení).
  * Přihlášený uživatel také vidí menu.
* Šablona se správou přihlášení, např. soubor **prihlaseni.twig**:
  * Pokud promenna *prihlaseni* obsahuje neprázdný text, 
  tak ho vypište do DIV elementu s *id=vypis* - slouží pro různé hlášky uživateli.
  * Vypište formulář, který přihlášenému uživateli poskytne odhlášení a nepřihlášenému uživateli přihlášení.
    * Uživatel se přihlašuje pouze jménem/loginem, přičemž na server musejí být metodou POST 
    odeslány parametry _name='prihlaseni'_ a _name='login'_.
    * Odhlášení uživatele je prováděno odesláním parametru _name='odhlaseni'_. 
    * Přihlášenému uživateli vypište menu, které vždy odkazuje na soubor *index.php* 
    s příslušným parametrem *web*, který může nabývat hodnot *uvod* a *obchod* 
    (tj. *index.php?web=obchod* a jen *index.php* nebo *index.php?web=uvod*).
* Příslušná úprava základní šablony (soubor **sablona-zaklad.twig**):
  * V bloku pro přihlášení uživatele includujte šablonu pro správu přihlášení uživatele.
* Nechte si zobrazit výsledek a ověřte, že vám přihlášení a odhlášení funguje.

### 2.3 úkol - Vytvoření šablony úvodní stránky

* Cílem je vytvořit samostatnou šablonu pro výpis úvodní stránky.
* Šablona pro úvodní stránku, např. soubor **stranka-uvod.twig**:
  * Dědí od základní šablony (soubor *sablona-zaklad.twig*).
  * Přepisuje blok *obsah* tak, že do něj vloží DIV, ve kterém vypíše proměnnou *text* v původní podobě (filtr *raw*).
    * DIVu dejte třídu *text*, která zajistí zarovnání textu do bloku.
* Příslušná úprava souboru **index.php**:
  * Volitelně: Vytvořte si pole, které dle klíčů *uvod* a *obchod* vrátí název souboru s příslušnou šablonou 
  (šablonu pro obchod vytvoříme v následujícím úkolu, nyní místo ní může být použita např. základní šablona).
  * Vypište data do šablony pro úvodní stránku a nechte si šablonu zobrazit.
  
  
### 2.4 úkol - Vytvoření základní šablony pro stránku s obchodem

* Cílem je připravit si základ šablony pro obchod, který nyní nebude vypisovat kompletní tabulky s produkty obchodu a nákupním košíkem.
* Šablona pro stránku s obchodem, např. soubor **stranka-obchod.twig**:
  * Dědí od základní šablony (soubor *sablona-zaklad.twig*).
  * Přepisuje blok *produktyObchodu*:
    * Pokud existuje uživatel i produkty, tak vypište název "Produkty v obchodě" a tabulku s hlavičkou pro výpis produktů.
      * Produkty nyní vypište pouze názvem do jednoho sloupce tabulky - výpis řádek tabulky zajistíme makrem.
  * Přepište blok *nakupniKosik*:
    * Pokud existuje uživatel i koš, tak vypište název "Nákupní košík" a tabulku s hlavičkou pro výpis produktů.
      * Produkty nyní vypište pouze názvem do jednoho sloupce tabulky - výpis řádek tabulky zajistíme makrem.
  * Přepište blok *text*:
    * Pokud existuje text, tak ho vypište do B elementu s třídou *center*.
* Příslušná úprava souboru **index.php**:
  * Volitelně: Pokud jste si vytvořili pole s klíči *uvod* a *obchod*, tak do něj doplňte název šablony pro výpis stránky s obchodem.
  * Vypište data do šablony pro stránku s obchodem a nechte si šablonu zobrazit.


### 2.5 úkol - Vytvoření souboru s makry

* Cílem je znovupoužitelné části kódu přesunout do maker a ta volat z příslušných míst užití.
* Šablona s makry, např. soubor **makra.twig**:
  * Vytvořte obecné makro pro výpis INPUT elementu:
    * Do makra vstupují parametry pro atributy *type*, *name* a *value* 
    a atribut (např. *other*) pro doplnění libovoné části INPUT elementu
    * Defaultní hodnotou atributu *type* je *text*.
    * Atribut *value* využívá escapování znaků.
    * Atribut *other* nemusí být zadán.
  * Vytvořte makro pro výpis řádku tabulky: 
    * Do makra vstupují parametry *typRadku*, *produkt* a *barvaRadku*.
    * Atribut *typRadku* může nabývat hodnot např. *kosik* a *obchod*.
    * Košík i obchod mají stejnou část s výpisem názvu produktu, obrázkem a cenou.
    * Obchod navíc umožňuje zvolit počet produktů a přidat je do košíku.
    * Koším navíc zobrazuje počet zvolených kusů a umožňuje odebrat produkt z košíku.
      * Pro vstupní elementy jsme si připravili makro s INPUT elementem.
* Šablona pro stránku s obchodem, např. soubor **stranka-obchod.twig**:
  * Správně doplňte volání makra pro výpis řádku produktů obchodu a produktů v košíku.
* Nechte si zobrazit výsledek a ověřte, že vám funguje přidávání a odebírání produktů z košíku.  


### 2.6 úkol - Součet obsahu košíku

* Cílem je doplnit šablonu s výpisem obchodu o výpis součtu ceny nákupního košíku.
* Zkuste samostatně, popř. si lze vyzkoušet formátování měn funkcí *format_currency*, ale vyžaduje PHP verze alespoň 7.1.3.

## 3. úkol - Práce s řešením příkladu

* Stáhněte si soubor s řešením příkladu a podívejte se na možné varianty implementování šablony v Twigu.
  * Porovnejte si šablony *Sablona.class.php*, *Sablona.tpl.php* a *cela-sablona-v-jednom-souboru.twig*.
  * Porovnejte si nazpůsoby načítání Twig v1 a Twig v2.
  * Zkuste si, co uznáte za vhodné.



------------
----------
TODO ...
    
    


* Může se hodit:
  * [Twig - kompletní tutoriál](http://twig.sensiolabs.org/)
  * [Twig - tagy](http://twig.sensiolabs.org/doc/tags/index.html) - autoescape, block, do, embed, extends, filter, flush, for, from, if, import, include, macro, sandbox, set, spaceless, use, verbatim, with.
  * [Twig - proměnné](http://twig.sensiolabs.org/doc/templates.html#variables)
  * [Twig - filtry](http://twig.sensiolabs.org/doc/filters/index.html) - abs, batch, capitalize, convert_encoding, date, date_modify, default, escape, first, format, join, json_encode, keys, last, length, lower, merge, nl2br, number_format, raw, replace, reverse, round, slice, sort, split, striptags, title, trim, upper, url_encode.
  * [Twig - funkce](http://twig.sensiolabs.org/doc/functions/index.html) - attribute, block, constant, cycle, date, dump, include, max, min, parent, random, range, source, template_from_string.
  * [Twig - makra](http://twig.sensiolabs.org/doc/tags/macro.html)
  * [Twig - bloky](http://twig.sensiolabs.org/doc/functions/block.html)



:+1:


### Poznámky

* V praxi by nejspíš nebyla takto jednoduchá Twig šablona tolik členěna.
* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :rabbit:
