# 3. cvičení KIV/WEB - CSS 3, responzivní design a Bootstrap.


## 0. úkol - opakování (pokročilé selektory)

* Soubory ukazka-css.html a ukazka-css.css slouží k mírnému zopakování pokročilých selektorů kaskádových stylů, např. jak selektovat přímé potomky či sourozence (tj. prvky na stejné úrovni) apod.
* Soubor vznikl v předešlých letech a něco zajímavého také obsahuje, ale po předchozím cvičení byste již měli být se znalostí CSS trochu dále.
  

## 1. úkol - CSS a vlastní responzivní design

* Použijte soubor responzivni.html, který využívá základní kaskádový styl definovaný v souboru responzivni-zakladni-vzhled.css (můžete si prohlédnout), který v podstatě jen doplňuje "barvičky".
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
  * Můžete si zkusit práci s nástrojem Composer pro právu balíčků/knihoven, který umožňuje rychlou inicializaci projektu a alespoň základní ohlídání kompatibility jednotlivých knihoven.
    * Composer vyžaduje PHP (může být použit wamp, xampp nebo easyphp apod.). Knihovna viz [GetComposer](https://getcomposer.org). Lze spustit jen jako PHP skript (skript composer.phar musí být správně odkázán), nebo lze nainstalovat.
    * Seznam požadovaných knihoven je uveden v souboru composer.json.
    * Instalaci zvolených knihoven dle souboru composer.json spustíte z příkazové řádky: php composer.phar install
      * Pokud by instalace vyžadovala více paměti, než je PHP defaultně přiděleno, tak lze využít: php -d memory_limit=-1 composer.phar install
    * Pro aktualizaci knihoven: php composer.phar update
    * Všimněte si, souboru autoloader.php, který vznikl v adresáři vendor. Tímto souborem lze do PHP skriptu automaticky připojit všechny instalované PHP knihovny, což lze využít např. při instalaci Twigu  (pozor, jQuery, Bootstrap ani Font Awesome se netýkají PHP, tj. do HTML si je musíte připojit sami).
    * Pokud používáte správu verzí (např. GIT), tak je vhodné vyloučit adresář *vendor* z repozitáře (není potřeba, bude vždy vytvořen composerem).
  * Můžete si zkusit práci s nástrojem NMP, který bývá pro správu balíčků při vývoji front-endu využíván častěji (vyžaduje instalaci; není vázán na PHP).
    * Instalace NPM je spojena s instalací Node.js, viz [npmjs.com](https://www.npmjs.com/get-npm). 
    * Seznam požadovaných knihoven je uveden v souboru package.json.
    * Instalaci zvolených knihoven dle souboru package.json spustíte z příkazové řádky: npm install
      * Update: npm update
   * Vytvořený adresář *node_modules* je vhodné vyloučit ze správy verzí vlastního projektu.         
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
    * Tabulka bude responzivní, malá, ohraničená, s odlišenými sudými/lichými řádky a při najetí myši se budou jednotlivé řádky zvýrazňovat.
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
    

## Úkoly na doma

* Prohlédněte si [tutoriál Bootstrapu](https://www.w3schools.com/bootstrap4/) a zkuste si, co uznáte za vhodné.
* Je dobré pochopit způsob tvorby responzivního designu v Bootstrapu (oblast Bootstrap 4 Grid):
  * BS4 Grid System (vysvětlení sloupcového layoutu), zvláště části Grid classes a Grid system rules.
    * Důležité je chápat rozdíl mezi třídami .container a .container-fluid. 
  * BS4 Stacked/Horizontal, BS4 Grid Examples - dobré vidět a pochopit.
* Dále doporučuji projít si následující stránky tutoriálu:
  * BS4 Typography, BS4 Utilities (způsoby defaultního vykreslení elementů a defaultní barvičky; stačí prohlédnout)
  * BS4 Alerts, BS4 Buttons a BS4 Buttons groups (dobré znát).
  * BS4 Badges, BS4 Progress Bars (stačí prohlédnout).
  * BS4 Tables (dobré znát).
  * BS4 Navs, BS4 Navbars (dobré umět použít, zvláště *Collapsing The Navigation Bar*).
  * BS4 Dropdowns, BS4 Collapse (stačí prohlédnout).
  * BS4 Forms, BS4 Inputs, BS4 Inputs Groups, BS4 Custom Forms (stačí prohlédnout).
  * BS4 Carousel, BS4 Modal, BS4 Tooltip, BS4 Popover (dobré umět použít). 
  * BS4 Filters (jen prohlédnout; využívá jQuery).
* Další příklady a ukázky lze nalézt na oficiální stránce Bootstrapu, tj. [GetBootstrap.com](https://getbootstrap.com/docs/4.3/components/alerts/).
  * Pro inspiraci si lze prohlédnou připravené šablony webů na [StartBootstrap.com](https://startbootstrap.com/templates/). Pozor, v samostatné práci musíte vytvořit vlastní design webu, ale tyto šablony můžete použít pro inspiraci (což je zvláště dobré pro programátory bez grafického citu - v praxi šablonu vezmete a upravíte k obrazu svému). 
* Jako alternativu Bootstrapu lze využít např. [W3.CSS](https://www.w3schools.com/w3css/default.asp).
* **Ikony** - dostupných fontů s ikonami, které lze na webu zdarma použít, existuje větší množství, např. [Awesome v4 - snažší užití](https://fontawesome.com/v4.7.0/icons/), [Awesome v5](https://fontawesome.com/), [Captain Icon](https://mariodelvalle.github.io/CaptainIconWeb/), [Octicons](https://octicons.github.com/), [Typicons](https://www.s-ings.com/typicons/), [Material Design Icons](https://materialdesignicons.com/), [Flaticon](https://www.flaticon.com/) a další.
  * Pro začátek doporučuji zkusit si použít [Awesome v4](https://fontawesome.com/v4.7.0/icons/) včetně jejich uložení k vlastní stránce, tj. bez CDN.
  * Podívejte se na jejich [příklady užití](https://fontawesome.com/v4.7.0/examples/), zvláště na Animated Icons a Stacked Icons.


:+1:


## Výstupy cvičení
* Student by měl vědět, co znamená, když se řekne: "responzivní design (webu)", a měl by umět vytvořit "sloupcový responzivní design".
* Student by měl vědět, že existují CSS frameworky, jako např. Bootstrap, a měl by být schopen je použít. 
* Student by měl vědět, že existují fonty s ikonami, jako např. Font Awesome, a měl by být schopen je použít.
* **Semestrální práce** - student by nyní měl být schopen navrhnout si vlastní šablonu (HTML + CSS + Fonty), kterou využije v semestrální práci.
  * Je dobré udělat si úvodní stránku webu, včetně menu apod., formulář pro vytvoření uživatele a alespoň jednu obsahovou stránku, včetně seznamu a tabulky. Pozn.: doporučuji udělat si, protože nyní (nejspíš) máte čas si s šablonou trochu hrát a nemáte (zatím) hlavu zamotánu o Twig či PHP.
  * Vytvořenou šablonu následně použijete ve své samostatné práci (bez ohledu na to, zda použijete či nepoužijete Twig).  


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :horse:
