<?php
// sablona
class Sablona{
    
    /**
    *   Zobrazi sablonu.
    */
    public static function zobraz($data){
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $data["nadpis"]; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="moje_jQuery.js"></script>
    </head>
    <body style="background-color:blue;">
        <div style="background-color:white;width:500px;margin:0 auto;">
            <h1><?php echo $data["nadpis"]; ?></h1>
            <?php
                echo "<h2 id='kos_nadpis'>Nákupní košík (<span id='koupeno'></span>)</h2>";
                echo "<div id='cely_kos'>";
                echo "<div>Uživatel: <span id='uzivatel'>".$data["uzivatel"]."</span></div>";                
                //// vypsani nakupniho kosiku
                if(isset($data["kos"])){                    
                    echo "<table id='kos'>";
                    foreach($data["kos"] as $p){                     
            ?> 
                        <tr><td>
                        <form action="index.php" method="post">
                            <?php 
                                echo $p['nazev'].", Cena:".$p['cena'].", Kusů:".$p['ks'];                                                                
                            ?>
                            <input type="hidden" name="produkt" value="<?php echo $p['id']; ?>">
                            <input type="submit" name="odebrat" value="Odebrat">
                        </form>
                        </td></tr>
            <?php        
                    }
                    echo "</table>";
                    echo "<button name='obj_kos' id='tl_objednani'>Objednat zboží</button><br>";
                    echo "</div>";
                    echo "<div id='ajax'></div>";
                }
                                                    
                echo "<h2 id='produkty_nadpis'>Produkty v obchodě</h2>";                                    
                //// vyspani produktu                                    
                if(isset($data["produkty"])){
                    echo "<table id='produkty'>";
                    foreach($data["produkty"] as $key=>$p){                     
            ?> 
                        <tr><td>
                        <form action="index.php" method="post">
                            <?php 
                                echo $p['nazev'].", Cena:".$p['cena'];                                                                
                            ?>
                            <input type="hidden" name="produkt" value="<?php echo $key; ?>">
                            <input type="number" min="0" max="10" value="1" name="mnozstvi">
                            <input type="submit" name="pridat" value="Přidat do košíku">
                        </form>
                        <div class="popis"><?php 
                                echo $p['popis'];                                                                
                            ?></div>
                        </td></tr>
            <?php        
                    }
                    echo "</table>";
                }
            ?>
            <?php echo $data["text"]; ?>
            
        </div>
    </body>
</html>
<?php  
    }
}
?>