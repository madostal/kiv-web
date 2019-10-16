# 4. cvičení KIV/WEB - Bootstrap a základy PHP.

* Na **students.kiv.zcu.cz** je globálně zakázán výpis chyb PHP. Pokud si je chcete zobrazit (doporučuji), tak vložte do hlavičky PHP souboru následující kód:
    **ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL)**;
* Více informací: [error_reporting](http://php.net/manual/en/function.error-reporting.php).


## 0. úkol - Opakování (Bootstrap Grid System)

* *Příklad na responzivní design Bootstrapu vznikl v předešlých letech a můžete ho využít pro zopakování si probírané látky.* 
* Doplňte soubor bootstrap.html tak, aby při změně šířky okna prohlížeče vypadal jeho obsah tak, jak ukazují přiložené obrázky. 
  * Pozn.: kaskádový styl neupravujte, ale využijte [Grid System Bootstrapu](http://www.w3schools.com/bootstrap/bootstrap_grid_system.asp).
* Uvažujte defaultní nastavení Bootstrapu (pozor, liší se ve verzích v3 a v4, ale přesné šířky okna nejsou pro tento příklad podstatné):
  * Mobilní zařízení ( < 768px ), viz obr. 1-mobil.png.
  * Tablet ( >= 768px ), viz obr. 2-tablet.png.
  * PC ( >= 992px ), viz obr. 3-PC.png.
  * Velká obrazovka ( >= 1200px ), viz obr. 4-velka-obrazovka.png.
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
  
## 1. úkol - Základy PHP

* Prohlédněte si prezentaci k tomuto cvičení.

### 1. část - Práce s proměnnými a funkcemi (1/2)

* Vytvořte nový soubor s názvem např. funkce.php a:
 * Vypište v něm libovolný text informující o funkčnosti PHP.
 * Vytvořte v něm funkce a(), b(), c(), které budou vypisovat libovolný pozdrav (např. ahoj, čau, nazdar). 
 * Zkuste si přiřazování hodnoty a přiřazování adresy do proměnné:
   * Vytvořte proměnnou $alfa a přiřaďte jí hodnotu "c". 
   * Vytvořte proměnnou $beta a přiřaďte jí hodnotu z $alfa. 
   * Vytvořte proměnnou $gama a přiřaďte jí adresu na $alfa.
   * Změňte hodnotu v $alfa na "b".
   * Použijte proměnné $beta a $gama a přímo zavolejte funkce, které udávají jejich hodnoty.

### 2. část - Přijmutí dat z formuláře

* Načtěte soubor funkce.php v souboru form.php a ověřte jeho funkcionalitu.
* Zvířata ze souboru zvirata.txt načtěte jako volby do příslušného seznamu ve form.php:
  * Do souboru funkce.php doplňte PHP funkci pro načtení souboru zvirata.txt a z načtených řádků vytvořte volby seznamu.
    * Zkuste si načíst soubor klasickým způsobem i s využitím funkce file_get_contents().
    * Zvířata načtěte do pole a teprve jeho obsah převeďte na volby seznamu.
    * Nezapomeňte kontrolovat, zda soubor existuje a je souborem.     
  * V souboru form.php volejte na správném místě příslušnou funkci pro vypsání voleb seznamu.
* Vypište data odeslaná z formuláře:
  * V souboru form.php doplňte formuláři odesílání metodou POST na soubor vystup.php (cíl můžete otevírat v novém okně).
  * V souboru vystup.php načtěte soubor funkce.php a ten doplňte o funkci, která umožní rekurzivně vypsat pole (předané jako parametr) do HTML tabulky (klíč v prvním sloupci a hodnota v druhém sloupci). Pokud je pole prázdné, tak vypište "prázdné pole".
    * Pozn.: je vhodné vytvořit funkci pro převod pole na HTML tabulku a tu volat z funkce, která zpracovává GET/POST a ověřuje, zda není pole prázdné. 
  * Danou funkci volejte v souboru vystup.php se správným parametrem v části POST i v části GET.
  * Ověřte správnou funkcionalitu.
  * Na pole si zkuste použít funkce print_r() a var_dump(), které lze případně vypsat v elementu &lt;pre&gt;.
* V souboru funkce.php vytvořte funkci pro uložení HTML tabulky, kterou jste získali v předešlém kroku, do HTML souboru. 
  * Soubor bude mít název "rok-mesic-den_hodina-minuty-sekundy.html" a bude ukládán do adresáře "vystup". Kontrolujte také existenci adresáře "vystup" a pokud neexistuje, tak ho vytvořte. Pozn.: použijte funkci pro získání aktuálního datumu date("Y-m-d_H-i-s").
  * Danou funkcionalitu doplňte do funkce, která zpracovává data odeslaného formuláře, a to tak, aby při neprázdném vstupu uložila tento vstup do souboru ve formě HTML tabulky.
    
### 3. část - Práce s proměnnými a funkcemi (2/2)

* Prohlédněte si HTML elementu formuláře (soubor form.php) pro volbu pozdravu (jeho hodnoty by vám měly něco připomínat).
* Doplňte funkci, která v souboru funkce.php vypisuje data formuláře, o výpis příslušného pozdravu:
  * Vytvořte novou funkci jen pro výpis pozdravu a připojte si do ní globální proměnné (global $alfa, $beta, $gama).
  * Na základě hodnoty v poli (pole["pozdrav"]) zavolejte funkci v příslušné proměnné.
  * Nově vytvořenou funkci volejte z funkce pro zpracování formuláře.
  
### 4. část - Přijmutí odeslaných souborů

* Pokud byly z formuláře odeslány nějaké soubory, tak je uložte na server do adresáře DATA ve Vaší složce, viz [PHP file upload](https://www.w3schools.com/php/php_file_upload.asp).
  * Pozor, velikost odesílaných souborů je limitována konfigurací PHP, přesněji jejími atributy *upload_max_filesize* (maximální velikost souboru) a *post_max_size* (maximální velikost celého POST požadavku) - nechte si vypsat jejich stávající hodnoty.
  * Pokud neexistuje adresář DATA, tak ho vytvořte.
  * Každý soubor na serveru zpracujte:
    * Vypište (zvlášť) jméno, příponu a velikost souboru.
    * Přeneste soubor na server tak, aby byl zachován jeho původní název (pozn.: pokud je server provozován na Windows, tak překonvertujte string z kódování "UTF-8" (dáno webem) na "WINDOWS-1250" (popř. jiné číslo, dle Vašeho lokálního prostředí)).
  * Doplňte danou funkcionalitu do funkce, která zpracovává data formuláře. 
   

## Úkoly na doma
TODO ...

## Výstupy cvičení
TODO ...

:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :panda_face:
