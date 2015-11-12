<?php

/**
*   Protoze nesla databaze, tak lze vyuzit tento soubor.
*   Do souboru nepotrebujete zasahovat.
*/
class Nahradni_DB{
    private $produkty;
    
    public function __construct(){
        $p[] = array( "Televizor", "5530", "");
        $p[] = array( "Lednička", "7800", "");
        $p[] = array( "Sporák", "8000", "");
        $p[] = array( "Pračka", "6500", "");
        $p[] = array( "Žehlička", "700", "");
        $p[] = array( "Vysavač", "3200", "");
        $p[] = array( "Holící strojek", "1200", "");
        $p[] = array( "Zastřihávač", "900", "");
        foreach($p as $pp){
            $nacteno[] = array('nazev'=>$pp[0], 'cena'=>$pp[1], 'obrazek'=>$pp[2]);
        }
        $this->produkty = $nacteno;
    }
    
    public function nactiProdukty(){
        return $this->produkty;
    }
    
    public function doKosiku($idProduktu, $pocet, $uzivatel){
        $_SESSION["kosik"][$uzivatel][$idProduktu] = $pocet;
        
    }
    
    public function zKosiku($idProduktu, $uzivatel){
        if(isset($_SESSION["kosik"][$uzivatel][$idProduktu])){
            unset($_SESSION["kosik"][$uzivatel][$idProduktu]);
        }
    }
           
    public function obsahKosiku($uzivatel){
        if(isset($_SESSION["kosik"][$uzivatel])){
            foreach($_SESSION["kosik"][$uzivatel] as $produkt => $pocet){
                //echo "q:".$produkt."-".$pocet."-".$uzivatel;
                $this->produkty[$produkt]["ks"] = $pocet;
                $this->produkty[$produkt]["id"] = $produkt;
                $obsah[] = $this->produkty[$produkt];
            }            
        } 
        if(isset($obsah)){
            return $obsah;
        } else {
            return null;
        }
    }
    
    
}


?>