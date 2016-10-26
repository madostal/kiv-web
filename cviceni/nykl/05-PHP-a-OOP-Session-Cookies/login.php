<!doctype html>
<?php 
    // načtení souboru s funkcemi

?>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Uživatel</title>
    </head>
    <body>
        <h1>Osobní stránka - login</h1>
<?php
   // zpracovani odeslanych formularu
        
    
   ///////////// PRO NEPRIHLASENE UZIVATELE ///////////////        
?>
        Přihlášení uživatele:
        <form action="" method="POST">
            <input type="text" name="jmeno">
            <input type="hidden" name="action" value="login">
            <input type="submit" name="potvrzeni" value="Přihlásit">
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
        
        Odhlášení uživatele:
        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <input type="submit" name="potvrzeni" value="Odhlásit">
        </form>
        
        
        
<?php
   ///////////// KONEC: PRO PRIHLASENE UZIVATELE ///////////////                
?>
    
    </body>
</html>
             