<?php //Generate text file on the fly
    
   if(!isset($_POST["uzivatel"])){
      echo "Neznámý uživatel.";
      return; // uzivatel neexistuje
   }

   include("nahradni_db.class.php");
   $db = new Nahradni_DB;
   // ziskam obsah kosiku aktualniho uzivatele
   $kos = $db->obsahKosiku($_POST["uzivatel"]);
   // protoze zbozi bude nyni objednano, tak smazu kosik
   $db->smazKosik($_POST["uzivatel"]);
  
   // vytvorim "fakturu"
   $text = "<b>Uživatel ".$_POST["uzivatel"]." objednal zboží:</b><br>";
   $cena = 0; 
   if(isset($kos)){
     foreach($kos as $k){
        $text .= $k['nazev'].", cena za 1ks:".$k['cena']."Kč, kusů:".$k['ks'].", celkem ".($k['cena']*$k['ks'])."Kč<br>";
        $cena += $k['cena']*$k['ks'];
     }
   }
   $text .= "<br><b>Celková cena objednávky: ".$cena."Kč</b><br>";
   $text .= "Děkujeme Vám za nákup.";
    
   // vypsani obsahu do souboru
   //header("Content-type: text/plain");
   //header("Content-Disposition: attachment; filename=faktura.txt");
   echo $text;
?>