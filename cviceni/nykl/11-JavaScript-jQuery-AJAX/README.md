# 11. cvičení KIV/WEB - JavaScript, jQuery a AJAX

* Pro každý úkol budete potřebovat jednu kopii souboru zakladni-stranka.html beze změn.
  * Doporučuji vždy zkopírovat soubor a doplnit si příponu (JS, jQuery, AJAX).
* Pro testování/výpisy JavaScriptu využijte konzoli prohlížeče (F12 - nástroje pro vývojáře).
* JavaScripty je dobré načítat na konci HTML souboru, aby nebylo zdržováno vykreslování stránky.
  * Tj. nejprve je uživateli načteno a zobrazeno HTML včetně stylů 
  a až následně se získají a popř. provedou JavaScriptové kódy.

 
## 1. Úkol - JavaScript (JS)

* Vytvořte funkci, která sečte hodnoty ze vstupních polí s **id="muj_vstup_a"** a **id="muj_vstup_b"**
a výsledek zobrazí v elementu s **id="vysledek"**. Funkci přiřaďte příslušnému tlačítku
  (využijte atributy *.value* a *.innerHTML* a funkci *Number("123")* pro převod textu na číslo).
* Přidejte do HTML kódu JS, který změní hlavní nadpis stránky na *"Stránka s JS"* 
a přiřadí mu třídu *barva* (využijte atributy *.innerHTML* a *.className*).
  * Nejprve si vyzkoušejte okamžité provedení (tj. napište kód pouze "do stránky").
  * Následně kód přesuňte do funkce a tu volejte až po plném načtení stránky (událost **onLoad**).
* Očíslujte odkazy, které mají v atributu *href* hodnotu *http://kiv.zcu.cz* a současně nemají třídu *ma-titulek*  
  * Musíte získat všechny odkazy, projít je pomocí cyklu a testovat hodnotu v atributu *.href* a hodnotu v atributu *.className* 
  (pozor, HTML element může mít přiřazeno více tříd).
  * Pro zvýraznění můžete odkazům nastavit třídu *barva*.
* Vytvořte funkci pro periodickou změnu 2 obrázků v elementu obrázku, který je předán jako parametr funkce, 
a přidejte tuto funkci k danému obrázku jako reakci na klik myši. Obrázky můžete použít tyto:
  * https://www.kiv.zcu.cz/site/documents/verejne/katedra/dokumenty/kiv-logo-cernobile.png
  * https://www.kiv.zcu.cz/site/documents/verejne/katedra/dokumenty/dcse-logo-barevne.png


## 2. Úkol - jQuery (JavaScriptová knihovna) 

* Kde to lze, tak využijte jQuery namísto JavaScriptu - usnadní vám práci. Části kódu lze přejmout z prvního úkolu.
* Načtěte knihovnu [jQuery](https://jquery.com):
  * Buďto si ji stáhněte ručně nebo s využitím Composeru (či jiného nástroje),
  * Nebo využijte externí zdroj, např. CDN *https://code.jquery.com/jquery-3.4.1.js*
* Vytvořte funkci, která sečte hodnoty ze vstupních polí s **id="muj_vstup_a"** a **id="muj_vstup_b"**
  a výsledek zobrazí v elementu s **id="vysledek"**. 
  Funkci po načtení stránky přiřaďte příslušnému tlačítku.
* Po načtení stránky změňte hlavní nadpis stránky na *"Stránka s jQuery"* a přiřaďte mu třídu *barva*.
* Očíslujte odkazy, které mají v atributu *href* hodnotu *http://kiv.zcu.cz* a současně nemají třídu *ma-titulek*:
  * Odkazy se správnou hodnotou v atributu *href* získejte přímo selektorem 
  a z nich funkcí *.not()* odfiltrujte ty, které mají třídu *ma-titulek*. 
  * Pro číslování odkazů použijte funkci *.each(index,element)*.
  * Pro zvýraznění můžete odkazům nastavit třídu *barva*.
* Hlavnímu nadpisu v reakci na klik přiřaďte funkci, která skryje/odkryje všechny obrázky (použijte funkci *.toggle()*).
* Při změně hodnoty ve vstupním poli s **id="muj_vstup_a"** zobrazte alert s novou hodnotou:
  * Použijte událost *onChange* a funkci *alert()*.
  * Zkušenější se mohou pokusit zobrazit i předchozí hodnotu:
    * Při načtení dokumentu a při každé změně hodnoty si ji musíte někam uložit, např. do vlastního atributu.
* Všem lichým řádkům tabulky přiřaďte třídu *barva* a nastavte barvu pozadí na *pink*.
* [+] Prvnímu textovému odstavci odstraňte současné HTML elementy, všechna jeho slova uzavřete do samostatných SPAN elementů 
a zajistěte, aby slova střídala barvu pozadí "pink", "yellow" a "plum".
  * Nejprve si získejte text, rozdělte ho dle mezer a všechna slova vraťte zpět do odstavce, 
  jen každé bude uvnitř vlastního SPAN elementu.
  * Selektujte SPAN elementy prvního odstavce s omezením na (3n), (3n+1) a (3n+2) a nastavte jim příslušné barvy pozadí. 
  
  
## 3. Úkol - AJAX (Asynchronní JavaScript a XML)

* Zprovozněte si stránku **server-ajax.php** na Vašem serveru:
  * Pokud na ni přistoupíte bez parametrů, tak vypíše "NEMAM VSTUPNI DATA".
  * Pokud na ni metodou GET nebo POST odešlete parametry **vstup_a** a **vstup_b**, tak vypíše jejich součet. 
* Načtěte knihovnu [jQuery](https://jquery.com), jako u 2. úkolu.
* Vytvořte funkci s parametry např. *vstupA*, *vstupB* a *vystupniElement*,
která metodou POST na server na stránku *server-ajax.php* odešle (tj. AJAX)  *vstupA* a *vstupB* v parametrech **vstup_a** a **vstup_b** 
a přijatý výsledek zobrazí v elementu *vystupniElement*.
  * Vytvořte (další) funkci, která vezme hodnoty ze vstupních polí s **id="muj_vstup_a"** a **id="muj_vstup_b"** 
  a element s **id="vysledek"** a zavolá s nimi předchozí funkci pro AJAX. Cílem je použít AJAX pro sečtení hodnot *A* a *B*.
  * Ošetřete chybové stavy AJAXu výpisem alertu
    * Správnost ošetření chybových stavů ověříte např. zadáním chybné URL adresy.
* [+] Doplňte na spodek stránky tlačítko s následující funkcí:
  * Při kliku doplní do tabulky poslední/další sloupec pro součty řádků,
  * současně pro každý řádek vezme ID a délku příslušného textu (*druh*), 
  připravenou funkcí je nechá AJAXem na serveru sečíst
  a výsledek zobrazí v posledním sloupci tabulky (pozn.: nad smyslem zde nepřemýšlejte).
    * Protože PHP skript obsahuje náhodnou dobu zpoždění vrácení výsledku, 
    tak byste měli vidět, jak jsou čísla do tabulky průběžně doplňována.


## Úkoly na doma

* Podívejte se na strukturu datových formátů [CSV (*Comma-Separated Values*)](https://www.w3schools.in/python-tutorial/data-processing-and-encoding/#Defining_CSV_Files), 
[JSON (*JavaScript Object Notation*)](https://www.w3schools.com/whatis/whatis_json.asp) 
a popř. [XML (*Extensible Markup Language*)](https://www.w3schools.com/whatis/whatis_xml.asp).
  * Pozn.: V CSV je lepší jako oddělovač použít středník, protože je v textech méně častý než čárka.
* Projděte si informace týkající se [HTML DOM (Document Object Model)](https://www.w3schools.com/whatis/whatis_htmldom.asp).
* Projděte si následující [stránky manuálu JS na W3Schools](https://www.w3schools.com/js/):
  * JS Where To (kam psát JS), JS Syntax, JS Comparisons (== vs. ===).
  * JS Data Types, JS Objects, JS Events.
  * JS String Methods, JS Number Methods, JS Array Methods, JS Array Sort, JS Array Iteration.
  * JS RegExp, JS Strict Mode, JS Classes.
  * JS Best Practices, JS JSON.
* Dle vlastního zájmu si projděte [stránky manuálu jQuery na W3Schools](https://www.w3schools.com/jquery/default.asp):
  * Doporučuji podívat se na: 
  jQuery AJAX (celá sekce), jQuery Selectors, jQuery Events, 
  jQuery Traversing (celá sekce; zvláště filtrování).
  

## Výstupy cvičení

* Student by měl vědět, jakými způsoby lze do HTML vložit/přidat JavaScript.
* Student by měl být schopen psát v JavaScriptu jednoduché algoritmy.
* Student by měl vědět, jak do HTML přidat jQuery knihovnu 
a měl by být schopen využít ji pro psaní jednoduchých algoritmů.
* Student by měl vědět, co je HTML DOM a měl by ho být schopen procházet a upravovat 
využitím JavaScriptu anebo jQuery.
  * Student ví, jak selektovat prvky z DOM (tj. selektory jQuery vs. funkce JavaScriptu).
* Student by měl vědět, co je AJAX a měl by být chopen ho vytvořit a používat 
(buď prostřednictvím čistého JavaScriptu, anebo prostřednictvím jQuery).
* **Semestrální práce:** 
  * Student by nyní měl být schopen doplnit svou semestrální práci o JavaScript/jQuery a AJAX
    * Hodnoceno bonusovými body.
  * Student by nyní měl mít všechny potřebné znalosti pro kompletní vypracování samostatné práce.


:+1:


### Poznámky
* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :snake: