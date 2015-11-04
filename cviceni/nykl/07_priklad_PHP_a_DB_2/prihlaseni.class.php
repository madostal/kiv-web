<?php

class Prihlaseni{
    
    public static $uzivatel;
    private $db;
    
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
        // importuje funkce pro práci s databází
        include("databaze.class.php");
        $this->db = new Databaze("localhost","db1_vyuka","db1_vyuka","db1_vyuka");
    }
    
    public function kontrolaPrihlaseni(){
        return isset($_SESSION["prihlasen"]) ? $_SESSION["prihlasen"] : null;
    }
    
    public function prihlasUzivatele($log, $pas){
        // spravny login a heslo
        $uzivatel = $this->db->vratUzivatele($log, $pas);
        if($uzivatel!=null){
            $_SESSION["prihlasen"]=$uzivatel; // zahajim session uzivatele
            return "ANO";
        } else {
            return "NE";
        }   
    }
    
    public function odhlasUzivatele(){
        session_unset(); // smazu session
        return true;
    }
    
    public function registraceUzivatele($jm, $log, $pas, $mail){
        $this->db->registrujUzivatele($jm, $log, $pas, $mail);
        return $this->prihlasUzivatele($log, $pas);
    }
}

?>