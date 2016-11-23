* Bude dopracováno.

# 8. cvičení KIV/WEB - Šablonovací systém Twig.

* Projděte si prezentaci k tomuto cvičení.
* Může se hodit:
  * [Twig - kompletní tutoriál](http://twig.sensiolabs.org/)
  * [Twig - tagy](http://twig.sensiolabs.org/doc/tags/index.html) - autoescape, block, do, embed, extends, filter, flush, for, from, if, import, include, macro, sandbox, set, spaceless, use, verbatim, with.
  * [Twig - proměnné](http://twig.sensiolabs.org/doc/templates.html#variables)
  * [Twig - filtry](http://twig.sensiolabs.org/doc/filters/index.html) - abs, batch, capitalize, convert_encoding, date, date_modify, default, escape, first, format, join, json_encode, keys, last, length, lower, merge, nl2br, number_format, raw, replace, reverse, round, slice, sort, split, striptags, title, trim, upper, url_encode.
  * [Twig - funkce](http://twig.sensiolabs.org/doc/functions/index.html) - attribute, block, constant, cycle, date, dump, include, max, min, parent, random, range, source, template_from_string.
  * [Twig - makra](http://twig.sensiolabs.org/doc/tags/macro.html)
  * [Twig - bloky](http://twig.sensiolabs.org/doc/functions/block.html)


## 1. úkol - seznámení se s Twig

* Práce s adresářem "twig-uvod".
* Do adresáře "twig-uvod/twig-master" nakopírujte obsah archivu Twig-1.28.1.zip (pozn.: bez hlavního adresáře).
  * Měl by existovat následující soubor "twig-uvod/twig-master/lib/Twig/Autoloader.php".
* Prohlédněte si soubory v adresáři "twig-uvod", tj. index.php a ukazkova-sablona.tpl
* Do posledního DIVu doplňte výpis ovoce do jednoho řádku.


## 2. úkol - vytvoření databáze

* Práce s adresářem "twig-priklad".
  * Do adresáře "twig-master" nakopírujte soubory Twigu, viz předchozí příklad.
* Vaším cílem je práce se šablonami, tj. budete měnit pouze soubor index.php a šablony. Zbytek aplikace ponechte pokud možno bezezměny.
* Zprovozněte aplikaci a prohlédněte si aktuální šablonu ve třídě sablona.class.php. 
* Hlavní cíle:
  * vytvořit obdobnou šablonu s využitím Twigu.
  * vytvořit obdobnou šablonu s využitím wrapperu.
  

### 2.2 úkol - vytvoření šablony s využitím PHP Wrapperu

Bude doplněno (snad).

### 2.1 úkol - vytvoření šablony s využitím Twigu

* Začněte vytvořením nového souboru pro šablonu (např. sablona.twig).
  * Do nové šablony kopírujte (průbězně) ze staré šablony, co uznáte za vhodné, ale nová šablona v sobě nebude obsahovat prvky HTML, pouze prvky Twigu.
* Vypište Twigem obsah původní šablony, tj. vytvořte totožnou šablonu v Twigu. Postup následuje.
* Vytvořte soubor (např. sablona-zaklad.twig) se základním obsahem šablony, tj. s hlavičkou a patičkou:
  * V TITLE a H1 vypište nadpis, ideálně s odstraněným HTML (striptags).
  * Nechte si zobrazit výsledek, abyste viděli, že Vám základ funguje.
  * Vytvořte Blok pro výpis obsahu stránky. Aktuálním obsahem bude jen text "Obsah stránky".
  * Vytvořte Blok pro výpis textu, který v sobě bude obsahovat část pro výpis proměnné Text z původní šablony.
  * Vytvořte (na správném místě) Blok pro přihlášení a výpis informací o přihlášení uživatele a zprovozněte ho (opět využijte části kódu z původní šablony). 
    * Budete potřebovat větvení.
    * Pozn.: proměnná Přihlášení vždy existuje (tj. test na prázdnost).
    * Celou tuto vlastnost dejte do externího souboru (např. prihlaseni.twig) a zde, v základní šabloně, ho includujte.
    
    
* Vytvořte šablonu (např. sablona.twig), která oddědí od základní šablony ([Twig - extends](http://twig.sensiolabs.org/doc/tags/extends.html)).
  * Překryjte Blok s obsahem stránky.
    * Pokud existuje uživatel a produkty, tak vypište produkty obchodu.
      * Nezapomeňte do skrytého prvku vložit ID produktu, aby šel vložit do košíku.
    * Pokud existuje uživatel a koš, tak vypište produkty v košíku.
    * Pozn.: Pokud neexistuje uživatel, tak nevypisujte nic (tj. měl by ze stránky zmizet text "Obsah stránky").
    * Ověřte, že funguje vkládání produktů do košíku a jejich mazání z košíku.


* Vyzkoušejte si následující, ideálně přesunem daného kódu do nového souboru (např. makra.twig):
  * Vytvořte makro pro vypsání INPUT elementů a zakomponujte ho do stránky (nezapomeňte na import).
  * Vytvořte makro pro vypsání řádek s produkty (obchod i košík) a zakomponujte ho do stránky.
    * Použíte funkci Cycle pro odlišení sudých a lichých řádků tabulek (např. barvou pozadí).
  


:+1:


### Poznámky

* V praxi by nejspíš nebyla takto jednoduchá šablona tolik členěna.
* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :camel:
