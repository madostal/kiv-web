# 3. cvičení KIV/WEB - CSS 3, responzivní design a Bootstrap.


## 0. úkol - opakování (pokročilé selektory)

* Soubory ukazka-css.html a ukazka-css.css slouží k mírnému zopakování pokročilých selektorů kaskádních stylů, např. jak selektovat přímé potomky či sourozence (tj. prvky na stejné úrovni) apod.
* Soubor vznikl v předešlých letech a něco zajímavého také obsahuje, ale po předchozím cvičení byste již měli být se znalostí CSS trochu dále.
  

## 1. úkol - CSS a responzivní design

* Použijte soubor responzivni.html, který využívá základní kaskádní styl definovaný v souboru responzivni-zakladni-vzhled.css (můžete si prohlédnout), který v podstatě jen doplňuje "barvičky".
* Vytvořte vlastní soubor se stylem, který budete dále upravovat a který bude zajišťovat responzivitu stránky, a použijte ho v souboru responzivni.html.
* Doplňte soubor responzivni.html o definici viewportu.
* Doplňte vlastní styl, který zajistí responzivitu webové stránky tak, jak je ukázáno na přiložených obrázcích. Podrobněji:
  * Prohlédněte si, jaké třídy sloupců (.my-col-*) jsou v souboru responzivni.html použity.
  * Základní nastavení (obr. 1 - základní nastavení.png):
    * Nastavte správný box-sizing všem elementům na stránce,
    * všem řádkům (.row) nastavte ukončení obtékání, tj. použijte ::after s obsahem vykresleným jako blokový element,
    * všem sloupcům (.my-col-*) nastavte obtékání vlevo, vnitřní odsazení 15px a šířku 100%,
    * nastavte barvu pozadí stránky na "coral".
  * Mobilní telefon (obrazovka alespoň 576px; obr. 2 - mobilní telefon.png):
    * Nastavte barvu pozadí stránky na "white",
    * nastavte správně šířky všech sloupců malé obrazovky (.my-col-sm-*), viz prezentace.
    * Pozn.: prohlížeč Opera umožňuje mít nejmenší šířku okna 512px, tj. pro ověření změny vzhledu lze využít vývojářské nástroje.
  * Tablet (obrazovka alespoň 768px; obr. 3 - tablet.png):
    * Barvu pozadí stránky nastavte na "antiquewhite".
    * nastavte správně šířky všech sloupců střední obrazovky (.my-col-md-*).      
  * Osobní počítač  (obrazovka alespoň 768px; obr. 4 - osobní počítač.png):
    * Barvu pozadí stránky nastavte na "aquamarine".
    * nastavte správně šířky všech sloupců velké obrazovky (.my-col-lg-*).   
* Doplňte pokusný styl, který při šířce obrazovky mezi 900px a 1100px změní pozadí hlavičky a patičky na "orange" (obr. 5 - pokusný styl.png).     
* Doplňte styl, který se uplatní při tisku stránky a zajistí (obr. 6 - tisk.png):
  * Skrytí hlavního menu,
  * doplnění blokového výpisu "* Verze pro tisk *" před hlavičku a za patičku stránky,
  * nastavte správně šířky všech sloupců na tištěné stránce (.my-col-print-*).  
* Využijte vývojářské nástroje prohlížeče a otestujte zobrazení stránky na zařízeních s různou šířkou obrazovky.


## 2. úkol - CSS framework Bootstrap a font Awesome

