<?php

/**
 * Trida obstaravajici a spravujici prihlaseni uzivatele.
 * Nyni se uzivatel prihlasuje pouze jmenem.
 */
class SpravaPrihlaseni {

    /**
     * Zahajeni prace se session.
     */
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
    }
    
    /**
     *  Pokud je uzivatel prihlasen, tak vrati jeho jmeno, jinak NULL.
     * @return string|null   Login uzivatele nebo null.
     */
    public function kontrolaPrihlaseni(){
        return isset($_SESSION["prihlasen"]) ? $_SESSION["prihlasen"] : null;
    }
    
    /**
     *  Prihlasi daneho uzivatele, tj. ulozi jeho login do session.
     *  @param string $log      Login uzivatele.
     *  @return string|null     Byl uzivatel prihlasen - pokud ano, tak vrati jeho jmeno, jinak vraci null.
     */
    public function prihlasUzivatele(string $log){
        // staci, kdyz login neni prazdny
        if(trim($log)!=""){
            // ulozim uzivatele do session
            $_SESSION["prihlasen"]=$log;
        }
        // kontrola prihlaseni
        return $this->kontrolaPrihlaseni();
    }
    
    /**
     *  Odhlasi uzivatele, tj. smaze jeho session.
     */
    public function odhlasUzivatele(){
        // mazu celou session, proto neobsahuje dalsi data
        session_unset();
    }

}

?>