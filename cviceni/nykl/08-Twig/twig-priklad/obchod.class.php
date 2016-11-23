<?php
// kontroler stranky s obchodem
class Obchod{
    
    /**
     *  Pokud je prihlasen uzivatel, tak vrati obsah obchodu, 
     *  jinak pouze vypise, ze uzivatel neni prihlasen.
     *  @param string $uzivatel default=null Jmeno uzivatele.
     *  @return array Data pro vypsani.
     */
    public function vratData($uzivatel=null){
        // ziskani textu
        $nadpis = "Výběr zboží";
        $b = "<br>"; // pomocne odradkovani
        
        //// prace s kosikem uzivatele
        // pripojeni nahradni DB
        include("nahradni_db.class.php");
        $db = new Nahradni_DB;

        /// ziskani seznamu zbozi daneho uzivatele
        if($uzivatel){
            // nacte produkty obchodu
            $zbozi = $db->nactiProdukty();
            $text = "Produkty lze objednat v maximálním množství 10ks.".$b;
            
            /// pridani do kosiku
            if(isset($_POST["pridat"]) && isset($_POST["produkt"]) && isset($_POST["mnozstvi"])){
                $db->doKosiku($_POST["produkt"], $_POST["mnozstvi"], $uzivatel);
            }

            /// odebrani z kosiku
            if(isset($_POST["odebrat"]) && isset($_POST["produkt"])){
                $db->zKosiku($_POST["produkt"], $uzivatel);
            }

            // ziskani aktualniho obsahu kosiku uzivatele
            if($uzivatel){
                $kos = $db->obsahKosiku($uzivatel);
            } // jinak $kos=null

        } else {
            // jinak je $zbozi=null, $kos=null
            $zbozi = null;
            $kos = null;
            $text = "Obchod je dostupný pouze přihlášeným uživatelům.<br><a href='index.php'>Zpět na úvodní stránku</a>.";
        }
        
        return array("nadpis"=>$nadpis, "text"=>$text, "produkty"=>$zbozi, "kos"=>$kos);
    }
}
?>