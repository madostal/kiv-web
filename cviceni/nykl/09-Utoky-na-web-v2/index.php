<?php
/////// NASTAVENI ///////////

    // vynucený výpis všech chyb serveru
    ini_set('display_startup_errors',1);
    ini_set('display_errors',1);
    error_reporting(-1);

    // nastavim tajne cookie webu s platnosti 10min
    // pozor, ze u klienta se projevi az pri pristim nacteni webu
    setcookie("tajne", "Tajná hodnota v Cookie [".time()."s].", time()+60*10);

    /**
     * Pomocna funkce pro rekurzivni vypis obsahy pole do tabulky.
     * @param array $vstup  Pole, ze kterehu bude tabulka vytvorena.
     * @return string
     */
    function vytvorTabulku($vstup){
        $textTabulky = "<table border><tr><td>key</td><td>value</td></tr>";
        foreach($vstup as $key => $value){ // procházím pole
            $textTabulky.= "<tr><td>".$key."</td><td>".((is_array($value)) ? vytvorTabulku($value) : (((trim($value)=="")?"nezadáno":$value)."</td></tr>")); // vypise nebo rekurze
        }
        $textTabulky.= "</table>";
        return $textTabulky;
    }
    
/////////////////////// Kod spoustejici aplikaci  //////////////////////

    // pripojim databazi a spravu prihlaseni uzivatele a vytvorim jejich instance
    require_once("Databaze.class.php");
    require_once("Prihlaseni.class.php");
    $db = new Databaze();
    $pr = new Prihlaseni();

    // promenna pro kontrolni vypisy
    $vypis = "";

    //// reakce na odeslani formularu
    // prihlaseni
    if(isset($_POST["prihlaseni"])){
        $vypis .= "Přihlášení: ";
        $vypis .= $pr->prihlasUzivatele($_POST["login"],$_POST["heslo"]);
    }
    // odhlaseni
    elseif (isset($_POST["odhlaseni"])) {
        $vypis .= "Odhlášení: ";
        $vypis .= $pr->odhlasUzivatele();
    }
    // registrace
    elseif (isset($_POST["registrace"])){
        $vypis .= "Registrace: ";
        $vypis .= $pr->registraceUzivatele($_POST["jmeno"], $_POST["login"], $_POST["heslo"], $_POST["email"]);
    }
    // vlozeni prispevku
    elseif (isset($_POST["vlozeni"])){
        $vypis .= "Vložení příspěvku: ";
        $db->vlozPrispevek($_POST["jmeno"],$_POST["text"]);
    }
    // zobrazeni prispevku
    elseif (isset($_GET["zobraz"])){
        $prispevek = $db->vratPrispevek($_GET["prispevek"]);
    }

    // je uzivatel prihlasen ?
    $uzivatel = $pr->kontrolaPrihlaseni();

    // ziskam vsechny prispevky
    $prispevky = $db->vratPrispevky();

