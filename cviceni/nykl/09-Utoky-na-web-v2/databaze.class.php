<?php 

class Databaze{
    private $db; // objekt databaze

    /// predpripraveny dotaz
    /*
    $dotaz = "INSERT INTO ".TABLE_UZIVATELE." (jmeno, login, heslo, email) VALUES (?,?,?,?);";
    $vystup = $this->db->prepare($dotaz);
    $jm = htmlspecialchars($jm);
    $vystup->execute(array($jm, $log, $pas, $mail));
    */
    
    public function __construct(){
        // nacteni nastaveni
        include_once("settings.inc.php");
        // vytvoreni PDO objektu pro praci s DB
        $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        // osetrim kodovani
        $q = "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
        $this->db->query($q);
    }

    /**
     * Nalezne uzivatele s danym loginem a heslem a vrati je.
     * @param $log
     * @param $pas
     * @return array
     */
    public function vratUzivatele($log, $pas){
        // ziskam vysledek dotazu klasicky
        $vystup = $this->db->query("SELECT * FROM ".TABLE_UZIVATELE." WHERE login='$log' AND heslo='$pas';");
        
        /////// START: osetreni SQL Injection ////////////
        //** Doplňte **//
        /////// KONEC: osetreni SQL Injection ///
        
        // vsechny radky do pole a to vratim
        return $pole = $vystup->fetchAll();
    }

    /**
     * Registruje daneho uzivatele.
     * @param $jm
     * @param $log
     * @param $pas
     * @param $mail
     */
    public function registrujUzivatele($jm, $log, $pas, $mail){
        // zjistim, zda ho uz nemam v DB
        $uzivatel = $this->vratUzivatele($log,$pas);

        // mohu uzivatele vlozit do DB?
        if(!isset($uzivatel) || count($uzivatel)==0){
            /// ziskam vysledek dotazu klasicky
            $dotaz = "INSERT INTO ".TABLE_UZIVATELE." (jmeno, login, heslo, email) VALUES ('$jm', '$log', '$pas', '$mail');";
            $this->db->query($dotaz);

            /////// START: osetreni SQL Injection ////////////
            //** Doplňte **//
            /////// KONEC: osetreni SQL Injection ///
        }
        // pokud uzivatel nevytvoren, tak nic nedelam
    }

    /**
     * Vypise vsechny prispevky. (nema vstupni parametry, neni co osetrit)
     * @return array
     */
    public function vratPrispevky(){
        // ziskam vysledek dotazu klasicky
        $vystup = $this->db->query("SELECT * FROM ".TABLE_KNIHA." ORDER BY idkniha DESC;");

        // vsechny radky do pole a to vratim
        return $vystup->fetchAll();
    }


    public function vratPrispevek($id){
        // ziskam vysledek dotazu klasicky
        $vystup = $this->db->query("SELECT * FROM ".TABLE_KNIHA." WHERE idkniha=$id;");

        // vsechny radky do pole a to vratim
        return $vystup->fetchAll();
    }

    /**
     * Vlozi jeden prispevek.
     * @param $uzivatel
     * @param $text
     */
    public function vlozPrispevek($uzivatel, $text){
        // ziskat vysledek dotazu klasicky
        $this->db->query("INSERT INTO ".TABLE_KNIHA." (clovek, text) VALUES ('$uzivatel', '$text');");
    }
    
}


?>