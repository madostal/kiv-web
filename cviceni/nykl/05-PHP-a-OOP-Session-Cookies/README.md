# 5. cvičení KIV/WEB - PHP a OOP, Session a Cookies.

* Nejprve si projděte prezentaci k tomuto cvičení.
* Pokud Vám PhpStorm neumožňuje definovat datové typy parametrů funkcí, tak je to nejspíš proto, 
že má nastavenu verzi PHP nižší, než 7.0
  * Zvolit: File --&gt; Settings --&gt; Languages &amp; Frameworks --&gt; PHP --&gt; PHP language level --&gt; zvolit alespoň v.7.0 

## 1. úkol - Základy objektově orientovaného programování (OOP) v PHP

* Prohlédněte si následující obrázek (popř. oop_class_diagram.png) s diagramem tříd 
  * Příklad vychází z příkladu na OOP v předmětu KIV/UUR - děkuji Richardovi Lipkovi.
  * Příklad je pouze doplněn o počítání instancí jednotlivých tvarů, což v UML není znázorněno, viz další popis.
  
![OOP diagram tříd]("OOP-zadani/oop_class_diagram.png") 

* Prohlédněte si soubor **OOP.php**, který spouští celou aplikaci (zkuste si ho spustit).
  * Všimněte si, jakým způsobem jsou zde načítány třídy jednotlivých tvarů.
  * V celém cvičení si všímejte komentářů, které mnohdy obsahují důležité notace.
  * Pole *$shapes* a *$areas* jsou plněny jednotlivými objekty a vypisovány.
  * Vaším cílem je implementovat jednotlivé objekty dle přiloženého UML diagramu a správnou funkcionalitu aplikace
    testovat odstraněním komentářů příslušným řádkům v souboru OOP.php.

### 1. úkol - Postup řešení
* Implementujte rozhraní **IDrawable**, které pouze stanovuje, 
  že má existovat veřejná metoda *draw()* pro vykreslení příslušného tvaru.
* Implementujte abstraktní třídu **AGeometricShape**, která implementuje IDrawable 
  a definuje soukromé parametry *x*, *y*, *name* a *myId* a statický parametr *id* s defaultní hodnotou 0.
  * Implementujte konstruktor, který nastaví parametry *x*, *y* a *name*, zvýší hodnotu parametru *id* 
    a jeho současnou hodnotu přiřadí parametru *myId*.
  * Implementujte (nebo si nechte vygenerovat) gettery pro všechny parametry vyjma parametru *id*.
* Implementujte třídu **CPoint**, která dědí od AGeometricShape.
  * Nevyžaduje vlastní konstruktor, protože nepřidává žádný nový parametr.
  * Stačí implementovat metodu *draw()*.
    * Vhodným způsobem vypište parametry *myId*, *name*, *x* a *y*.
    * Doplňte výpis o vypsání názvu příslušné třídy (funkce *get_class($this)*).
* Implementujte třídy **CLine** a **CCircle**, které dědí od AGeometricShape.
  * Třída CLine přidává parametry *lenght* (délka) a *scope* (smernice) a třída CCircle přidává parametr *radius* (poloměr).
  * Vytvořte odpovídající konstruktor, který základní parametry předává rodiči.
  * Implementujte příslušnou metodu *draw()*.
* Implementujte rozhraní **IHasArea**, které pouze stanovuje, 
  že má existovat veřejná metoda *getArea()*, která vypisuje obsah daného tvaru.
* Implementujte abstraktní třídu **ATetragon** (čtyřúhelník), která dědí od AGeometricShape 
  a implementuje rozhraní IHasArea.
  * ATetragon přidává parametr *color*, včetně příslušného konstruktoru.
* Implementujte třídy **CSquare** a **CRectangle**, které dědí od třídy ATetragon.
  * Implementujte funkce pro vykreslení tvaru a pro výpočet jeho obsahu.
* Pokud jste tak dosud neučinili, tak ověřte správnou funkcionalitu aplikace odkomentováním příslušných řádků
  v souboru OOP.php (tj. naplnění polí *$shapes* a *$areas*).
   

## 2. úkol - Práce se Session a Cookies 

* Cílem úkolu je použít Session pro správu přihlášení uživatele 
a Cookie pro uchování jím navolených voleb v jeho webovém prohlížeči. 

### 1. část 2. úkolu - Správa přihlášení uživatele (Session)

* Vaším cílem je vytvořit funkční správu přihlašování uživatele na web, která umožní jeho přihlášení, 
kontrolu, zda je uživatel přihlášen, a odhlášení.
* Implementujte třídu (např. MySession), která umožní ukládání, načítání, text existence a mazání hodnoty ze session.
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
   a zprovozněte tlačítko pro odhlášení uživatele a menu s jediným odkazem (Nákup auta).
  * Protože informace o uživateli obsahuje i následující stránka, tak zvažte, zda nezakomponovat výpis informací o uživateli do odpovídající třídy.
* Soubor nakup-auta.php doplňte tak, aby přihlášenému uživateli ukázal svůj obsah a nepřihlášenému napsal, že není přihlášen a odkázal ho na přihlášení. 
Přihlášený uživatel může také vidět informace o svém přihlášení.
* Otestujte vytvořenou funkcionalitu.
  * Při zavření prohlížeče by se sessions mely (automaticky) vymazat a uživatel tedy bude automaticky odhlášen.


### 2. část 2. úkolu - Uchování dat uživatele (Cookie)

* Vaším cílem je umožnit uživateli ukládat data do cookie ve svém prohlížeči
a opětovně zobrazovat např. při další návštěvě webu. 
* Implementujte třídu (např. MyCookie), která umožní ukládání, načítání, text existence a mazání hodnoty z cookie.
  * Cookies defaultně ukládejte na dobu 10 dnů (v sekundách 60x60x24x10).
  * Pro usnadnění lze upravit kopii třídy obstarávající práci se session.
* Volitelně:
  * Vytvořte třídu pro ukládání, načítání a mazání informací o zvoleném automobilu do/z cookies.
* Zakomponujte výše zmíněné do souboru nakup-auta.php
  * Pokud uživatel odešle formulář, tak se příslušné informace uloží do cookies
  a na stránce, v části "Vybraný automobil", se vypíše informace o automobilu - za každé kolo vytvořte jeden čtverec (např. 50x50px) se zvolenou barvou pozadí.
  * Pokud uživatel zvolí smazání dat, tak vymažte hodnoty uložené v cookie.
* Otestujte vytvořenou funkcionality.
  * Informace by měly zůstat uchovány i po zavření a znovu spuštění prohlížeče (pozn.: to, že se zobrazí pouze přihlášenému uživateli, už bylo zprovozněno v 1. části úkolu).


## Úkoly na doma
TODO ...


## Výstupy cvičení
* Student by měl umět používat v PHP objektový přístup, tj. chápat význam třídy, abstraktní třídy a rozhraní a umět je používat.
* Student by měl vědět, k čemu slouží Session a Cookie a měl by je umět v PHP kódu používat.
  * Student by měl znát také jejich dobu platnosti.
* **Semestrální práce** student by nyní měl být chopen připravit si objekty 
pro práci se Session a Cookie a objekt pro správu přihlášení uživatele (zatím bez databáze).
  * Ve správě přihlášení uživatele si připravte funkci pro přihlášení uživatele, 
  která nyní může kontrolovat zadaná data vůči napevno uloženým proměnným (login a heslo). 
  V budoucnu tuto funkci pouze rozšíříte o kontrolu zadaných dat vůči databázi.



:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :monkey: