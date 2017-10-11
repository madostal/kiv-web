# 3. cvičení KIV/WEB - CSS 3, responzivní design, Bootstrap.


## 0. úkol - práce s prezentací

* Pokročilé selektory CSS
  * Doporučuji navštívit odkazy Pseudo-třídy a Další možné selektory (sl.3).
  * Kdo viděl jQuery, ten v selektorech vidí podobnost.
* Odsazení a ohraničení
  * Doporučuji navštívit odkaz Border nebo Outline, kvůli typům čar (u obou jsou stejné).
* Pozicování -  kdo neznáte, tak si prohlédněte odkaz.
* Obtékání
  * Doporučuji prohlédnout si poslední z příkladů na odkazované stránce.
  * Odkaz na validátor CSS - spíše pro pozdější využití.
* Prohlédněte si soubory "ukazkacss(.html/.css)" a případně si zkuste, co uznáte za vhodné.
* Responzivní design - pokusit se pochopit.
  

## 1. úkol - CSS a responzivní design

* Použijte soubor responzivni.html
* Připojte k němu styl responzivni-zakladni-vzhled.css, který Vám doplní "barvičky".
* Připojte druhý vlastní soubor se stylem, který se bude starat o responzivitu.
* Styl s responzivitou by měl dělat to, co lze vidět na přiložených obrázcích. Podrobněji:
  * Základní nastavení
    * Nastavte správný box-sizing.
    * Řádkům nastavte ukončení obtékání, viz prezentace.
    * Všem sloupcům nastavte obtékání vlevo a vnitřní odsazení 15px.
  * Mobilní telefon
    * Sloupcům nastavte šířku 100%.
    * Barvu pozadí stránky nastavte na coral.
  * Zařízení s šířkou obrazovky alespoň 500px (tablet).
    * Barvu pozadí stránky nastavte na white.
    * Nastavte správně šířky pro sloupce col-1 až col-12 (využijte prezentaci).
    * Pozn.: prohlížeč Opera umožňuje mít nejmenší šířku okna 512px, tj. neuvidíte změnu. Pokud ho používáte, tak zkuste použít "pro tablet" hodnotu 756px a "pro PC" hodnotu 1000px.
  * Zařízení s šířkou obrazovky alespoň 756px (PC).
    * Barvu pozadí stránky nastavte na orange.
    * Všem sloupcům nastavte, aby při najetí myši zobrazily svůj rámeček - bílý, tečkovaný, 1px. Na obr. responzivni-PC.png byla myš v oblasti menu.
  * Při šířce obrazovky 550-600px (hack).
    * Barvu pozadí stránky nastavte na darkred.
* Změnou šířky okna prohlížeče otestujte, že Vám vše funguje.
    

## 2. úkol - Bootstrap

* Prohlédněte si [tutoriál na Bootstrap](http://www.w3schools.com/bootstrap/) a zkuste si, co uznáte za vhodné.
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
* Velmi důležité:
  * BS Grid System
  * BS Stacked/Horizontal - chápat rozdíl mezi .container a .container-fluid
  * BS Grid Examples - zvláště části "mixed".
* Prohlédnout:
  * BS Templates - při najetí myši na okénka/obrázky se ukáže rozložení sloupců.
  * jednotlivé ukázky Templates.
* Z Bootstrap CSS Ref postačí pouze následující:
  * CSS Helpers - část s .visible-*-* a .hiden-*
  * CSS Images
  * Glyphicons - užitečné.


## 3. úkol - na doma nebo pokud Vám zbyde čas na cvičení
* a) Zkuste vytvořit stránku s:
  * dvěma řádky obsahujícími několik sloupců (3-5), přičemž sloupce budou různě široké na mobilu, tabletu a na PC ( (xs), sm, md, (lg) ).
  * menu, které se na mobilu skryje pod ikonu s čárkami (collapsing navbar, viz BS Navbar).
  * pozn.: v řešení lze také nalézt ukázku tohoto.
* b) Dopracujte příklady z předešlých hodin.
* c) Připravte si šablonu pro Vaší samostatnou práci.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :horse:
