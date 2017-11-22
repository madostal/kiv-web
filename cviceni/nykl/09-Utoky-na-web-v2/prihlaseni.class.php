<?php

class Prihlaseni{
    
    public $uzivatel;
    private $db;
    
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
        // importuje funkce pro praci s databazi
        include_once("databaze.class.php");
        $this->db = new Databaze();
    }

    /**
     * Kontroluje, zda je uzivatel aktualne prihlasen.
     * @return mixed|null   Bud uzivatel, nebo null.
     */
    public function kontrolaPrihlaseni(){
        return isset($_SESSION["prihlasen"]) ? $_SESSION["prihlasen"] : null;
    }

    /**
     * Prihlasi uzivatele dle shody v DB.
     * @param $log
     * @param $pas
     * @return string
     */
    public function prihlasUzivatele($log, $pas){
        // spravny login a heslo
        $uzivatel = $this->db->vratUzivatele($log, $pas);
        // mam relevantni uzivatele?
        if(isset($uzivatel) && count($uzivatel)>0){
            // mam - protoze jsou v poli, tak beru prvniho
            $_SESSION["prihlasen"] = $uzivatel; // ulozim do session
            return "ANO";
        } else {
            // uzivatel nebyl prihlasen
            return "NE";
        }   
    }

    /**
     * Odhlasi uzivatele.
     */
    public function odhlasUzivatele(){
        unset($_SESSION["prihlasen"]);
    }

    /**
     * Registruje uzivatele.
     * @param $jm
     * @param $log
     * @param $pas
     * @param $mail
     * @return string
     */
    public function registraceUzivatele($jm, $log, $pas, $mail){
        $this->db->registrujUzivatele($jm, $log, $pas, $mail);
        return $this->prihlasUzivatele($log, $pas);
    }
}

?>