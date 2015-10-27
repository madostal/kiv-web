<?php
    include("prihlaseni.class.php");
    $pr = new Prihlaseni;
    $pomocne = ""; // kontrolni vypisy

    // reaguje na odeslani formularu
    if(isset($_POST["prihlaseni"])){
        $pomocne .= "prihlaseni";
        //** doplnte
        $pomocne .= $pr->prihlasUzivatele();
    } elseif (isset($_POST["odhlaseni"])) {
        $pomocne .= "odhlaseni";
        //** doplnte
        $pomocne .= $pr->odhlasUzivatele();
    } elseif (isset($_POST["registrace"])){
        $pomocne .= "registrace";
        //** doplnte
        $pomocne .= $pr->registraceUzivatele();
    }

    // je uzivatel prihlasen ?
    $uzivatel = $pr->kontrolaPrihlaseni();
    
?>
<!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>login</title>
    </head>

    <body>
        <?php  
        echo (isset($pomocne)) ? $pomocne."<br>" : ""; // pomocny vypis
        if(!$uzivatel){ // uzivatel neprihlasen = login
        ?>
            <form action="#" method="post">
                <fieldset>
                    <legend>Přihlášení uživatele</legend>
                    Login: <input type="text" name="login" maxlength="30"><br>
                    Heslo: <input type="password" name="heslo" maxlength="40"><br>
                    <input type="submit" name="prihlaseni" value="Přihlásit">
                </fieldset>
            </form>
            <hr>
            <form action="#" method="post">
                <fieldset>
                    <legend>Registrace uživatele</legend>
                    Jméno: <input type="text" name="jmeno" maxlength="60"><br>
                    Login: <input type="text" name="login" maxlength="30"><br>
                    Email: <input type="email" name="email" maxlength="35"><br>
                    Heslo (1): <input type="password" name="heslo" id="a" maxlength="40" oninput="out.value=(a.value==b.value)?'stejná':'různá';"><br>
                    Heslo (2): <input type="password" name="heslo2" id="b" maxlength="40" oninput="out.value=(a.value==b.value)?'stejná':'různá';"><br>
                    Kontrola: <output name="out" for="a b">Hesla nejsou stejná</output><br>
                    <input type="submit" name="registrace" value="Registrovat">
                </fieldset>
            </form>

        <?php     
        } else { // uzivatel neprihlasen
            echo "Přihlášen uživatel:";
        ?>
            <form action="#" method="post">
                <fieldset>
                    <legend>Odhlášení uživatele</legend>
                    <input type="submit" name="odhlaseni" value="Odhlášení">
                </fieldset>
            </form>        
        <?php     
        }
        ?>

    </body>

    </html>