# 5. cvičení KIV/WEB - PHP a OOP, Session a Cookies.

* Nejprve si projděte prezentaci k tomuto cvičení.
* Pokud Vám PhpStorm neumožňuje definovat datové typy parametrů funkcí a návratových hodnot, tak je to nejspíš proto, 
že má nastavenu verzi PHP nižší než 7.0. Viditelnost konstatních atributů třídy lze určovat od PHP **v.7.1**.
  * Varianta A: V PhpStormu lze zjistit a změnit verzi PHP ve spodní liště (dole vpravo). Zvolte alespoň v.7.1. 
  * Varianta B: Zvolit z menu File --&gt; Settings --&gt; Languages &amp; Frameworks --&gt; PHP --&gt; PHP language level --&gt; zvolit alespoň v.7.1
  * Pozor, toto se týká pouze PHPStormu a ne serveru, který by také měl používat PHP verze alespoň 7.1. Zjištění příkazem: *php -v* 

## 1. úkol - Základy objektově orientovaného programování (OOP) v PHP

* Prohlédněte si následující obrázek (popř. oop_class_diagram.png) s diagramem tříd 
  * Příklad vychází z příkladu na OOP v předmětu KIV/UUR - děkuji Richardovi Lipkovi.
  * Příklad je pouze doplněn o počítání instancí jednotlivých tvarů, což v UML není znázorněno, viz další popis.
  
![OOP diagram tříd](OOP-zadani/oop_class_diagram.png) 

* Prohlédněte si soubor **OOP.php**, který spouští celou aplikaci (zkuste si ho spustit).
  * Všimněte si, jakým způsobem jsou zde načítány třídy jednotlivých tvarů.
  * V celém cvičení si všímejte komentářů, které mnohdy obsahují důležité notace.
  * Pole *$shapes* a *$areas* jsou plněny jednotlivými objekty a vypisovány.
  * Vaším cílem je implementovat jednotlivé objekty dle přiloženého UML diagramu a správnou funkcionalitu aplikace
    testovat odstraněním komentářů příslušným řádkům v souboru OOP.php.

### Postup řešení
* Implementujte rozhraní **IDrawable**, které pouze stanovuje, 
  že má existovat veřejná metoda *draw()* pro vykreslení příslušného tvaru.
* Implementujte abstraktní třídu **AGeometricShape**, která implementuje IDrawable 
  a definuje soukromé parametry *x*, *y*, *name* a *myId* a statický parametr *id* s defaultní hodnotou 0.
  * Implementujte konstruktor, který nastaví parametry *x*, *y* a *name*, zvýší hodnotu parametru *id* 
    a jeho současnou hodnotu přiřadí parametru *myId*.
  * Implementujte (nebo si nechte vygenerovat) gettery pro všechny parametry vyjma parametru *id*. Pozn.: protože vytvořené tvary nebudeme chtít upravovat, tak settery nepotřebujeme.
* Implementujte třídu **CPoint**, která dědí od AGeometricShape.
  * Nevyžaduje vlastní konstruktor, protože nepřidává žádný nový parametr.
  * Stačí implementovat metodu *draw()*.
    * Vhodným způsobem vypište parametry *myId*, *name*, *x* a *y*.
    * Doplňte výpis o vypsání názvu příslušné třídy (funkce *get_class($this)*).
* Implementujte třídy **CLine** a **CCircle**, které dědí od AGeometricShape.
  * Třída CLine přidává parametry *length* (délka) a *scope* (smernice) a třída CCircle přidává parametr *radius* (poloměr).
  * Vytvořte odpovídající konstruktor, který základní parametry předá rodiči.
  * Implementujte příslušnou metodu *draw()*.
* Implementujte rozhraní **IHasArea**, které pouze stanovuje, 
  že má existovat veřejná metoda *getArea()*, která vypisuje obsah daného tvaru.
* Implementujte abstraktní třídu **ATetragon** (čtyřúhelník), která dědí od AGeometricShape 
  a implementuje rozhraní IHasArea.
  * ATetragon přidává parametr *color*, včetně příslušného konstruktoru.
* Implementujte třídy **CSquare** a **CRectangle**, které dědí od třídy ATetragon.
  * Implementujte funkce pro vykreslení tvaru a pro výpočet jeho obsahu.
* Doplňte třídu **CCircle** tak, aby implementovala rozhraní IHasArea, včetně příslušné metody *getArea()*. 
* Pokud jste tak dosud neučinili, tak ověřte správnou funkcionalitu aplikace odkomentováním příslušných řádků
  v souboru OOP.php (tj. naplnění polí *$shapes* a *$areas*).
   

## 2. úkol - Práce se Session a Cookies 

* Cílem úkolu je použít Session pro správu přihlášení uživatele 
a Cookie pro uchování uživatelem navolených voleb v jeho webovém prohlížeči. 

### 1. část - Správa přihlášení uživatele (Session)

