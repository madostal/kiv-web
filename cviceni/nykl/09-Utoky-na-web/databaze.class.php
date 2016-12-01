<?php 

class Databaze{
    private $db; // objekt databaze
    
    public function __construct(){
        // nacteni nastaveni
        include_once("settings.inc.php");
        // vytvoreni PDO objektu pro praci s DB
        $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
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
        $vystup = $this->provedDotaz("SELECT * FROM ".TABLE_UZIVATELE." WHERE login='$log' AND heslo='$pas';");
        /////// KONEC: klasický dotaz /////////////
        
        /////// START: osetreni SQL Injection ////////////
        //** Doplňte **//
        /////// KONEC: osetreni SQL Injection ///
        
        // získat po řádcích            
        /*while($row = $vystup->fetch(PDO::FETCH_ASSOC)){
            $pole[] = $row['login'].'<br>';
        }*/
        // získat všechny řádky do pole
        $pole = $vystup->fetchAll();
        //print_r($pole);
        // vratim jen prvni radek pole, tj. 1 uzivatele
        // toto je dobre opravit
        return isset($pole) ? $pole : null;
    }
    
    public function registrujUzivatele($jm, $log, $pas, $mail){
        /// klasicky
        $dotaz = "INSERT INTO ".TABLE_UZIVATELE." (jmeno, login, heslo, email) VALUES ('$jm', '$log', '$pas', '$mail');";
        $this->provedDotaz($dotaz);
        /// predpripraveny dotaz
        /*$dotaz = "INSERT INTO ".TABLE_UZIVATELE." (jmeno, login, heslo, email) VALUES (?,?,?,?);";
        $vystup = $this->db->prepare($dotaz);
        $jm = htmlspecialchars($jm);
        $vystup->execute(array($jm, $log, $pas, $mail));*/
        
    }
    
    public function vratPrispevky(){
        // dotaz kvuli diakritice cestiny vlozene z instalacniho souboru
        //$q = "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
        //$result = $this->db->query($q);
        
        // ziskat vysledek dotazu klasicky
        $vystup = $this->provedDotaz("SELECT * FROM ".TABLE_KNIHA." ORDER BY idkniha DESC;");
        
        // získat všechny řádky do pole
        $pole = $vystup->fetchAll();
        // vratim jen prvni radek pole, tj. 1 uzivatele
        return $pole;
    }

    public function vlozPrispevek($uzivatel, $text){
        // ziskat vysledek dotazu klasicky
        $vystup = $this->provedDotaz("INSERT INTO ".TABLE_KNIHA." (clovek, text) VALUES ('$uzivatel', '$text');");
               
    }
    
}


?>