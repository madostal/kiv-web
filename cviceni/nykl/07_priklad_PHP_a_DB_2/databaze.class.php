<?php 

class Databaze{
    private $db; // objekt databaze
    
    public function __construct($host, $dbname, $usr, $pas){
        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $usr, $pas);
    }
    
    private function provedDotaz($dotaz){
        $res = $this->db->query($dotaz);
        if (!$res) {
            $error = $this->db->errorInfo();
            echo $error[2];
            return null;
        } else {
            return $res;            
        }
    }
    
    
    public function vratUzivatele($log, $pas){
        /////// START: klasický dotaz bez ošetření vstupů //////////
        // ziskat vysledek dotazu klasicky
        $vystup = $this->provedDotaz("SELECT * FROM nyklm_uzivatele WHERE login='$log' AND heslo='$pas';");
        /////// KONEC: klasický dotaz /////////////
        
        /////// START: osetreni SQL Injection ////////////
        //** Doplňte **//
        /// KONEC: osetreni SQL Injection ///
        
        // získat po řádcích            
        /*while($row = $vystup->fetch(PDO::FETCH_ASSOC)){
            $pole[] = $row['login'].'<br>';
        }*/
        // získat všechny řádky do pole
        $pole = $vystup->fetchAll();
        print_r($pole);
        // vratim jen prvni radek pole, tj. 1 uzivatele
        return isset($pole) ? $pole : null;
    }
    
    public function registrujUzivatele($jm, $log, $pas, $mail){
        //** doplňte **//;
    }

    
}


?>