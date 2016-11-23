<?php

class Prihlaseni{
    
    public $uzivatel;
    
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
    }
    
    /**
     *  Je uzivatel prihlasen?
     *  @return string Login uzivatele nebo null.
     */
    public function kontrolaPrihlaseni(){
        return isset($_SESSION["prihlasen"]) ? $_SESSION["prihlasen"] : null;
    }
    
    /**
     *  Prihlasi danehu uzivatele, tj. zapamatuje si jeho login.
     *  @param string $log Login uzivatele.
     *  @return boolean Byl uzivatel prihlasen?
     */
    public function prihlasUzivatele($log){
        // staci, kdyz login neni prazdny
        if(trim($log)!=""){
            $_SESSION["prihlasen"]=$log; // zahajim session se jmenem uzivatele
        }
        return $this->kontrolaPrihlaseni();
    }
    
    /**
     *  Odhlasi uzivatele, tj. smaze jeho session.
     *  @return boolean Byl uzivatel odhlasen?
     */
    public function odhlasUzivatele(){
        session_unset(); // smazu session
        return !$this->kontrolaPrihlaseni();
    }
        
}

?>