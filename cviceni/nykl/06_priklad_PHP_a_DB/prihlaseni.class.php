<?php

class Prihlaseni{
    
    public static $uzivatel;
    
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
        //include("objekt pracujici s databazi")
    }
    
    public function kontrolaPrihlaseni(){
        return isset($_SESSION["prihlasen"]);
    }
    
    public function prihlasUzivatele(){
        //** doplnte
        $_SESSION["prihlasen"]=true;
        return true;        
    }
    
    public function odhlasUzivatele(){
        $_SESSION["prihlasen"]=null;
        return true;
    }
    
    public function registraceUzivatele(){
        
    }
}

?>