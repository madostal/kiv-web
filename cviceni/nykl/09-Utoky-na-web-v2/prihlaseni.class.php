<?php

/**
 * Trida pro spravu prihlaseni uzivatelu.
 */
class Prihlaseni{

    /** @var string $uzivatel  Jmeno aktualniho uzivatele. */
    public $uzivatel;

    /** @var Databaze $db  Instance spravy databaze. */
    private $db;

    /** @var string $userSessionKey  Klic do session pro uchovani dat uzivatele */
    private $userSessionKey = "prihlasen";

    /**
     * Zahajeni session a inicializace spravy databaze.
     */
    public function __construct(){
        // spusti session pro spravu prihlaseni uzivatele
        session_start();
        // importuje funkce pro praci s databazi
        include_once("Databaze.class.php");
        $this->db = new Databaze();
    }

    /**
     * Kontroluje, zda je uzivatel aktualne prihlasen.
     * @return mixed|null   Bud jmeno uzivatele, nebo null.
     */
    public function kontrolaPrihlaseni(){
        // pokud je v session, tak ho vratim, jinak null
        return isset($_SESSION[$this->userSessionKey])
            ? $_SESSION[$this->userSessionKey]
            : null;
    }

    /**
     * Prihlasi uzivatele dle shody v DB.
     * @param $log
     * @param $pas
     * @return bool
     */
    public function prihlasUzivatele($log, $pas){
        // spravny login a heslo
        $uzivatel = $this->db->vratUzivatele($log, $pas);
        // mam relevantni uzivatele?
        if(isset($uzivatel) && count($uzivatel)>0){
            // ANO - a protoze jsou v poli, tak beru prvniho z nich a ulozim ho do session
            $_SESSION[$this->userSessionKey] = $uzivatel;
            return true;
        } else {
            // NE - uzivatel nebyl prihlasen
            return false;
        }   
    }

    /**
     * Odhlasi uzivatele.
     */
    public function odhlasUzivatele(){
        unset($_SESSION[$this->userSessionKey]);
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
        // registruju  uzivatele
        $this->db->registrujUzivatele($jm, $log, $pas, $mail);
        // primo ho prihlasim
        return $this->prihlasUzivatele($log, $pas);
    }
}

?>