////////////////////// KONEC: Kod spoustejici aplikaci  //////////////////////

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ukázka nezabezpečeného webu</title>
        <style>
            body {
                background: linear-gradient(blue, lightblue, blue);
            }
            #obal {
                width: 600px;
                margin: 20px auto;
                background-color: beige;
                padding: 10px;
                border: 1px solid black;
            }
            h2 {
                color: white;
                background: blue;
                text-align: center;
            }
            p {
                text-align: justify;
                border-bottom: 1px solid blue;
            }
        </style>
    </head>
    <body>
        <div id="obal">
            <header>
                <h1>Ukázka nezabezpečeného webu</h1>
            </header>
            <article>
                <pre>
                    <?php
                        // pomocny vypis - info o provedeni akce
                        echo (isset($vypis)) ? $vypis."<br>" : "";
                        // pomocny vypis - info o parametrech URL
                        echo (isset($_GET["vstup"])) ? "GET:".$_GET["vstup"] : ""; // pokud je, tak vypise
                    ?>
                </pre>

                <?php
                    // je uzivatel prihlasen?
                    if(!isset($uzivatel)){
                        // uzivatel neprihlasen
                ?>
                        <!-- FORM - prihlaseni -->
                        <form action="" method="post">
                            <fieldset>
                                <legend>Přihlášení uživatele</legend>
                                Login: <input type="text" name="login" ><br>
                                Heslo: <input type="password" name="heslo"><br>
                                <input type="submit" name="prihlaseni" value="Přihlásit">
                            </fieldset>
                        </form>


                        <!-- FORM - registrace -->
                        <!-- nyni neni potreba, tak je skryta
                        <hr>
                        <form action="" method="post">
                            <fieldset>
                                <legend>Registrace uživatele</legend>
                                Jméno: <input type="text" name="jmeno" ><br>
                                Login: <input type="text" name="login" ><br>
                                Email: <input type="email" name="email" ><br>
                                Heslo (1): <input type="password" name="heslo" id="a"  oninput="out.value=(a.value==b.value)?'stejná':'různá';"><br>
                                Heslo (2): <input type="password" name="heslo2" id="b"  oninput="out.value=(a.value==b.value)?'stejná':'různá';"><br>
                                Kontrola: <output name="out" for="a b">Hesla nejsou stejná</output><br>
                                <input type="submit" name="registrace" value="Registrovat">
                            </fieldset>
                        </form>
                        <hr>
                        -->


                        <h2>Návštěvní kniha (pro XSS)</h2>
                        <?php
                            // vypis vsech prispevku + volby do selectboxu
                            $options = "";
                            foreach($prispevky as $p){
                                // vypis
                                echo "<p>";
                                echo "<b>Autor: $p[clovek]</b><br>";
                                echo $p["text"];
                                echo "</p>";
                                // volby
                                $options .= "<option value='$p[idkniha]'>$p[idkniha]</option>";
                            }
                        ?>

                        <!-- FORM - prispevek do knihy -->
                        <h3>Vložte příspěvek do návštěvní knihy</h3>
                        <form action="" method="post">
                            <fieldset>
                                <legend>Nový příspěvek</legend>
                                Jméno: <input type="text" name="jmeno" maxlength="60"><br>
                                <textarea type="text" name="text" placeholder="zadejte Váš text"></textarea><br>
                                <input type="submit" name="vlozeni" value="Odeslat příspěvek">
                            </fieldset>
                        </form>


                        <h2>Zobrazení zvoleného příspěvku (pro SQL Injection)</h2>
                        <!-- FORM - zobraz jeden prispevek -->
                        <form action="" method="get">
                            <fieldset>
                                <legend>Výběr příspěvku</legend>
                                <select name="prispevek">
                                    <?php echo $options; ?>
                                </select>
                                <input type="submit" name="zobraz" value="Zobraz">
                            </fieldset>
                        </form>
                        <p>
                            <?php
                                // je zvolen prispevek pro vypsani?
                                if(isset($prispevek) && count($prispevek)>0){
                                    echo "<h3>Zvolený příspěvek s ID:".$prispevek[0]["idkniha"]."</h3>";
                                    echo "<b>Autor: ".$prispevek[0]["clovek"]."</b><br>".$prispevek[0]["text"];
                                }
                            ?>
                        </p>

                <?php
                    } else {
                        // uzivatel je prihlasen
                        echo "Přihlášen uživatel:<br>";
                        echo vytvorTabulku($uzivatel[0]) ."<hr>";
                ?>
                        <form action="" method="post">
                            <fieldset>
                                <legend>Odhlášení uživatele</legend>
                                <input type="submit" name="odhlaseni" value="Odhlášení">
                            </fieldset>
                        </form>
                        <h2>Text pro přihlášené uživatele</h2>
                        <p>
                            Dlouhý nesmyslný text pro přihlášeného uživatele.
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sit amet magna in magna gravida vehicula. Vivamus luctus egestas leo. Aenean id metus id velit ullamcorper pulvinar. Pellentesque sapien. Maecenas lorem. In convallis. Etiam commodo dui eget wisi. Pellentesque pretium lectus id turpis. Curabitur sagittis hendrerit ante. Vestibulum fermentum tortor id mi. Etiam posuere lacus quis dolor. In enim a arcu imperdiet malesuada. Nullam at arcu a est sollicitudin euismod. Vivamus porttitor turpis ac leo.
                            Phasellus et lorem id felis nonummy placerat. Maecenas libero. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Maecenas lorem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Quisque porta. Nullam dapibus fermentum ipsum. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis.
                            Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Aliquam erat volutpat. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Duis condimentum augue id magna semper rutrum. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Pellentesque arcu. In dapibus augue non sapien. Etiam posuere lacus quis dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer malesuada. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Pellentesque pretium lectus id turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris elementum mauris vitae tortor.
                        </p>
                <?php
                    }
                ?>
            </article>
        </div>
    </body>
</html>