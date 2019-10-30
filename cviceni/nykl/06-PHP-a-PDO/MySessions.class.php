<?php

/**
 *  Objekt pro praci se Session.
 *  @author Michal Nykl
 */
class MySession{
    
    /**
     *  Pri vytvoreni objektu je zahajena session.
     */
    public function __construct(){
        session_start(); // zahajim
    }
    
    /**
     *  Funkce pro ulozeni hodnoty do session.
     *  @param string $name     Jmeno atributu.
     *  @param mixed $value    Hodnota
     */
    public function addSession($name, $value){
        $_SESSION[$name] = $value;
    }
    
    /**
     *  Vrati hodnotu dane session nebo null, pokud session neni nastavena.
     *  @param string $name Jmeno atributu.
     *  @return mixed
     */
    public function readSession($name){
        // existuje dany atribut v session
        if($this->isSessionSet($name)){
            return $_SESSION[$name];
        } else {
            return null;
        }
    }
    
    /**
     *  Je session nastavena?
     *  @param string $name  Jmeno atributu.
     *  @return boolean
     */
    public function isSessionSet($name){
        return isset($_SESSION[$name]);
    }

    /**
     *  Odstrani danou session.
     *  @param string $name Jmeno atributu.
     */
    public function removeSession($name){
        unset($_SESSION[$name]);
    }
    
}
?>