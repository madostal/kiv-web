# 2. cvičení KIV/WEB - webová stránka s HTML 5 a CSS

## 1. úkol - formulář v HTML 5

* Vytvořte česky psanou stránku s kódováním UTF-8. 
* Vyplňte hlavičku stránky libovolnými daty.
* Vytvořte formulář s následujícími vstupy:
  * Příslušné typy INPUT elementu
    * Login (name=login), E-mail (name=mail), Heslo (name=heslo) - musí být zadáno.
    * Pohlaví (Žena/Muž) (name=pohlavi) - využijte typ "radio" a názvy vložte do LABEL.
    * Datum narození (name=narozeni) - pozn.: kalendář zobrazí jen některé prohlížeče, např. Chrome.
    * Oblíbená barva (name=barva).
    * Nahrání fotografie (name=foto) - lze zvolit více souborů, ale pouze obrázky (accept="image/*").
    * Výška v cm (name=vyska) - využijte typ "number" (min=50, max=250, step=10, value=170).
    * Počet dětí (name=deti) - využijte typ "range", nastavte min/max a výsledek nechte zobrazit v [OUTPUT](https://www.w3schools.com/tags/tag_output.asp).
  * Příslušné typy SELECT elementu
    * Auto (name=auto) - využijte OPTGROUP a auta rozdělte na Švédská (Volvo, Saab) a Německá (Mercedes, Audi). Defaultně bude vybrán Mercedes. Zvolit lze pouze jedno auto.
    * Domácí zvíře (name=zvire[]) - vyplňte 5 libovolných zvířat, viditelné nechte 3 položky seznamu a uživateli nechte možnost zvolit více zvířat.
  * INPUT element s DATALISTem
    * Oblíbená stanice (name=stanice) - vytvořte DATALIST s pěti stanicemi (audio/tv/cokoliv) a přiřaďte ho k danému INPUT elementu.
    * Nastavte elementu atribut PLACEHOLDER.
  * TEXTAREA element
    * O mě (name=ome) - textová oblast přes 4 řádky a 30 sloupců.
  * Doplňte tlačítka (INPUT) pro smazání a odeslání formuláře.
  * Doplňte tlačítko (BUTTON) pro vypsání alertu s textem "Hello Word" (JS: onclick="alert('Hello Word')" ).
* Do vlastní složky na Students.kiv.zcu.cz nahrajte soubor formular-zobrazeni.php.
  * Alternativně lze využití: http://students.kiv.zcu.cz/~nyklm/+studenti-kiv-web/02-formular-zobrazeni.php .
  * Pozn.: raději jako alternativu využijte předchozí URL a vlastní soubor si zkuste, pokud Vám zbyde čas.
* Do hlavičky formuláře doplňte metodu odeslání (method, get/post), URL adresu souboru formular-zobrazeni.php (action) a informaci, že se má výsledek zobrazit na nové záložce/stránce (target="blank").
* Odešlete formulář s GET a s POST a všimněte si změny URL adresy v případě GET.
* Použijte na stránku [validátor HTML](https://validator.w3.org/) a opravte případné chyby a varování (pozn.: “lang” [http://www.iana.org/assignments/language-subtag-registry/language-subtag-registry](http://www.iana.org/assignments/language-subtag-registry/language-subtag-registry) ).
* Zkuste některému vstupnímu prvku nastavit AUTOFOCUS (po načtení stránky) a využít TABINDEX (stisky TABu).
* Prohlédněte si URL adresu při odeslání metodou GET a zkuste v ní něco změnit.


## 2. úkol - základy CSS

* Využijte stránku konference.html a doplňte do ní odkaz na externí CSS, který si sami vytvoříte. Název např. styl.css.
* Veškeré změny budete nadále provádět pouze ve svém CSS souboru.
* Prohlédněte si HTML dané stránky a dále nové [sémantické elementy v HTML 5](http://www.w3schools.com/html/html5_semantic_elements.asp).
* Pozadí celé stránky nastavte libovolný přeliv barev (např.: linear-gradient(red,orange,yellow,green,blue,brown); ).
* Celý obsah stránky je v elementu s id="obal". 
  * přiřaďte tomuto elementu šířku 600px. 
  * zarovnejte ho na střed stránky s horním a dolním odsazením 10px (vnější odsazení - margin:10px auto;)
  * a nastavte mu bílé pozadí s 50% průhledností (rgba(255,255,255,0.5)).
* Hlavičce stránky nastavte velikost písma xx-large, zarovnání na střed, barvu písma darkred a vnitřní horní i dolní odsazení na 10px (padding).
* Navigaci nastavte:
  * tečkovaný hnědý spodní okraj, široký 2px (border-bottom:2px dotted brown).
  * vnitřní odsazení 15px.
* Odkazům v navigaci (bez najetí myši) nastavte: 
  * vnější odsazení 3px
  * vnitřní odsazení 5px shora a zdola a 20px ze stran.
  * modrý 1px rámeček.
  * barvu pozadí na světle modrou.
  * font sans-serif.
  * tloušťku textu bolder.
  * odstraňte dekoraci textu (text-decoration: none;).
* Odkazy v navigaci, pokud na ně najedu myší:
  * barva pozadí černá a barva textu bílá.
  * text podtržený.
* Všem prvkům s třídou chyba nastavte:
  * tmavě červené písmo i rámeček (tloušťka 2px).
  * zaoblené rohy rámečku (border-radius: 20px;).
  * vnitřní i vnější odsazení 20px.
* Text hlavního nadpisu zarovnejte na střed stránky.
* Novinkám (id=novinky) nastavte:
  * šířku 110px.
  * boční vnější i vnitřní odsazení 10px.
  * tmavě zelený 2px okroj se zaoblenými rohy (20px).
  * obtékání zprava (float:right).
* Článkům (element Article) nastavte:
  * vnější odsazení 20px.
  * šířku 420px.
  * zarovnání textu do bloku.
* Při najetí myši na odstavec (element P) mu nastavte:
  * černou barvu pozadí a bílý text.
  * vnitřní odsazení 5px.
* Patičce nastavte:
  * zarovnání textu na střed.
  * bílý text.


## 3. úkol - audio a video v HTML 5

* Prohlédněte si zdrojový kód souboru audiovideo-ukazka.html
* Nastavte audiu vypnutý zvuk a automatické přehrávání v nekonečné smyčce.
* Ostatní pokusy si nechte na doma.


:+1:


### Poznámky

* Příklad můžete stáhnout v ZIP archivu.
* ZIP archiv s řešením vyžaduje heslo :rat: