<?php
//// uvodni stranka webu
// ziskani textu
$nadpis = "Výběr zboží";
$b = "<br>"; // pomocne odradkovani
$text = "<a href='index.php'>Odkaz na úvodní stránku</a>".$b;

//// prace s kosikem uzivatele
// pripojeni nahradni DB
include("nahradni_db.class.php");
$db = new Nahradni_DB;

/// ziskani seznamu zbozi
if($glob_uzivatel){
    $zbozi = $db->nactiProdukty();
} else {
    $zbozi = null;
}

/// pridani do kosiku
if(isset($_POST["pridat"]) && $glob_uzivatel){
    $db->doKosiku($_POST["produkt"], $_POST["mnozstvi"], $glob_uzivatel);
}

/// odebrani z kosiku



// ziskani obsahu kosiku uzivatele
if($glob_uzivatel){
    $kos = $db->obsahKosiku($glob_uzivatel);
} else {
    $kos = null;
}

// vypsanitextu skrze zablonu
include("sablona.class.php");
$sablona = new Sablona();
$sablona->zobraz($nadpis,$text, $glob_uzivatel, $zbozi, $kos);

?>