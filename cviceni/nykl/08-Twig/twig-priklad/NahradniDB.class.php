<?php

/**
 *  Aby nemusela byt pouzita databaze, tak je vyuzit tento nahradni soubor.
 *  Do souboru nepotrebujete zasahovat.
 *  Predpoklada se, ze je spustena Session.
 */
class NahradniDB{

    /** @var array $produkty  Produkty obchodu. */
    private $produkty;

    /**
     * Inicializace dat.
     */
    public function __construct(){
        // data obchodu
        $p[] = array( "Televizor", "5530", "");
        $p[] = array( "Lednička", "7800", "");
        $p[] = array( "Sporák", "8000", "");
        $p[] = array( "Pračka", "6500", "pracka.jpg");
        $p[] = array( "Žehlička", "700", "");
        $p[] = array( "Vysavač", "3200", "");
        $p[] = array( "Holící strojek", "1200", "");
        $p[] = array( "Zastřihávač", "900", "");
        $i=0;
        // nactu je do asociativniho pole (nahrazuje databazi)
        foreach($p as $pp){
            $nacteno[$i] = array('id'=>$i, 'nazev'=>$pp[0], 'cena'=>$pp[1], 'obrazek'=>$pp[2]);
            $i++;
        }
        $this->produkty = $nacteno;
    }
    
    /**
     *  Vrati dostupne produkty obchodu.
     *  @return array   Produkty obchodu.
     */
    public function nactiProdukty(){
        return $this->produkty;
    }
    
    /**
     *  Zaradi produkt do kosiku.
     *  @param int $idProduktu      ID produktu.
     *  @param int $pocet           Pocet kusu daneho produktu.
     *  @param string $uzivatel     Jmeno aktualniho uzivatele.
     */
    public function doKosiku($idProduktu, $pocet, $uzivatel){
        $_SESSION["kosik"][$uzivatel][$idProduktu] = $pocet;        
    }
    
    /**
     *  Z kosiku daneho uzivatele odstrani dany produkt.
     *  @param int $idProduktu      ID produktu.
     *  @param string $uzivatel     Jmeno aktualniho uzivatele.
     */
    public function zKosiku($idProduktu, $uzivatel){
        if(isset($_SESSION["kosik"][$uzivatel][$idProduktu])){
            unset($_SESSION["kosik"][$uzivatel][$idProduktu]);
        }
    }
           
    /**
     *  Vrati produkty v kosiku aktualniho uzivatele.
     *  @param string $uzivatel     Jmeno aktualniho uzivatele.
     *  @return array               Obsah kosiku.
     */
    public function obsahKosiku($uzivatel){
        if(isset($_SESSION["kosik"][$uzivatel])){ // ma dany uzivatel zalozen kosik?
            // projdu produkty v kosiku
            foreach($_SESSION["kosik"][$uzivatel] as $produktId => $pocet){
                //echo "q:".$produkt."-".$pocet."-".$uzivatel;
                $obsah[$produktId] = $this->produkty[$produktId];
                $obsah[$produktId]["ks"] = $pocet;
            }
        }
        if(isset($obsah)){
            return $obsah; // obsah kosiku
        } else { // nema kosik
            return null;
        }
    }

}

?>