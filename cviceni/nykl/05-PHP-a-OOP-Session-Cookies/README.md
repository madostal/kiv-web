# 5. cvičení KIV/WEB - PHP a OOP, session, cookies.

* Nejprve si projděte prezentaci k tomuto cvičení.


## 1. úkol - správa přihlášení uživatele

* Cílem je vytvořit funkční přihlašování uživatele na web.
* Vytvořte třídu pro ukládání, načítání a mazání session.
* Vytvořte třídu umožňující přihlášení uživatele, tj.:
  * Budete potřebovat metodu pro zahájení session (např. v konstruktoru), metodu pro přihlášení uživatele, metodu pro kontrolu přihlášení uživatele a metodu pro odhlášení uživatele.
  * Při přihlášení uživatele uložte i datum a čas jeho přihlášení.
* Zakomponujte víše zmíněné do souboru login.php tak, aby přihlášení fungovalo.
  * Pozn.1: přihlášení zde nevyužívá heslo, tj. uživatel se přihlašuje pouze svým jménem.
  * Pozn.2: po přihlášení nebude rozlišováno, kdo se přihlásil (informace pro 2. úkol).
  * Přihlášenému uživateli se zobrazí jeho jméno a datum přihlášení. Dále je obsažena možnost odhlášení uživatele (zprovozněte) a menu s jediným odkazem (Nákup auta).
    * Protože informace o uživateli obsahuje i následující stránka, tak zvažte, zda nezakomponovat výpis informací o uživateli do odpovídající třídy.
* Soubor nakup-auta.php doplňte tak, aby přihlášenému uživateli ukázal svůj obsah a nepřihlášenému napsal, že není přihlášen a odkázal ho na přihlášení. Přihlášený uživatel by měl opět vidět informace o svém přihlášení.
* Otestujte vytvořenou funkcionalitu
  * Při ukončení prohlížeče by se session mely (automaticky) vymazat a uživatel tedy automaticky odhlásit.


## 2. úkol - uchování základních dat uživatele

* Cílem je vytvořit "systém" uchování informací o uživatelově "zvoleném automobilu".
* Vytvořte třídu pro ukládání, načítání a mazání cookies.
  * Cookies defaultně ukládejte na 1 den.
  * Pro ulehčení lze upravit kopii třídy obstarávající práci se session.
* Vytvořte třídu pro ukládání, načítání a mazání informací o zvoleném automobilu do/z cookies.
  * Opět můžete pro zjednodušení přepsat kopii některé z Vámi dříve vytvořených tříd.
  * Vytvořte funkci, která vypíše informace o automobilu tak, že za každé kolo vytvoří jeden čtverec (např. 50x50px) se zvolenou barvou pozadí.
* Zakomponujte předchozí třídu do souboru nakup-auta.php tak, aby se do cookies uložily informace z formuláře, popř. aby se smazaly.
  * Odpovídající informace také vypište pod "Vybraný automobil" (využijte dříve vytvořenou funkci).
* Otestujte funkčnost.
  * Informace by měly zůstat uchovány i po zavření a znovu spuštění prohlížeče. (pozn.: to, že se zobrazí pouze přihlášenému uživateli, už bylo zprovozněno v 1. úkolu).
  

* Prohlédněte si přiložené řešení příkladu (možná Vám rozšíří obzor). Pozn.: pokud myslíte, že jste něco vyřešil/a lépe, tak se mi přihlaste - rád uvidím lepší řešení.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :monkey: