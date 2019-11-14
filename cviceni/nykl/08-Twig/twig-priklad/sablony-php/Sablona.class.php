<?php
/**
 * Sablona v PHP.
 */
class Sablona {
    
    /**
    *   Zobrazi sablonu vcetne dodanych dat.
    *   @param array $data Data pro vypsani v sablone.
    */
    public static function zobraz($data){
        // nasledujici kod berte pouze jako ilustraci
        // v praxi by nejspis existovaly 2 sablony (uvod a obchod).
?>
<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title><?php echo $data["nadpis"]; ?></title>
        <style>
            body { background-color:lightblue; }
            #obal { background-color:white; width:600px; margin:0 auto; padding:20px; }
            h1 { background-color: blue; color: white; text-align: center; }
            #vypis { border: 1px solid darkred; text-align: center; }
            .text { text-align: justify; }
            #paticka { text-align: center; padding: 5px; background-color: darkgray; margin-top: 10px;}
            img { width: 70px; }
            .obchod tr:nth-of-type(even):not(:first-child)  { background-color: antiquewhite; }
            .obchod tr:nth-of-type(odd):not(:first-child) { background-color: burlywood; }
            .kosik tr:nth-of-type(even):not(:first-child)  { background-color: gold; }
            .kosik tr:nth-of-type(odd):not(:first-child) { background-color: lightblue; }
        </style>
    </head>
    <body>
        <div id="obal">
            <h1><?php echo $data["nadpis"]; ?></h1>
            <?php
                //////  Zprava pro uzivatele  //////////////
                if(isset($data["prihlaseni"]) && $data["prihlaseni"]!=""){
                     echo "<div id='vypis'>$data[prihlaseni]</div>";
                }
                //////  KONEC: Zprava pro uzivatele  //////////////
                                         
                ////////  Prihlaseni/odhlaseni uzivatele  ////////
                if(!isset($data["uzivatel"])){ // uzivatel neprihlasen - zobrazim prihlaseni
            ?>
                    <form action="#" method="post">
                        <fieldset>
                            <legend>Přihlášení uživatele</legend>
                            Login: <input type="text" name="login" maxlength="30">
                            <input type="submit" name="prihlaseni" value="Přihlásit">
                        </fieldset>
                    </form>            
            <?php     
                } else { // uzivatel prihlasen - zobrazim odhlaseni    
            ?>
                    <form action="#" method="post">
                        <fieldset>
                            <legend>Uživatel</legend>
                                <b>Přihlášen uživatel: <?php echo $data["uzivatel"] ?></b>
                                <input type="submit" name="odhlaseni" value="Odhlásit"><br>
                                <a href='index.php?web=obchod'>Do obchodu</a>
                                <a href='index.php'>Na úvodní stránku</a>
                        </fieldset>
                    </form>                    
            <?php     
                }
                echo "<br>";
                ////////  KONEC: Prihlaseni/odhlaseni uzivatele  ////////
                
                ////////  Vypsani nakupniho kosiku  ////////
                if(isset($data["uzivatel"])){
                    if(isset($data["kos"])){
                        echo "<h2>Nákupní košík</h2>";
                        echo "<table class='kosik' border='1'>";
                        echo    "<tr><th>Název</th><th>Cena</th><th>Obr.</th><th>Množství</th><th>Akce</th></tr>";
                        // projdu produkty v kosiku
                        foreach($data["kos"] as $p){                     
            ?> 
                            <form action="index.php?web=obchod" method="post">
                                <tr>
                                    <?php 
                                        echo "<td>".strtoupper($p["nazev"])."</td><td>$p[cena] kč</td>";
                                        if(isset($p['obrazek']) && trim($p['obrazek'])!=""){
                                            echo "<td><img src='obr/$p[obrazek]'></td>";
                                        } else {
                                            echo "<td><img src='obr/produkt.jpg'></td>";
                                        }
                                        echo "<td>$p[ks] ks</td>";
                                    ?>
                                    <td>
                                        <input type="hidden" name="produkt" value="<?php echo $p['id']; ?>">
                                        <input type="submit" name="odebrat" value="Odebrat">
                                    </td>
                                </tr>
                            </form>

            <?php        
                        }
                        echo "</table>";
                    }
                }
                ////////  KONEC: Vypsani nakupniho kosiku  ////////

                ////////  Vypsani produktu v obchode  ////////
                if(isset($data["uzivatel"])){
                    if(isset($data["produkty"])){
                        echo "<h2>Produkty v obchodě</h2>";
                        echo "<table class='obchod' border='1'>";
                        echo    "<tr><th>Název</th><th>Cena</th><th>Obr.</th><th>Volba</th><th>Akce</th></tr>";
                        foreach($data["produkty"] as $p){                     
            ?> 
                            <form action="index.php?web=obchod" method="post">
                                <tr>
                                    <?php 
                                        echo "<td>$p[nazev]</td><td>$p[cena] kč</td>";
                                        if(isset($p['obrazek']) && trim($p['obrazek'])!=""){
                                            echo "<td><img src='obr/$p[obrazek]'></td>";
                                        } else {
                                            echo "<td><img src='obr/produkt.jpg'></td>";
                                        }                                                               
                                    ?>
                                    <td>
                                        <input type="hidden" name="produkt" value="<?php echo $p["id"]; ?>">
                                        <input type="number" min="0" max="10" value="1" name="mnozstvi">
                                    </td>
                                    <td>
                                        <input type="submit" name="pridat" value="Přidat do košíku">
                                    </td>
                                </tr>
                            </form>                        
            <?php        
                        }
                        echo "</table>";
                    }
                }
                ////////  KONEC: Vypsani produktu v obchode  ////////
            ?>
            <div class="text">
                <?php echo $data["text"]; ?>
            </div>
            <div id="paticka">
                &copy; 2016
            </div>
        </div>
    </body>
</html>
<?php  
    }
}
?>