* Vaším cílem je vytvořit funkční správu přihlašování uživatele na web, která umožní jeho přihlášení, 
kontrolu, zda je uživatel přihlášen, a odhlášení.
* Implementujte třídu (např. MySession), která umožní ukládání, načítání, test existence a mazání hodnoty ze session.
  * Samotnou session můžete zahájit např. v konstruktoru - 
  nezapomeňte, že session musí být zahájena před tím, než je uživateli odeslán výstup aplikace.  
* Volitelně:
  * Vytvořte třídu spravující přihlášení uživatele:
    * Budete potřebovat metodu pro přihlášení uživatele, metodu pro kontrolu přihlášení uživatele a metodu pro odhlášení uživatele.
    * V konstruktoru by měla být vytvořena instance objektu pro práci se session.        
* Zakomponujte víše zmíněné do souboru login.php tak, aby přihlášení fungovalo - 
uživatel se přihlašuje pouze svým jménem, které nesmí být prázdné, jinak není přihlášen.
  * Při přihlášení uživatele uložte i datum a čas jeho přihlášení (*date("H:i:s, d.m.Y")*).
  * Přihlášenému uživateli zobrazte jeho jméno a datum přihlášení
   a zprovozněte tlačítko pro odhlášení uživatele a menu s jediným odkazem (*Nákup auta*).
  * Protože informace o uživateli obsahuje i následující stránka, tak zvažte, zda nezakomponovat výpis informací o uživateli do odpovídající třídy.
* Soubor nakup-auta.php doplňte tak, aby přihlášenému uživateli ukázal svůj obsah a nepřihlášenému napsal, že není přihlášen a odkázal ho na přihlášení. 
Přihlášený uživatel může také vidět informace o svém přihlášení.
* Otestujte vytvořenou funkcionalitu.
  * Při zavření prohlížeče by se sessions mely (automaticky) vymazat a uživatel tedy bude automaticky odhlášen.


### 2. část - Uchování dat uživatele (Cookie)

* Vaším cílem je umožnit uživateli ukládat data do cookies ve svém prohlížeči
a opětovně je zobrazovat např. při další návštěvě webu. 
* Implementujte třídu (např. MyCookie), která umožní ukládání, načítání, text existence a mazání hodnoty z cookie.
  * Cookies defaultně ukládejte na dobu 10 dnů (v sekundách 60x60x24x10).
  * Pro usnadnění lze upravit kopii třídy obstarávající práci se session.
* Volitelně:
  * Vytvořte třídu pro ukládání, načítání a mazání informací o zvoleném automobilu do/z cookies.
* Zakomponujte výše zmíněné do souboru nakup-auta.php
  * Pokud uživatel odešle formulář, tak se příslušné informace uloží do cookies
  a na stránce, v části *Vybraný automobil*, se vypíše informace o automobilu - za každé kolo vytvořte jeden kruh (např. 50x50px) se zvolenou barvou pozadí.
  * Pokud uživatel zvolí smazání dat, tak vymažte hodnoty uložené v cookie.
* Otestujte vytvořenou funkcionalitu.
  * Informace by měly zůstat uchovány i po zavření a znovu spuštění prohlížeče (pozn.: to, že se zobrazí pouze přihlášenému uživateli, už bylo zprovozněno v 1. části úkolu).
  * Podívejte se do vývojářské konzole ve webovém prohlížeči (obvykle F12) do záložky s úložišti
  a zkontrolujte hodnoty v cookies.


## Úkoly na doma
* Prezentace ke cvičení obsahuje některé speciality, které je dobré si prohlédnout.
* Doporučuji podívat se alespoň na následující stránky [PHP tutoriálu na W3Schools](https://www.w3schools.com/php/default.asp):
  * PHP Inheritance, PHP Constants, PHP Abstract Classes, PHP Traits (jen o nich vědět), PHP Static Method.
    * Pokud se v OOP "topíte", tak doporučuji projít si celou oblast PHP OOP od začátku.
  * PHP Cookies, PHP Sessions.
  * PHP Superglobals (vědět o $_SERVER a $_REQUEST).
  
  
## Výstupy cvičení
* Student by měl umět v PHP používat objektově orientovaný přístup, tj. chápat význam třídy, abstraktní třídy a rozhraní a umět je používat.
* Student by měl vědět, k čemu slouží Session a Cookie, a měl by je umět v PHP aplikaci vhodně použít.
  * Student by měl znát také jejich dobu platnosti.
* **Semestrální práce** - student by nyní měl být chopen připravit si třídy 
pro práci se Session a Cookie a objekt pro správu přihlášení uživatele (zatím bez databáze).
  * Ve správě přihlášení uživatele si připravte funkci pro přihlášení uživatele, 
  která nyní může kontrolovat zadané údaje vůči napevno uloženým konstantám (login a heslo). 
  V budoucnu tuto funkci pouze rozšíříte o kontrolu zadaných dat vůči databázi.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :monkey:
