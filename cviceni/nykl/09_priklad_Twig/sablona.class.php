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
    </head>
    <body style="background-color:blue;">
        <div style="background-color:white;width:500px;margin:0 auto;">
            <h1><?php echo $data["nadpis"]; ?></h1>
            <?php
                //// prihlaseni uzivatele
                if(!isset($data["uzivatel"])){ // uzivatel neprihlasen = login
            ?>
                    <form action="#" method="post">
                        <fieldset>
                            <legend>Přihlášení uživatele</legend>
                            Login: <input type="text" name="login" maxlength="30"><br>
                            <input type="submit" name="prihlaseni" value="Přihlásit">
                        </fieldset>
                    </form>            
            <?php     
                } else { // uzivatel neprihlasen
                    echo "Přihlášen uživatel:".$data["uzivatel"]."<br>";            
            ?>
                    <form action="#" method="post">
                        <fieldset>
                            <legend>Odhlášení uživatele</legend>
                            <input type="submit" name="odhlaseni" value="Odhlášení">
                        </fieldset>
                    </form>
            <?php     
                }
                
                //// vypsani nakupniho kosiku
                if(isset($data["kos"])){
                    echo "<h2>Nákupní košík</h2>";
                    echo "<table>";
                    foreach($data["kos"] as $p){                     
            ?> 
                        <tr><td>
                        <form action="index.php?web=kosik" method="post">
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
                }
                                                    
                                                    
                //// vyspani produktu                                    
                if(isset($data["produkty"])){
                    echo "<h2>Produkty v obchodě</h2>";
                    echo "<table>";
                    foreach($data["produkty"] as $key=>$p){                     
            ?> 
                        <tr><td>
                        <form action="index.php?web=kosik" method="post">
                            <?php 
                                echo $p['nazev'].", Cena:".$p['cena'];                                                                
                            ?>
                            <input type="hidden" name="produkt" value="<?php echo $key; ?>">
                            <input type="number" min="0" max="10" value="1" name="mnozstvi">
                            <input type="submit" name="pridat" value="Přidat do košíku">
                        </form>
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