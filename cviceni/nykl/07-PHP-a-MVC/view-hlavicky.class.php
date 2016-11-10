<?php

class ViewHlavicky {
    
    public function __construct() {
        
    }

    /**
     *  Vrati vrsek stranky az po oblast, 
     *  ve ktere se vypisuje obsah stranky.
     *  @param string $title Nazev stranky.
     *  @return string Hlavicka stranky.
     */
    public function getHTMLHeader($title){
        
    }
    
    /**
     *  Vrati paticku stranky.
     *  @return string Paticka stranky.
     */
    public function getHTMLFooter(){
        return  "</body>
               </html>";
    }
        
}

?>