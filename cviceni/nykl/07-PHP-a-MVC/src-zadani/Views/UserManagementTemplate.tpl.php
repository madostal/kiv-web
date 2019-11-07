<?php
///////////////////////////////////////////////////////////////////////////
/////////// Sablona pro zobrazeni stranky se spravou uzivatelu  ///////////
///////////////////////////////////////////////////////////////////////////

//// pozn.: sablona je samostatna a provadi primy vypis do vystupu:
// -> lze testovat bez zbytku aplikace.
// -> pri vyuziti Twigu se sablona obejde bez PHP.

//// UKAZKA: Uvod bude vypisovat informace z tabulky, ktera ma nasledujici sloupce:
// id, date, author, title, text
$tplData['title'] = "Sprava uživatelů (TPL)";
$tplData['users'] = [
    array("id_user" => 1, "first_name" => "František", "last_name" => "Noha",
          "login" => "frnoha", "password" => "Tajne*Heslo", "email" => "fr.noha@ukazka.zcu.cz", "web" => "www.zcu.cz")
];
$tplData['delete'] = "Úspěšné mazání.";
define("DIRECTORY_VIEWS", "../Views");
const WEB_PAGES = array(
    "uvod" => array("title" => "Sprava uživatelů (TPL)")
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
// muze se hodit:
//<form method='post'>
//    <input type='hidden' name='id_user' value=''>
//    <button type='submit' name='action' value='delete'>Smazat</button>
//</form>

// TODO - doplneni sablony

?>