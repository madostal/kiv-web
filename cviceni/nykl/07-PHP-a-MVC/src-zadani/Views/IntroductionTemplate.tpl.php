<?php
/////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni uvodni stranky  ///////////
/////////////////////////////////////////////////////////////

//// pozn.: sablona je samostatna a provadi primy vypis do vystupu:
// -> lze testovat bez zbytku aplikace.
// -> pri vyuziti Twigu se sablona obejde bez PHP.

//// UKAZKA: Uvod bude vypisovat informace z tabulky, ktera ma nasledujici sloupce:
// id, date, author, title, text
$tplData['title'] = "Úvodní stránka (TPL)";
$tplData['stories'] = [
    array("id_introduction" => 1, "date" => "2016-11-01 10:53:00", "author" => "A.B.", "title" => "Nadpis", "text" => "abcd")
];
define("DIRECTORY_VIEWS", "../Views");
const WEB_PAGES = array(
    "uvod" => array("title" => "Úvodní stránka (TPL)")
);


//// TODO - vypis sablony
// urceni globalnich promennych, se kterymi sablona pracuje
// global $tplData;

// pripojim objekt pro vypis hlavicky a paticky HTML
// require(DIRECTORY_VIEWS ."/TemplateBasics.class.php");
// $tplHeaders = new TemplateBasics();

?>
<!-- ------------------------------------------------------------------------------------------------------- -->

<!-- Vypis obsahu sablony -->
<?php
// muze se hodit: strtotime($d['date'])

// TODO - doplneni sablony

?>