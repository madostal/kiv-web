<?php
    // nacteni souboru s funkcemi loginu (prace se session)


?>
<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Úvodní stránka</title>
    </head>
    <body>
        <h1>Úvodní stránka</h1>
<?php

   // zpracovani odeslanych formularu
        

   ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////        
?>
        <form method="POST">
            <fieldset>
                <legend>Přihlášení uživatele</legend>
                <input type="text" name="jmeno" placeholder="-- zadejte jméno --">
                <button type="submit" name="action" value="login">
                    Přihlásit uživatele
                </button>
            </fieldset>
        </form>

<?php
   ///////////// KONEC: PRO NEPRIHLASENE UZIVATELE ///////////////
        
   ///////////// PRO PRIHLASENE UZIVATELE ///////////////                
?>
        <b>Přihlášený uživatel</b><br>
        Jméno: <br>
        Datum: <br>
        <br>
        
        Menu: <a href="nakup-auta.php">Nákup auta</a><br>
        <br>

        <form method="POST">
            <fieldset>
                <legend>Odhlášení uživatele</legend>
                <button type="submit" name="action" value="logout">
                    Odhlásit uživatele
                </button>
            </fieldset>
        </form>

<?php
   ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////                
?>
    
    </body>
</html>
             