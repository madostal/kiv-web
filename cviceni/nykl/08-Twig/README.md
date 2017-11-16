# 8. cvičení KIV/WEB - Šablonovací systém Twig

* Projděte si prezentaci k tomuto cvičení.
* Může se hodit:
  * [Twig - kompletní tutoriál](http://twig.sensiolabs.org/)
  * [Twig - tagy](http://twig.sensiolabs.org/doc/tags/index.html) - autoescape, block, do, embed, extends, filter, flush, for, from, if, import, include, macro, sandbox, set, spaceless, use, verbatim, with.
  * [Twig - proměnné](http://twig.sensiolabs.org/doc/templates.html#variables)
  * [Twig - filtry](http://twig.sensiolabs.org/doc/filters/index.html) - abs, batch, capitalize, convert_encoding, date, date_modify, default, escape, first, format, join, json_encode, keys, last, length, lower, merge, nl2br, number_format, raw, replace, reverse, round, slice, sort, split, striptags, title, trim, upper, url_encode.
  * [Twig - funkce](http://twig.sensiolabs.org/doc/functions/index.html) - attribute, block, constant, cycle, date, dump, include, max, min, parent, random, range, source, template_from_string.
  * [Twig - makra](http://twig.sensiolabs.org/doc/tags/macro.html)
  * [Twig - bloky](http://twig.sensiolabs.org/doc/functions/block.html)


## 1. úkol - seznámení se s Twigem

* Práce s adresářem "twig-uvod".
* Do adresáře "twig-uvod/twig-master" nakopírujte obsah archivu Twig-1.28.1.zip (pozn.: bez hlavního adresáře).
  * Měl by existovat následující soubor "twig-uvod/twig-master/lib/Twig/Autoloader.php".
* Prohlédněte si soubory v adresáři "twig-uvod", tj. index.php a ukazkova-sablona.tpl
* Do posledního DIVu doplňte výpis ovoce do jednoho řádku.


## 2. úkol - příklad na využití Twigu

* Práce s adresářem "twig-priklad".
  * Do adresáře "twig-master" nakopírujte soubory Twigu, viz předchozí příklad.
* Vaším cílem je práce se šablonami, tj. budete měnit pouze soubor index.php (aby místo aktuální třídy s šablonou v PHP využíval Vaši šablonu v Twigu) a vytvářet šablony. Zbytek aplikace ponechte pokud možno beze změny.
* Zprovozněte aplikaci a prohlédněte si aktuální PHP šablonu ve třídě sablona.class.php. 
* Hlavní cíle:
  * Vytvořit obdobnou šablonu s využitím Twigu.
  * Prohlédnout si PHP šablonu, která je zobrazována s využitím wrapperu.
* __Data vstupující do šablony__:
  * v index.php jako pole _$data_, ale ve Twig šabloně už přímo jen klíče z tohoto pole (tj. v php _$data['uzivatel']_, ale v sablone jen _uzivatel_);
  * obsah _$data_ obecně:
    * __nadpis__, __text__ a __prihlaseni__ - textové řetězce.
    * __uzivatel__ - textový řetězec nebo null.
  * obsah _$data_ v obchodě:
    * __produkty__ a __kos__ - pole s klíči __id, nazev, cena, obrazek__ a v koši ještě __ks__.
* __Data odesílaná šablonou__:
  * Přihlášení - tlačítko _name='prihlaseni'_, textový input _name='login'_.
  * Odhlášení - tlačítko _name='odhlaseni'_.
  * Vložení do košíku - tlačítko _name='pridat'_, skrytý prvek s ID produktu _name='produkt'_ a počet kusů _name='mnozstvi'_.
  * Odebrání z košíku - tlačítko _name='odebrat'_ a skrytý prvek s ID produktu _name='produkt'_.
  

### 2.1 úkol - vytvoření šablony s využitím Twigu

* Začněte vytvořením nového souboru pro šablonu (např. sablona.twig).
  * Do nové šablony kopírujte (průběžně) ze staré šablony, co uznáte za vhodné, ale nová šablona v sobě nebude obsahovat prvky PHP, pouze prvky Twigu.
* Vypište Twigem obsah původní šablony, tj. vytvořte totožnou šablonu v Twigu. Postup následuje.
* Vytvořte soubor (např. sablona-zaklad.twig) se základním obsahem šablony, tj. s hlavičkou a patičkou:
  * V TITLE a H1 vypište nadpis, ideálně s odstraněným HTML (striptags).
  * Nechte si zobrazit výsledek, abyste viděli, že Vám základ funguje.
  * Vytvořte Blok pro výpis obsahu stránky. Aktuálním obsahem bude jen text "Obsah stránky".
  * Vytvořte Blok pro výpis textu, který v sobě bude obsahovat část pro výpis proměnné Text z původní šablony.
  * Vytvořte (na správném místě) Blok pro přihlášení a výpis informací o přihlášení uživatele a zprovozněte ho (opět využijte části kódu z původní šablony). 
    * Budete potřebovat větvení.
    * Pozn.: proměnná Přihlášení vždy existuje (tj. musíte testovat její prázdnost).
    * Celou tuto vlastnost se správou přihlášení uživatele přesuňte do externího souboru (např. prihlaseni.twig) a zde, v základní šabloně, ho includujte.
    
    
* Vytvořte šablonu (např. sablona.twig), která bude dědit od základní šablony ([Twig - extends](http://twig.sensiolabs.org/doc/tags/extends.html)).
  * Překryjte Blok s obsahem stránky.
    * Pokud existuje uživatel i produkty, tak vypište produkty obchodu.
      * Nezapomeňte do skrytého prvku vložit ID produktu, aby produkt šel přidat do košíku.
    * Pokud existuje uživatel i koš, tak vypište produkty v košíku.
    * Pozn.: Pokud neexistuje uživatel, tak nevypisujte nic (tj. měl by ze stránky zmizet text "Obsah stránky").
    * Ověřte, že funguje vkládání produktů do košíku a jejich mazání z košíku.
  

* Vyzkoušejte si následující, ideálně přesunem daného kódu do nového souboru (např. makra.twig):
  * Vytvořte makro pro vypsání INPUT elementů a zakomponujte ho do stránky (nezapomeňte na import).
  * Vytvořte makro pro vypsání formuláře s řádkem obsahujícím produkt a zakomponujte ho do stránky jak pro výpis produktů v obchodě, tak i v košíku.
    * Toto je složitější, protože v řádku je používáno makro pro výpis INPUT elementů, tj. budete muset v souboru s makry importovat tentýž soubor.
    * Do makra si předejte informaci, zda se jedná o výpis produktů v obchodě či v košíku.
    * Použijte funkci Cycle pro odlišení sudých a lichých řádků tabulek (např. barvou pozadí). Pozn.: funkce nejspíš nebude v samotném makru.
    * Lze řešit různě.


### 2.2 úkol - příklad na využití Wrapperu

* Mini tutoriál: [Příklad s PHP Wrapperem](https://github.com/madostal/kiv-web/tree/master/dalsi-priklady/php_wrapper).
  * Wrapper je implementací návrhového vzoru Adaptér.
* Prohlédněte si soubor wrapper.class.php, který zajišťuje správné načtení šablony.
* Prohlédněte si soubor sablony/sablona.wrap.php
  * Jedná se o téměř totožnou PHP šablonu s šablonou sablony/sablona.class.php, pouze zde není objekt ani funkce pro vypsání, ale HTML se přímo vypisuje do výstupu.
  * Data jsou do šablony předána využitím globální proměnné.
  * Díky wrapperu je ale šablona vypsána až v souboru index.php.


:+1:


### Poznámky

* V praxi by nejspíš nebyla takto jednoduchá Twig šablona tolik členěna. Naopak by nejspíš existovala jedna šablona pro úvod a druhá šablona pro obchod.
* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :rabbit:
