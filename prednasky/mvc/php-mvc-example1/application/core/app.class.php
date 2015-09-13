<?php

/**
 * Komentar k tomuto objektu. Popis vstupu, vystupu a pouziti.
 *
 */

class app
{
    // promenna tridy
    private $data = null;
    
    // pripojeni k db - pomocny objekt
    private $db = null;

    /**
     * Konstruktor.
     */
    public function app()
    {
        $this->db = new db();
    }

    public function GetConnection()
    {
    	return $this->db->GetConnection();
    }
    
    /**
     * Pripojit k databazi.
     */
    public function Connect()
    {
    	$this->db->Connect();
    }
    
    
    
    public function Secti($a, $b)
    {
    	$c = $a + $b;
    	return $c;
    }
    

}

?>