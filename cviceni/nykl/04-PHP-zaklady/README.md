# 4. cvičení KIV/WEB - Bootstrap a základy PHP.


## 1. úkol - (opakování) Bootstrap Grid System

* Doplňte soubor bootstrap.html tak, aby při změně šířky prohlížeče vypadal jeho obsah tak, jak ukazují obrázky 1-4.png. Pozn.: kaskádový styl neupravujte, ale využijte [Grid System Bootstrapu](http://www.w3schools.com/bootstrap/bootstrap_grid_system.asp).
* Uvažujte defaultní nastavení Bootstrapu:
  * Mobilní zařízení ( < 768px ) - 1-mobil.png.
  * Tablet ( >= 768px ) - 2-tablet.png.
  * PC ( >= 992px ) - 3-PC.png.
  * Velká obrazovka ( >= 1200px ) - 4-velka-obrazovka.png.
* Snažte se o co nejmenší změnu kódu, tj. nevytvářejte nadbytečné atributy.
* Tlačítka:
  * Mobil - 2 na řádce.
  * Tablet - 3 na řádce.
  * PC - 6 na řádce.
* Obsah (tři elementy obsahu):
  * Mobil - vše přes celý řádek.
  * Tablet - 2 na řádce (50/50) a poslední přes celý řádek.
  * PC - 2 na řádce (8/4) a poslední přes celý řádek.
  * Velká obrazovka - 3 na řádce (33/33/33).
* Zápatí:
  * Mobil - vše přes celý řádek.
  * Tablet - 3 na řádce.
  
## 2. úkol - základ PHP

### 1.část

* Prohlédněte si prezentaci k tomuto cvičení.
* Vytvořte nový soubor s názvem funkce.php a načtěte ho v souboru form.php.
* V souboru form.php doplňte formuláři odesílání metodou POST na soubor vystup.php.
* V souboru funkce.php vytvořte funkci pro načtení řádek ze souboru zvirata.txt.
* V souboru form.php doplňte select box tak, aby obsahoval volby načtené ze souboru zvirata.txt (využijte vytvořenou funkci ve funkce.php).
* V souboru vystup.php načtěte soubor funkce.php a ten doplňte o funkci vypisující předané pole do tabulky. Pokud je pole prázdné, tak vypište "prázdné pole". Danou funkci volejte v souboru vystup.php se správným parametrem v části POST i v části GET.
* V souboru funkce.php vytvořte funkci pro uložení tabulky do HTML souboru. Soubor bude mít název “rok-mesic-den_hodina-minuty-sekundy.html” a bude ukládán do adresáře “vystup”. Kontrolujte také existenci adresáře "vystup" a pokud neexistuje, tak ho vytvořte. (Pomoc: použijte funkci datumu date("Y-m-d_H-i-s") ).
  * Danou funkcionalitu přidejte do souboru vystup.php tak, aby při neprázdném vstupu uložila tento vstup do souboru ve formě HTML tabulky (tj. vždy, když jsou odeslána data z formuláře).

### 2.část

* V souboru funkce.php vytvořte 3 funkce, který vypíší odlišné pozdravy (např. funkce a, c, n, které vypíší "ahoj", "čau", "nazdar").
* V souboru form.php vytvořte nový selekt box s názvem "pozdrav", který bude umožňovat volbu názvu daných funkcí (tj. např. a, c, n).
* V souboru vystup.php nebo funkce.php doplňte funkcionalitu, která na základě vstupu ze selekt boxu zavolá odpovídající funkci ze souboru funkce.php.

### 3.část

* Zkuste si vytvořit a vypsat asociativní (multi-typové) pole.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :panda_face: