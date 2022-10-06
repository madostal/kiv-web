# 2. cvičení KIV/WEB - formulář v HTML 5 a základy CSS

* Doporučené tutoriály: www.w3schools.com/html/ a www.w3schools.com/css/

## 1. úkol - formulář v HTML 5

* Prohlédněte si soubor formular.html.
* Do obsaženého formuláře doplňte následující vstupní elementy:
  * Všechny elementy mají připraveny LABELy, které určují jejich ID.
  * Elementy INPUT:
    * Login (name=login), E-mail (name=mail), Heslo (name=heslo) - všechny musejí být zadány, jinak nelze formulář odeslat.
    * Pohlaví (Žena/Muž) (name=pohlavi) - využijte typ "radio"; Zkuste si odstranit příslušné elementy LABEL.
    * Datum narození (name=narozeni) - pozn.: klikatelný kalendář zobrazí jen některé prohlížeče, např. Firefox či Chrome.
    * Oblíbená barva (name=barva).
    * Nahrání fotografie (name=foto) - lze zvolit více souborů, ale pouze obrázky (accept="image/*").
    * Výška v cm (name=vyska) - využijte typ "number" (min=50, max=250, step=10, value=170).
    * Počet dětí (name=deti) - využijte typ "range" a nastavte min/max; Vybranou hodnotu zobrazte v elementu [OUTPUT](https://www.w3schools.com/tags/tag_output.asp).
  * Elementy SELECT:
    * Auto (name=auto) - využijte OPTGROUP a auta rozdělte na Švédská (Volvo, Saab) a Německá (Mercedes, Audi). Defaultně bude vybrán Mercedes. Zvolit lze pouze jedno auto.
    * Domácí zvíře (name=zvire[]) - doplňte volby pro 5 libovolných zvířat, viditelné nechte 4 položky seznamu, uživateli nechte možnost zvolit více zvířat současně a dvě zvířata vyberte defaultně.
  * INPUT element s DATALISTem:
    * Oblíbené stanice (name=stanice; name=stanice_2) - obě položky pro výběr nejoblíbenějších stanic využívají připravený DATALIST (pozn.: datalist volby nabízí, ale nevynucuje).
    * Nastavte elementu atribut PLACEHOLDER.
  * TEXTAREA element:
    * O mě (name=ome) - textová oblast přes 4 řádky a 30 sloupců.
  * Dodatečné atributy:
    * Zkuste některému vstupnímu prvku nastavit AUTOFOCUS (po načtení stránky) a využít TABINDEX (stisky TABu).
    * Nastavte elementům PLACEHOLDER.
  * Tlačítka:
    * Doplňte tlačítko INPUT pro odeslání formuláře.
    * Doplňte tlačítko BUTTON pro vymazání formuláře a část jeho textu vypište tučně.
    * Doplňte tlačítko (INPUT/BUTTON) pro vypsání JavaScriptového alertu s textem "Hello World"; Kód alertu: onclick="alert('Hello World')".
* Do vlastní složky na students.kiv.zcu.cz nahrajte soubor formular-zobrazeni.php a zobrazte si ho.
  * **Alternativně** lze využití: http://students.kiv.zcu.cz/~nyklm/+studenti-kiv-web/formular-zobrazeni.php 
  * Pozn.: raději jako alternativu využijte předchozí URL a nahrání a použití vlastního souboru si zkuste, pokud Vám zbyde čas.
* Do hlavičky formuláře doplňte metodu odeslání formuláře (method=get/post), URL adresu souboru formular-zobrazeni.php (action), kam bude formulář odeslán, dále informaci, že se má při odeslání stránka zobrazit v novém okně/záložce (target="_blank"), a přidejte informaci, že je odesílán soubor (atribut enctype="multipart/form-data").
* Odešlete formulář s GET a s POST a všimněte si změny URL adresy v případě GET.
  * Prohlédněte si URL adresu při odeslání metodou GET a zkuste v ní něco změnit.
  * Soubor bude odeslán pouze metodou POST, prostřednictvím metody GET je zaslán pouze název souboru.
* Použijte na stránku [validátor HTML](https://validator.w3.org/) a opravte případné chyby a varování.
* Prohlédněte si PHP skript v souboru formular-zobrazeni.php.
* Zkuste si následující hrátku se znakovou sadou odesílaných dat formuláře: 
  * Formuláři odeberte atribut *accept-charset* a stránce nastavte znakovou sadu na *Windows-1250*, tj. ```<meta charset="windows-1250">```.
  * Odešlete z formuláře písmeno *Ř*, načež na serveru se výpis pokazí, protože vypisuje vstup do stránky s *UTF-8*.
  * Doplňte formuláři atribut ```accept-charset="UTF-8"``` a znovu odešlete formulář s písmenem *Ř*. Nyní bude výpis na serveru správný, protože formulář se sice nachází na stránce se znakovou sadou *Windows-1250*, ale jeho data jsou na server odesílána se znakovou sadou *UTF-8*.


## 2. úkol - základy CSS

* Využijte stránku konference.html a doplňte do ní odkaz na soubor s kaskádovými styly, který si sami vytvoříte (např. styl.css).
  * Veškeré určování vzhledu stránky budete nadále provádět pouze ve svém CSS souboru.
* Prohlédněte si HTML dané stránky ([sémantické elementy v HTML 5](http://www.w3schools.com/html/html5_semantic_elements.asp)).
* Celé stránce nastavte na pozadí libovolný přeliv barev (např.: linear-gradient(red,orange,yellow,green,blue,brown);).
* Obsah stránky je v elementu s id="obal":
  * nastavte mu šířku 600px,
  * zarovnejte ho na střed stránky s horním a dolním vnějším odsazením 10px (margin:10px auto;),
  * a nastavte mu bílé pozadí s 50% průhledností (rgba(255,255,255,0.5)).
* Hlavičce stránky nastavte:
  * velikost písma xx-large, 
  * zarovnání na střed, 
  * barvu písma darkred 
  * a vnitřní horní i dolní odsazení na 10px (padding).
* Celému hlavnímu menu nastavte:
  * spodní okraj, který bude tečkovaný, hnědý a široký 2px (border-bottom:2px dotted brown)
  * a vnitřní odsazení 15px.
* Odkazům v navigaci (bez najetí myši) nastavte: 
  * vnější odsazení 3px,
  * vnitřní odsazení 5px shora a zdola a 20px ze stran,
  * modrý 1px rámeček,
  * barvu pozadí světle modrou (lightblue),
  * font sans-serif,
  * tloušťku textu bolder,
  * dobu trvání přechodu při změně pozadí 1s a při změně barvy písma 8s (transition),
  * a text, který není podtržený (text-decoration: none;).
* Odkazům v navigaci, pokud se na nich nachází kurzor myši, nastavte:
  * černou barvu pozadí a bílou barvu textu,
  * a text výrazněte podtržením.
* Všem alertům (třídy alert-error a alert-warning) nastavte:
  * tloušťku rámečku (tloušťka 2px),
  * zaoblené rohy rámečku (border-radius: 20px;),
  * a vnitřní i vnější odsazení 20px.
  * Třída alert-error bude mít tmavě červené písmo  i rámeček.
  * Třída alert-warning bude mít černé písmo a zlatý rámeček.
* Text hlavního nadpisu (h1) zarovnejte na střed stránky.
* Novinkám (id=novinky) nastavte:
  * šířku 110px,
  * boční vnější i vnitřní odsazení 10px,
  * tmavě zelený 2px okraj se zaoblenými rohy (20px),
  * a přichycení k pravé straně, tj. obtékání textem zleva (float:right).
* Článkům (element Article) nastavte:
  * vnější odsazení 20px,
  * šířku 420px,
  * text zarovnejte do bloku
  * a rozdělte do dvou textových sloupců.
* Prvnímu písmenu v prvním odstavci (element P) v elementu Article nastavte:
  * dvojnásobnou velikost textu
  * a velká písmena.
* Při najetí myši na odstavec (element P) mu nastavte:
  * černou barvu pozadí a bílý text.
* Při najetí myši na odstavec nastavte jeho odkazům zlatou barvu textu.
* Při najetí myši na odstavec a na jeho odkaz nastavte odkazu barvu textu na greenyellow.
* Tabulce nastavte:
  * šířku 100%,
  * barvu prvního řádku na oranžovou,
  * barvu sudých řádků na antiquewhite,
  * barvu lichých řádků na burlywood
  * a barvu řádků (vyjma prvního) při najetí myši na světle modrou.
* Elementům s atributem title v elementu Article nastavte dolní šedé tečkované podtržení.
* Odkazům v elementu Article:
  * pokud odkazy začínají HTTPS, tak před ně doplňte libovolný znak z mapy znaků a nastavte mu červenou barvu.
  * pokud jsou odkazy z domény CZ, tak za ně doplňte libovolný znak z mapy znaků a nastavte mu žlutou barvu.
* Patičce nastavte:
  * zarovnání textu na střed,
  * a bílý text.
* Patička obsahuje SPAN se třídou "info", který by defaultně neměl být zobrazen a při najetí myši na patičku by se měl zobrazit jako blokový element, tj. na novém řádku.
* Nápovědě nastavte:
  * fixovanou pozici 10px od spodního a pravého okraje okna,
  * šířku 100px a výšku 50px,
  * nějakou barvu pozadí a textu,
  * a text na střed buňky (pozn.: zde je více možností řešení, viz internet).
* Novinky obsahují dvojice slov v elementech SPAN. Určete jim barvu pozadí tak, aby každý třetí měl stejnou barvu, tj. stejné barvy budou mít dvojice v pořadí [1.,4.,7.,..], [2.,5.,8.,..], [3.,6.,9.,..]. Barvy mohou být např. yellow, greenyellow, lightsalmon (span:nth-child(3n+1)).
* Na konci stránky je jedno políčko formuláře. Zajistěte, aby vyplněné políčko bylo tmavě zelené a mělo bílý text, ale nevyplněné mělo defaultní vzhled (:not(:placeholder-shown)).
    

## Úkoly na doma

* Projděte si následující oblasti v tutoriálu k CSS na www.w3schools.com/css/. 
Opět je cílem hlavně vědět, co lze s CSS provádět a kde nalézt odpovídající informace.
* Oblasti:
  * [CSS Selectors](https://www.w3schools.com/cssref/css_selectors.asp), CSS How to, CSS Units. 
  * CSS Colors, CSS Backgrounds, CSS Borders.
  * CSS Margin nebo CSS Padding, CSS Box Model.
  * CSS Text, CSS Fonts, CSS Links, CSS Lists.
  * CSS Position, CSS Overflow.
  * Volitelně oblasti z části CSS Avanced, např. CSS Shadows, CSS Animations, CSS Tooltips apod.       
  * Volitelně cokoliv dalšího.


:+1:


## Výstupy cvičení
* Student by měl být schopen vytvořit HTML formulář se vstupními prvky, které svým typem odpovídají charakteru příslušných vstupních dat (např. heslo, volba seznamu apod.).
* Student by měl znát všechny základní CSS selektory (např. element, id, třída apod.), pseudo-selektory (např. :hover, ::before apod.) a atributy (např. barva a zarovnání textu apod.).
* Student by měl vědět o existenci "konkretizujících" selektorů (např. s &gt;, +, ~) a pokročilých vlastností/atributů CSS (např. stíny, animace) a měl by vědět, kde k nim nalézt informace.  
* Student by měl být schopen použít CSS na konkrétní HTML stránku.
* Student nemusí rozumnět "responzivitě" - bude obsahem následujícího 3. cvičení.


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :rat:
