<?php
class Kosik{
    
    public function vratData($glob_uzivatel){
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
        if(isset($_POST["odebrat"]) && $glob_uzivatel){
            $db->zKosiku($_POST["produkt"], $glob_uzivatel);
        }


        // ziskani obsahu kosiku uzivatele
        if($glob_uzivatel){
            $kos = $db->obsahKosiku($glob_uzivatel);
        } else {
            $kos = null;
        }

        return array("nadpis"=>$nadpis, "text"=>$text, "produkty"=>$zbozi, "kos"=>$kos);
    }
}
?>