* Lze využít tutoriály na [W3Schools](https://www.w3schools.com/bootstrap4/default.asp) nebo [GetBootstrap](https://getbootstrap.com) a [Font Awesome v4.7](https://fontawesome.com/v4.7.0/icons/).
* Pro práci využijte soubor bootstrap.html:
  * Zkontrolujte, že obsahuje správně připojený Bootstrap, jQuery a font Awesome (je ukázáno, jak využít jejich verze z CDN či jejich lokální uložení).
    * Pozn.: CSS je připojováno v hlavičce, JS na konci stránky.
  * Můžete si zkusit práci s nástrojem Composer pro právu balíčků/knihoven, který umožňuje rychlou inicializaci projektu a alespoň základní ohlídání kompatibility jedlotlivých knihoven.
    * Seznam požadovaných knihoven je uveden v souboru composer.json.
    * Instalaci spustíte z příkazové řádky: php composer.phar install
    * Pro aktualizaci knihoven: php composer.phar update
    * Je zřejmé, že Composer vyžaduje běžící PHP.
* Hlavička stránky:
  * Vložte hlavičku do kontejneru
  * a odstavci v hlavičce nastavte zelený (success) tučný text.
* Doplňte hlavní menu:
  * Vyjděte ze základního menu, které je ukázáno v tutoriálu v sekci [BS4 Navbar](https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp),
  * doplňte do menu položku s rozbalovacím seznamem,
  * při rolování stránky ukotvěte menu k vršku stránky,
  * doplňte do menu kontejner, aby text menu byl "ve stránce",
  * před nadpis v hlavním menu umístěte libovolnou ikonu (např. hvězdu).
* Obsah stránky umístěte do kontejneru a dále:
  * Úvodní text:
    * Vykreslete jako "jumbotron",
    * odstavec zarovnejte do bloku,
    * z odkazů udělejte skupinu velkých tlačítek, kde první bude vykresleno plnou modrou barvou a druhé "prázdnou" modrou barvou (outline),
    * do obou tlačítek umístěte libovolnou ikonu (např. externí link a lupu).
  * Článek, 1. část:
    * Bude v jednom řádku a její obsah bude přes všech 12 sloupců a zarovnaný do bloku.
    * Tabulka bude responzivní, malá, ohraničená, s odlišenými sudými/lichými řádky a při najetí myši se budou jednotlivé řádky zvýraznovat.
    * Hlavička tabulky bude tmavá s centrovaným písmem a poslední řádek tabulky bude červený.
    * Tlačítka v posledním sloupci tabulky budou malá a modrá a svou funkcionalitu rozšíří na celý řádek (a mohou být centrována).
  * Článek, 2. část:
    * Bude v jednom řádku a oblast s nadpisem bude přes všech 12 sloupců.
      * Horní index bude vykreslen jako zelený "badge" a bude obsahovat světlý rostoucí spinner (vlastnost Bootstrapu).
    * Zbylé čtyři oblasti budou na malé obrazovce každá na polovinu stránky, na střední obrazovce v jedné řádce stejně široké a na velké obrazovce budou první a poslední přes 2 sloupec a prostřední přes 4 sloupce.
  * Článek, 3. část:
    * Bude v jednom řádku a obě její části budou přes všech 12 sloupců.
    * Tlačítko bude vykresleno jako odkaz a při kliku na něj se zobrazí/skryje spodní oblast #demo.
    * Oblast #demo bude defaultně skryta, bude mít tmavé pozadí a zaoblené rohy a do bloku zarovnaný světlý kurzívní text.
* Patička bude přes celou šířku stránky a bude mít tmavé pozadí a světlý text zarovnaný na střed.
  * Do patičky doplňte ikonu otáčejícího se kola ([font Awesome](https://fontawesome.com/v4.7.0/examples/#animated)).
* Nad patičku doplňte libovolný [carousel](https://www.w3schools.com/bootstrap4/bootstrap_carousel.asp).  
    



## Úkoly na doma (TODO)

* Prohlédněte si [tutoriál na Bootstrap](https://www.w3schools.com/bootstrap4/) a zkuste si, co uznáte za vhodné.
* Velmi důležité:
  * BS Grid System
  * BS Stacked/Horizontal - chápat rozdíl mezi .container a .container-fluid
  * BS Grid Examples - zvláště části "mixed".
* Větší pozornost věnujte částem:
  * BS Grid Basic
  * BS Typography
  * BS Alerts
  * BS Buttons a BS Buttons groups (všimněte si části, kde jsou použity v elementy A, tj. odkazy)
  * BS Glyphicon
  * BS Dropdowns
  * BS Collapse
  * BS Navbar - zvláště část Collapsing The Navigation Bar.
  * BS Inputs
  * BS Media Objects
  * BS Carousel (s textem)
  * BS Tooltip
  * BS Scrollspy
  * BS Affix
* Prohlédnout:
  * BS Templates - při najetí myši na okénka/obrázky se ukáže rozložení sloupců.
  * jednotlivé ukázky Templates.
* Z Bootstrap CSS Ref postačí pouze následující:
  * CSS Helpers - část s .visible-*-* a .hiden-*
  * CSS Images
  * Glyphicons - užitečné.




:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :horse:
