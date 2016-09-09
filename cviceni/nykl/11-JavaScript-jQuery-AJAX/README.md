# 11. cvičení KIV/WEB - JavaScript, jQuery a AJAX

## Úkoly:
 
* Pro každý úkol budete potřebovat jednu kopii souboru zakladni-stranka.html beze změn !
* Pro testování využijte konzoli prohlížeče.

 
### 1. Úkol - JavaScript (JS):
 
* Přidejte do kódu JS, který změní hlavní nadpis stránky na “Stránka s JS” a přiřadí mu třídu “barva” (pozn.: skript umístěte kamkoliv pod hlavní nadpis stránky; využijte .innerHTML a .className ).
* Očíslujte odkazy, které mají v atributu HREF hodnotu “http://kiv.zcu.cz” a současně nemají třídu “ma-titulek”  (pozn.: musíte získat všechny odkazy a projít je pomocí for(var i=0; i<odkazy.length; i++), dále testovat hodnotu v .href a hodnotu v .className ).
* V hlavičce stránky vytvořte funkci, která sečte hodnoty ze vstupních polí s id=“vstup-1” a id=“vstup-2” a výsledek zobrazí v elementu s id=”vysledek”. Funkci přiřaďte příslušnému tlačítku. (pozn.: využijte .value a .innerHTML a objekt Number(“123”) => číslo 123 ) .
* V hlavičce stránky vytvořte funkci pro periodickou změnu 2 obrázků v IMG s id=”obrazek” a přidejte ji k danému obrázku jako reakci na klik myši. Pro obrázky použijte:
  * https://www.kiv.zcu.cz/site/documents/verejne/katedra/dokumenty/kiv-logo-cernobile.png
  * https://www.kiv.zcu.cz/site/documents/verejne/katedra/dokumenty/dcse-logo-barevne.png


### 2. Úkol - jQuery:
* Kde to lze, tak využijte jQuery namísto JavaScritpu - usnadní vám práci. Části kódu lze přejmout z prvního úkolu.
* Přidejte do hlavičky stránky externí skript jQuery, např. takto:
```
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
```
* Do hlavičky stránky přidejte jQuery kód, který po načtení stránky změní hlavní nadpis stránky na “Stránka s jQuery”. Pozn.: jQuery kód pro toto cvičení pište vždy do záhlaví stránky, včetně přiřazení reakcí na události jednotlivým elementům po načtení stránky.
* Očíslujte odkazy, které mají v atributu HREF hodnotu “http://kiv.zcu.cz” a současně nemají třídu “ma-titulek”  (pozn.: odkazy se správnou hodnotou HREF získejte přímo selektorem a z nich odfiltrujte .not() ty, které mají třídu “ma-titulek”. Pro číslování použijte .each(ind,elem) ).
* Vytvořte funkci, která sečte hodnoty ze vstupních polí s id=“vstup-1” a id=“vstup-2” a výsledek zobrazí v elementu s id=”vysledek”. Funkci po načtení stránky přiřaďte příslušnému tlačítku.
* Hlavnímu nadpisu přiřaďte funkci, která při kliku skryje/odkryje obrázek (použijte .toggle() ).
* Při změně hodnoty ve vstupní poli s id=”vstup-1” nechte vyskočit alert s novou hodnotu (pozn.: použijte událost onchange a funkci alert() ).
* Všem lichým řádkům tabulky (elem. TR) přiřaďte do atributu class hodnotu “barva” - změní barvu textu v těchto řádcích na červenou.
 

### 3. Úkol - AJAX
* Zprovozněte si stránku server-ajax.php na “vašem” students.kiv.zcu.cz - pokud na ni přistoupíte, tak vypíše “NEMAM VSTUP (AJAX)”;
* Do zakladni-stranka.html připojte externí jQuery (jako u 2. úkolu).
* Do zakladni-stranka.html doplňte funkci, která vezme oba vstupy “vstup-1” a “vstup-2”, s využitím AJAXu je odešle na server na stránku server-ajax.php a  ve “vysledek” zobrazí přijatá data.
* Doplňte AJAXové volání ošetřením chyby a to výpisem chyby do alertu. Chybu lze získat např. zadáním špatné adresy serveru v AJAXovém volání.


:+1:


* Dále si zkuste, co uznáte za vhodné.


### Poznámky
* Příhlad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :snake: