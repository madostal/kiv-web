<?php
/**
 * Kontroler stranky s obchodem.
 */
class Obchod{

    /** @var NahradniDB $db  Soubor predstavujici databazi a praci s ni. */
    private $db;

    /**
     * Inicializace pripojeni k DB.
     */
    public function __construct()
    {
        // pripojeni nahradni DB
        include("NahradniDB.class.php");
        $this->db = new NahradniDB();
    }

    /**
     *  Pokud je prihlasen uzivatel, tak vrati obsah obchodu, 
     *  jinak pouze vypise, ze uzivatel neni prihlasen.
     *  @param string $uzivatel     Jmeno uzivatele, default=null.
     *  @return array               Data pro vypsani.
     */
    public function vratData($uzivatel=null){
        // ziskani textu
        $nadpis = "Výběr zboží";
        $b = "<br>"; // pomocne odradkovani
        
        //// prace s kosikem uzivatele

        // ziskani seznamu zbozi daneho uzivatele
        if($uzivatel){
            // nacte produkty obchodu
            $zbozi = $this->db->nactiProdukty();
            $text = "Produkty lze objednat v maximálním množství 10ks.".$b;
            
            // pridani do kosiku
            if(isset($_POST["pridat"]) && isset($_POST["produkt"]) && isset($_POST["mnozstvi"])){
                $this->db->doKosiku($_POST["produkt"], $_POST["mnozstvi"], $uzivatel);
            }

            // odebrani z kosiku
            if(isset($_POST["odebrat"]) && isset($_POST["produkt"])){
                $this->db->zKosiku($_POST["produkt"], $uzivatel);
            }

            // ziskani aktualniho obsahu kosiku uzivatele
            if($uzivatel){
                $kos = $this->db->obsahKosiku($uzivatel);
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